<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\blitzshell;

use Craft;
use craft\events\CancelableEvent;
use putyourlightson\blitz\drivers\deployers\BaseDeployer;
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
    public function deployUrisWithProgress(array $siteUris, callable $setProgressHandler = null)
    {
        $event = new CancelableEvent();
        $this->trigger(self::EVENT_BEFORE_RUN, $event);

        if (!$event->isValid) {
            return;
        }

        $progressLabel = Craft::t('blitz', 'Running deploy commands.');

        if (is_callable($setProgressHandler)) {
            call_user_func($setProgressHandler, 0, 1, $progressLabel);
        }

        $this->runCommands($this->commands);

        if (is_callable($setProgressHandler)) {
            call_user_func($setProgressHandler, 1, 1, $progressLabel);
        }

        if ($this->hasEventHandlers(self::EVENT_AFTER_RUN)) {
            $this->trigger(self::EVENT_AFTER_RUN, new Event());
        }
    }
}
