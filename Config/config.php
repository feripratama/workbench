<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package author name
    |--------------------------------------------------------------------------
    |
    | When you create new packages via the Artisan "workbench" command your
    | name is needed to generate the composer.json file for your package.
    | You may specify it now so it is used for all of your workbenches.
    |
    */

    'name' => '',

    /*
    |--------------------------------------------------------------------------
    | Package author e-mail address
    |--------------------------------------------------------------------------
    |
    | Like the option above, your e-mail address is used when generating new
    | workbench packages. The e-mail is placed in your composer.json file
    | automatically after the package is created by the workbench tool.
    |
    */

    'email' => '',

    /*
    |--------------------------------------------------------------------------
    | Package resources
    |--------------------------------------------------------------------------
    |
    | This option is used to organize workbench package resources.
    |
    | There are two type of resources. First type is resources that using
    | namespace (such as facade, abstract, interface, controller...). The
    | second is resources that not using namespace (such as config, view...).
    |
    | You can place unused namespace resources into the with_namespace section
    | but do not be allowed to do the opposite.
    |
    */

    'resources' => [
        'with_namespace' => [
            'facade'     => 'Facades',            // Can delete, but can not move to without_namespace section
            'interface'  => 'Contracts',          // Can delete, but can not move to without_namespace section
            'abstract'   => 'Contracts',          // Can delete, but can not move to without_namespace section
            'exception'  => 'Exceptions',         // Can delete, but can not move to without_namespace section
            'controller' => 'Http/Controllers',   // Can delete, but can not move to without_namespace section
            'middleware' => 'Http/Middleware',    // Can delete, but can not move to without_namespace section
            'model'      => 'Models',             // Can delete, but can not move to without_namespace section
            'console'    => 'Console/Commands',   // Can delete, but can not move to without_namespace section
        ],
        'without_namespace' => [
            'config'    => 'config',              // Can delete, and can move to with_namespace section
            'migration' => 'database/migrations', // Can delete, and can move to with_namespace section
            'asset'     => 'resources/assets',    // Can delete, and can move to with_namespace section
            'lang'      => 'resources/lang',      // Can delete, and can move to with_namespace section
            'view'      => 'resources/views',     // Can delete, and can move to with_namespace section
            'route'     => 'routes',              // Can delete, and can move to with_namespace section
            'helper'    => 'helpers',             // Can delete, and can move to with_namespace section
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Pointing for namespace autoloading
    |--------------------------------------------------------------------------
    |
    | This option is used to setting for PSR-4 autoloading namespace in
    | composer.json file. You can choose one of three values: true, false, null
    |
    | If you set true value, the Vendor\Name namespace will be pointed to the
    | src/Vendor/Name directory and your used namespace resources will be
    | placed in the sub directory of the src directory with the name created as
    | Vendor/Name.
    |
    | If you set false value, the Vendor\Name namespace will be pointed to the
    | src directory and your used namespace resources will be placed in the
    | src directory (it's mean same directory with unused namespace resources).
    |
    | If you set the value to null, you will always see a question for this
    | option whenever running the Artisan "workbench" command.
    |
    */

    'point_namespace_to_similar_dir' => null

];
