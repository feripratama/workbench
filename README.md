# Laravel 5 Workbench

Laravel 5 Workbench bring artisan workbench command (originally from Laravel 4.x) back to Laravel 5+. From now, you will not need to spend too much time building perfect structured packages for Laravel 5+. Let the Laravel 5 Workbench support you in every detail through it's powerful features.

# Overview
Look at one of the following topics to learn more about Laravel 5 Workbench

* [Versions and compatibility](#versions-and-compatibility)
* [Installation](#installation)
* [Usage](#usage)
* [Other documentation](#other-documentation)

## Versions and compatibility

Each branch of Laravel 5 Workbench is similarities with each version of Laravel 5+. Example:

| Branch                                                | Laravel version  |
| ----------------------------------------------------- | ---------------- |
| [5.0](https://github.com/JackieDo/workbench/tree/5.0) | 5.0              |
| [5.1](https://github.com/JackieDo/workbench/tree/5.1) | 5.1              |
| [5.2](https://github.com/JackieDo/workbench/tree/5.2) | 5.2              |
| [5.3](https://github.com/JackieDo/workbench/tree/5.3) | 5.3              |

In each branch we have multiple versions, tagged syntax as `5.0.*`, `5.1.*`, `5.2.*`, `5.3.*`...

## Installation

You can install this package through [Composer](https://getcomposer.org).

- First, edit your project's `composer.json` file to require `jackiedo/workbench`:

```php
...
"require": {
    ...
    "jackiedo/workbench": "{{laravel-version}}.*"
},
```

> Note: `{{laravel-version}}` string above is main version of Laravel that you want to install Laravel Workbench on it. Example, if you want to install this package on Laravel 5.2, you have to set require is `"jackiedo/workbench": "5.2.*"`

- Next step, we update Composer from the Terminal on your project source:

```shell
$ composer update
```

- Once update operation completes, on the third step, we add the service provider. Open `config/app.php` file, and add a new item to the providers array:

```php
...
'providers' => array(
    ...
    Jackiedo\Workbench\WorkbenchServiceProvider::class,
),
```

- On the fourth step, we publish configuration file:

```shell
$ php artisan vendor:publish --provider="Jackiedo\Workbench\WorkbenchServiceProvider" --force
```

> Note: You should use `--force` option in publish command to override configuration file with newest one.

- And the final step is add autoload the workbench to your `bootstrap/autoload.php` file. Put this following code at the very bottom of script.

```php
/*
|--------------------------------------------------------------------------
| Register The Workbench Loaders
|--------------------------------------------------------------------------
|
| The Laravel workbench provides a convenient place to develop packages
| when working locally. However we will need to load in the Composer
| auto-load files for the packages so that these can be used here.
|
*/

if (is_dir($workbench = __DIR__.'/../workbench'))
{
    Jackiedo\Workbench\Starter::start($workbench);
}
```

## Usage

Now, you can use workbench commands to create your packages same as on Laravel 4.2.

> Note: Before you create a package, you need to update `name` and `email` config value in your `config/workbench.php` file.

#### Creating a basic package.

```shell
$ php artisan workbench vendor/name
```

#### Creating a package with generating some scaffold resources.

```shell
$ php artisan workbench vendor/name --resources
```

## Other documentation

> For more documentation about package development, you can visit Official Laravel Documentation pages:

- [Laravel 4.2 Package Development](https://laravel.com/docs/4.2/packages)
- [Laravel 5.0 Package Development](https://laravel.com/docs/5.0/packages)
- [Laravel 5.1 Package Development](https://laravel.com/docs/5.1/packages)
- [Laravel 5.2 Package Development](https://laravel.com/docs/5.2/packages)
- [Laravel 5.3 Package Development](https://laravel.com/docs/5.3/packages)