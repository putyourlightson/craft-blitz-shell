<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitzshell;

use Craft;
use craft\events\CancelableEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\web\View;
use putyourlightson\blitz\drivers\deployers\BaseDeployer;
use Symfony\Component\Process\Process;
use yii\base\Event;

class ShellDeployer extends BaseDeployer
{
    // Constants
    // =========================================================================

    /**
     * @event CancelableEvent
     */
    const EVENT_BEFORE_RUN = 'beforeRun';

    /**
     * @event Event
     */
    const EVENT_AFTER_RUN = 'afterRun';

    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('blitz', 'Shell Deployer');
    }

    // Properties
    // =========================================================================

    /**
     * @var string|string[]
     */
    public $commands = [];

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // Register CP template root
        Event::on(View::class, View::EVENT_REGISTER_CP_TEMPLATE_ROOTS,
            function(RegisterTemplateRootsEvent $event) {
                $event->roots['blitz-shell'] = __DIR__.'/templates/';
            }
        );
    }

    /**
     * @inheritdoc
     */
    public function deployUrisWithProgress(array $siteUris, callable $setProgressHandler = null)
    {
        $event = new CancelableEvent();
        $this->trigger(self::EVENT_BEFORE_RUN, $event);

        if (!$event->isValid) {
            return;
        }

        $count = 0;
        $total = count($this->commands);
        $label = 'Running {count} of {total} deploy commands.';

        foreach ($this->commands as $command) {
            if (is_array($command)) {
                $command = $command[0] ?? '';
            }

            $count++;

            if (is_callable($setProgressHandler)) {
                $progressLabel = Craft::t('blitz', $label, ['count' => $count, 'total' => $total]);
                call_user_func($setProgressHandler, $count, $total, $progressLabel);
            }

            Process::fromShellCommandline($command)->mustRun();
        }

        if ($this->hasEventHandlers(self::EVENT_AFTER_RUN)) {
            $this->trigger(self::EVENT_AFTER_RUN, new Event());
        }
    }

    /**
     * @inheritdoc
     */
    public function getSettingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('blitz-shell/settings', [
            'deployer' => $this,
        ]);
    }
}
