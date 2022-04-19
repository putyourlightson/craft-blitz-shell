# Blitz Shell Deployer for Craft CMS

The Shell Deployer allows the [Blitz](https://putyourlightson.com/plugins/blitz) plugin for [Craft CMS](https://craftcms.com/) to deploy cached files to remote locations using shell commands.

> WARNING: Commands are parsed by the shell of your OS. Use at your own risk.

## Usage

Install the deployer using composer.

```shell
composer require putyourlightson/craft-blitz-shell
```

Then add the class to the `driverTypes` config setting in `config/blitz.php`.

```php
// The deployer type classes to add to the plugin’s default deployer types.
'deployerTypes' => [
    'putyourlightson\blitzshell\ShellDeployer',
],
```

You can then select the deployer and add shell commands to execute either in the control panel or in `config/blitz.php`. The shell commands cal also be defined as an array of arrays in the `deployerSettings` setting in `config/blitz.php`.

```php
// The deployer type to use.
'deployerType' => 'putyourlightson\blitzshell\ShellDeployer',

// The deployer settings.
'deployerSettings' => [
   'commands' => [
        ['cp -r ~/mysite.com/web/cache/blitz ~/remote'],
        ['cp -r ~/mysite.com/web/cache/blitz ~/remote'],
        ['cp -r ~/mysite.com/web/cache/blitz ~/remote'],
    ],
],
```

## Documentation

Read the documentation at [putyourlightson.com/plugins/blitz](https://putyourlightson.com/plugins/blitz#remote-deployment).

Created by [PutYourLightsOn](https://putyourlightson.com/).
