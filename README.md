[![Latest Stable Version](https://poser.pugx.org/jackiedo/workbench/v/stable)](https://packagist.org/packages/jackiedo/workbench)
[![Total Downloads](https://poser.pugx.org/jackiedo/workbench/downloads)](https://packagist.org/packages/jackiedo/workbench)
[![Latest Unstable Version](https://poser.pugx.org/jackiedo/workbench/v/unstable)](https://packagist.org/packages/jackiedo/workbench)
[![License](https://poser.pugx.org/jackiedo/workbench/license)](https://packagist.org/packages/jackiedo/workbench)

# Laravel 5 Workbench
Laravel 5 Workbench bring artisan workbench command (originally from Laravel 4.x) back to Laravel 5+. From now, you will not need to spend too much time building perfect structured packages for Laravel 5+. Let the Laravel 5 Workbench support you in every detail through it's powerful features.

# Features
* Build the standard structure for package.
* Generate a standard composer.json file for package.
* Generate a standard Service Provider file for package.
* Generate some scaffold resources file, such as:
    * Facade files
    * Interface files
    * Abstract files
    * Exception files
    * Controller files
    * Middleware files
    * Model files
    * Artisan CLI files
    * Configuration file
    * Migration files
    * Language files
    * View files
    * Route file
    * Helper file
    * ...
* Autoload dumping to be able to use your package immediately (after adding Service Provider of your package into `providers` section in `config/app.php` file).

# Overview
Look at one of the following topics to learn more about Laravel 5 Workbench

* [Versions and compatibility](#versions-and-compatibility)
* [Installation](#installation)
* [Usage](#usage)
* [Screenshot](#screenshot)
* [Configuration](#configuration)
* [Other documentation](#other-documentation)

## Versions and compatibility

Each branch of Laravel 5 Workbench is similarities with each version of Laravel 5+. Example:

| Branch                                                | Laravel version  |
| ----------------------------------------------------- | ---------------- |
| [5.0](https://github.com/JackieDo/workbench/tree/5.0) | 5.0              |
| [5.1](https://github.com/JackieDo/workbench/tree/5.1) | 5.1              |
| [5.2](https://github.com/JackieDo/workbench/tree/5.2) | 5.2              |
| [5.3](https://github.com/JackieDo/workbench/tree/5.3) | 5.3              |
| [5.4](https://github.com/JackieDo/workbench/tree/5.4) | 5.4              |

In each branch we have multiple versions, tagged syntax as `5.0.*`, `5.1.*`, `5.2.*`, `5.3.*`, `5.4.*`...

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

> Note: `{{laravel-version}}` string above is main version of Laravel that you want to install Laravel Workbench on it. Example, if you want to install this package on Laravel 5.4, you have to set require is `"jackiedo/workbench": "5.4.*"`

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

## Screenshot

> Create package without generating scaffold resources.

![create-without-resources](https://user-images.githubusercontent.com/9862115/26842158-0acb2cc2-4b16-11e7-93fb-d46063c57ef3.png)
![result-without-resources](https://user-images.githubusercontent.com/9862115/26842412-f3906cce-4b16-11e7-9190-d1e1c6eeeefc.png)

> Create package with generating scaffold resources.

![create-with-resources](https://user-images.githubusercontent.com/9862115/26842286-7aed820c-4b16-11e7-89e6-3feaf16ee623.png)
![result-with-resources](https://user-images.githubusercontent.com/9862115/26842435-0a4dc2b8-4b17-11e7-9d39-2e1c46373d29.png)

> Create package with generating scaffold resources and point PSR-4 autoloading namespace to the src directory.

![create-with-point-namespace-to-src-dir](https://user-images.githubusercontent.com/9862115/26842343-ad979d28-4b16-11e7-99dc-ece4decdafd4.png)
![result-with-point-namespace-to-src-dir](https://user-images.githubusercontent.com/9862115/26842459-1dfe6aba-4b17-11e7-9c27-8dcca0bca23a.png)

## Configuration

> All details are provided in your `config/workbench.php` as comments (you have to run Artisan vendor:publish command before). Please read carefully before use.

## Other documentation

> For more documentation about package development, you can visit Official Laravel Documentation pages:

- [Laravel 4.2 Package Development](https://laravel.com/docs/4.2/packages)
- [Laravel 5.0 Package Development](https://laravel.com/docs/5.0/packages)
- [Laravel 5.1 Package Development](https://laravel.com/docs/5.1/packages)
- [Laravel 5.2 Package Development](https://laravel.com/docs/5.2/packages)
- [Laravel 5.3 Package Development](https://laravel.com/docs/5.3/packages)
- [Laravel 5.4 Package Development](https://laravel.com/docs/5.4/packages)