<?php

return [
    [
        'section' => [
            'name' => 'SYSTEM',
            'modules' => [
                [
                    'name' => 'Welcome',
                    'icon' => 'fa fa-dashboard',
                    'urlName' => 'admin.setting.welcome',
                    'active' => 'admin.setting.welcome',
                    'canany' => [null]
                ],
                [
                    'name' => 'General',
                    'icon' => 'fa fa-dashboard',
                    'urlName' => 'admin.setting.general',
                    'active' => 'admin.setting.general',
                    'canany' => ['generales']
                ],
                [
                    'name' => 'Permissions',
                    'icon' => 'fa-solid fa-gear',
                    'urlName' => 'admin.setting.permission',
                    'active' => 'admin.setting.permission',
                    'canany' => ['permisos'],
                ],
                [
                    'name' => 'Roles',
                    'icon' => 'fa-solid fa-gear',
                    'urlName' => 'admin.setting.role.index',
                    'active' => 'admin.setting.role*',
                    'canany' => ['roles'],
                ],
                [
                    'name' => 'System logs',
                    'icon' => 'fa-solid fa-spinner',
                    'urlName' => 'admin.setting.log',
                    'active' => 'admin.setting.log',
                    'canany' => ['logs'],
                ],
                [
                    'name' => 'Backups',
                    'icon' => 'fa-solid fa-database',
                    'urlName' => 'admin.setting.backup',
                    'active' => 'admin.setting.backup',
                    'canany' => ['backups'],
                ],
                [
                    'name' => 'Web modules',
                    'icon' => 'fa-solid fa-code',
                    'urlName' => 'admin.setting.module-web',
                    'active' => 'admin.setting.module-web',
                    'canany' => ['módulos web'],
                ]
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'E-COMMERCE',
            'modules' => [
                [
                    'name' => 'Shipping zones',
                    'icon' => 'fa-solid fa-truck',
                    'urlName' => 'admin.setting.shipping-zone.index',
                    'active' => 'admin.setting.shipping-zone*',
                    'canany' => ['zonas de envío']
                ],
                [
                    'name' => 'Shipping classes',
                    'icon' => 'fa-solid fa-tag',
                    'urlName' => 'admin.setting.shipping-class',
                    'active' => 'admin.setting.shipping-class',
                    'canany' => ['clases de envío'],
                ],
                [
                    'name' => 'Countries',
                    'icon' => 'fa-solid fa-earth-americas',
                    'urlName' => 'admin.setting.country',
                    'active' => 'admin.setting.country',
                    'canany' => ['países'],
                ],
                [
                    'name' => 'States',
                    'icon' => 'fa-solid fa-map',
                    'urlName' => 'admin.setting.state',
                    'active' => 'admin.setting.state',
                    'canany' => ['estados'],
                ],
                [
                    'name' => 'Cities',
                    'icon' => 'fa-solid fa-city',
                    'urlName' => 'admin.setting.city',
                    'active' => 'admin.setting.city',
                    'canany' => ['ciudades'],
                ],
                [
                    'name' => 'Popup',
                    'icon' => 'fa-solid fa-fire',
                    'urlName' => 'admin.setting.popup',
                    'active' => 'admin.setting.popup',
                    'canany' => ['popup'],
                ],
                [
                    'name' => 'Configurator PC',
                    'icon' => 'fa-solid fa-laptop-code',
                    'urlName' => 'admin.setting.configurator',
                    'active' => 'admin.setting.configurator',
                    'canany' => ['configurador'],
                ],
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'PAYMENTS',
            'modules' => [
                [
                    'name' => 'Currencies',
                    'icon' => 'fa-solid fa-dollar-sign',
                    'urlName' => 'admin.setting.currency',
                    'active' => 'admin.setting.currency',
                    'canany' => ['monedas'],
                ],
                [
                    'name' => 'Access to payment gateways',
                    'icon' => 'fa-solid fa-money-check-dollar',
                    'urlName' => 'admin.setting.access-payment',
                    'active' => 'admin.setting.access-payment',
                    'canany' => ['pasarelas de pago'],
                ]
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'WEB',
            'modules' => [
                [
                    'name' => 'Web',
                    'icon' => 'fa-solid fa-envelope',
                    'urlName' => 'admin.setting.contact',
                    'active' => 'admin.setting.contact',
                    'canany' => ['contacto']
                ],
                [
                    'name' => 'Analytics tags',
                    'icon' => 'fa-solid fa-chart-simple',
                    'urlName' => 'admin.setting.tag-analytic',
                    'active' => 'admin.setting.tag-analytic',
                    'canany' => ['etiquetas analíticas']
                ],
                [
                    'name' => 'Access to Mailchimp',
                    'icon' => 'fa-solid fa-envelope',
                    'urlName' => 'admin.setting.access-mailchimp',
                    'active' => 'admin.setting.access-mailchimp',
                    'canany' => ['accesos mailchimp']
                ],
                [
                    'name' => 'Access to Google',
                    'icon' => 'fa-brands fa-google',
                    'urlName' => 'admin.setting.access-google',
                    'active' => 'admin.setting.access-google',
                    'canany' => ['accesos google']
                ],
            ]
        ],
    ],
];
