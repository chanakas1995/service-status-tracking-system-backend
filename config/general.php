<?php


return [

    'frontend_url' => env('FRONTEND_URL', 'http://localhost:8080'),

    "titles" => [
        "1" => "Mrs.",
        "2" => "Ms.",
        "3" => "Miss.",
        "4" => "Mr.",
        "5" => "Dr.",
        "6" => "Prof.",
        "7" => "Hon.",
        "8" => "Ven.",
    ],

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

            "index_branches",
            "show_branch",
            "store_branch",
            "update_branch",
            "destroy_branch",
        ],
        "receptionist_permissions" => [],
        "employee_permissions" => [],
        "customer_permissions" => [],
        "management_staff_permissions" => [],
    ]
];
