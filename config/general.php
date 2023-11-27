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

            "index_buses",
            "show_bus",
            "store_bus",
            "update_bus",
            "destroy_bus",

            "index_bus_models",
            "show_bus_model",
            "store_bus_model",
            "update_bus_model",
            "destroy_bus_model",

            "index_routes",
            "show_route",
            "store_route",
            "update_route",
            "destroy_route",

            "index_locations",
            "show_location",
            "store_location",
            "update_location",
            "destroy_location",

            "index_trips",
            "show_trip",
            "store_trip",
            "update_trip",
            "destroy_trip",

            "index_reports",
            "download_trip_report",
        ],
        "system_user_permissions" => [            
            
            "index_trips",
            "show_trip",
            "store_trip",
            "update_trip",
       
        ],
        "system_manager_permissions" => [            
            
            "index_reports",
            "download_trip_report",
       
        ],
        

    ]
];