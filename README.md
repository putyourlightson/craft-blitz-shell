# Blitz Shell Deployer for Craft CMS

The Shell Deployer allows the [Blitz](https://putyourlightson.com/plugins/blitz) plugin for [Craft CMS](https://craftcms.com/) to deploy cached files directly to Shell sites.

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

You can then select the deployer either in the control panel or in `config/blitz.php`. The settings must be defined in `config/blitz.php`.

```
// The deployer type to use.
'deployerType' => 'putyourlightson\blitzshell\ShellDeployer',

// The deployer settings.
'deployerSettings' => [
   'commands' => [],
],
```

## Documentation

Read the documentation at [putyourlightson.com/plugins/blitz](https://putyourlightson.com/plugins/blitz#remote-deployers).

Created by [PutYourLightsOn](https://putyourlightson.com/).
