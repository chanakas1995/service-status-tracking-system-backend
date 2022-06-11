<?php


return [

    'frontend_url' => env('FRONTEND_URL', 'http://localhost:8080'),

    "permissions" => [
        "system_admin_permissions" => [
            'index_roles',
            'index_employee_types',

            "index_users",
            "show_user",
            "store_user",
            "update_user",
            "destroy_user",

            "index_employees",
            "show_employee",
            "store_employee",
            "update_employee",
            "destroy_employee",
        ],
        "receptionist_permissions" => [],
        "employee_permissions" => [],
        "customer_permissions" => [],
        "management_staff_permissions" => [],
    ]
];
