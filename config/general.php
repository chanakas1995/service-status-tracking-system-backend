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

            "index_subjects",
            "show_subject",
            "store_subject",
            "update_subject",
            "destroy_subject",

            "index_gs_offices",
            "show_gs_office",
            "store_gs_office",
            "update_gs_office",
            "destroy_gs_office",

            "index_service_types",
            "show_service_type",
            "store_service_type",
            "update_service_type",
            "destroy_service_type",
        ],
        "receptionist_permissions" => [],
        "employee_permissions" => [],
        "customer_permissions" => [],
        "management_staff_permissions" => [],
    ]
];
