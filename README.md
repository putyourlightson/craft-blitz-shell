# Blitz Shell Deployer for Craft CMS

The Shell Deployer allows the [Blitz](https://putyourlightson.com/plugins/blitz) plugin for [Craft CMS](https://craftcms.com/) to deploy cached files to remote locations using shell commands.

## License

This plugin is licensed for free under the attached License terms.

## Requirements

Blitz 3.0.2 or later and PHP 7.1.3 or later.

## Usage

Install the deployer using composer.

```
composer require putyourlightson/craft-blitz-shell
```

Then add the class to the `driverTypes` config setting in `config/blitz.php`.

```
// The deployer type classes to add to the plugin’s default deployer types.
'deployerTypes' => [
    'putyourlightson\blitzshell\ShellDeployer',
],
```

You can then select the deployer either in the control panel or in `config/blitz.php`. The shell commands to run must be defined as an array in the `deployerSettings` setting in `config/blitz.php`.

```
// The deployer type to use.
'deployerType' => 'putyourlightson\blitzshell\ShellDeployer',

// The deployer settings.
'deployerSettings' => [
   'commands' => [
        'cp -r ~/mysite.com/web/cache/blitz ~/remote'
    ],
],
```

## Documentation

Read the documentation at [putyourlightson.com/plugins/blitz](https://putyourlightson.com/plugins/blitz#remote-deployment).

Created by [PutYourLightsOn](https://putyourlightson.com/).
