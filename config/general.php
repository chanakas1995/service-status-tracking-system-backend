<?php


return [

    'frontend_url' => env('FRONTEND_URL', 'http://localhost:8080'),

    "permissions" => [
        "system_admin_permissions" => [
            'index_roles',
            "index_users",
            "show_user",
            "store_user",
            "update_user",
            "destroy_user",
        ],
        "receptionist_permissions" => [],
        "employee_permissions" => [],
        "customer_permissions" => [],
        "management_staff_permissions" => [],
    ]
];
