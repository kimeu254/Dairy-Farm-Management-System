<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'owner' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u',
            'cattle' => 'c,r,u,d',
            'calf' => 'c,r,u,d',
            'milk' => 'c,r,u,d',
            'employee' => 'c,r,u,d',
            'medicine' => 'c,r,u,d',
            'inventory' => 'c,r,u,d',
            'accounts' => 'c,r,u,d',
        ],
        'manager' => [
            'users' => 'r',
            'profile' => 'r,u',
            'cattle' => 'c,r,u',
            'calf' => 'c,r,u',
            'milk' => 'c,r,u',
            'employee' => 'c,r,u',
            'medicine' => 'c,r,u',
            'inventory' => 'c,r,u',
            'accounts' => 'c,r,u',
        ],
        'user' => [
            'profile' => 'r,u',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
