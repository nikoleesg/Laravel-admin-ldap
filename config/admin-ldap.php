<?php

return [

    'controller' => LaravelAdmin\Ldap\Controllers\AuthController::class,

    'base_dn' => 'OU=Managed Users,DC=ascentiq,DC=com,DC=sg',

    'auth' => [

        'guards' => [
            'ldap' => [
                'driver'   => 'session',
                'provider' => 'ldap',
            ],
        ],

        'providers' => [
            'ldap' => [
                'driver' => 'ldap',
                'model' => LaravelAdmin\Ldap\Ldap\User::class,
                'rules' => [
                    LaravelAdmin\Ldap\Ldap\Rules\OnlyProjectMembers::class
                ],
                'scopes' => [
                    LaravelAdmin\Ldap\Ldap\Scopes\BaseDN::class
                ],
                'database' => [
                    'model' => LaravelAdmin\Ldap\Auth\Database\Administrator::class,
                    'sync_passwords' => true,
                    'sync_attributes' => [
                        'username' => 'samaccountname',
                        'name' => 'cn',
                        'email' => 'userprincipalname',
                    ],
                    'sync_existing' => [
                        'username' => 'samaccountname',
                    ],
                    'password_column' => 'password',
                ],
            ]
        ],
    ]

];
