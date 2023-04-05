<?php

return [
    /**
     * Load migrations from package migrations,
     * if You published the migration files, please set to `false`.
     */
    'migrations' => false,

    /*
     * Keep versions, you can redefine in target model.
     * Default: 0 - Keep all versions.
     */
    'keep_versions' => 0,

    /*
     * User foreign key name of versions table.
     */
    'user_foreign_key' => 'userid',

    /*
     * The model class for store versions.
     */
    'version_model' => \Overtrue\LaravelVersionable\Version::class,

    /**
     * The model class for user.
     */
    'user_model' => \App\Models\User::class,
];
