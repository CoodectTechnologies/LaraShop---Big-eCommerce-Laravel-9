<?php

return [
    [
        'section' => [
            'name' => 'Dashboard',
            'modules' => [
                [
                    'name' => 'Dashboards',
                    'icon' => 'fa fa-dashboard',
                    'urlName' => null,
                    'active' => 'admin.dashboard*',
                    'canany' => [null, 'ordenes', 'blog', 'correos'],
                    'submodules' => [
                        [
                            'name' => 'General',
                            'urlName' => 'admin.dashboard.general.index',
                            'active' => 'admin.dashboard.general*',
                            'canany' => [null],
                            'submodules' => []
                        ],
                        [
                            'name' => 'E-Commerce',
                            'urlName' => 'admin.dashboard.order.index',
                            'active' => 'admin.dashboard.order*',
                            'canany' => ['ordenes'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Blog',
                            'urlName' => 'admin.dashboard.blog.index',
                            'active' => 'admin.dashboard.blog*',
                            'canany' => ['blog'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Webmails',
                            'urlName' => 'admin.dashboard.email-web.index',
                            'active' => 'admin.dashboard.email-web*',
                            'canany' => ['correos'],
                            'submodules' => []
                        ],
                    ]
                ],
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'Web',
            'modules' => [
                [
                    'name' => 'Banner',
                    'icon' => 'fa-regular fa-image',
                    'urlName' => 'admin.banner.index',
                    'active' => 'admin.banner*',
                    'canany' => ['banners'],
                    'submodules' => []
                ],
                [
                    'name' => 'Gallery',
                    'icon' => 'fa-regular fa-images',
                    'urlName' => 'admin.gallery.index',
                    'active' => 'admin.gallery*',
                    'canany' => ['galería'],
                    'submodules' => []
                ],
                [
                    'name' => 'About',
                    'icon' => 'fa-regular fa-user',
                    'urlName' => 'admin.about.index',
                    'active' => 'admin.about*',
                    'canany' => ['nosotros'],
                    'submodules' => []
                ],
                [
                    'name' => 'Partners',
                    'icon' => 'fa-solid fa-user-circle',
                    'urlName' => 'admin.partner.index',
                    'active' => 'admin.partner*',
                    'canany' => ['socios'],
                    'submodules' => []
                ],
                [
                    'name' => 'Frequent questions',
                    'icon' => 'fa-solid fa-circle-question',
                    'urlName' => 'admin.question-answer.index',
                    'active' => 'admin.question-answer*',
                    'canany' => ['preguntas y respuestas'],
                    'submodules' => []
                ],
                [
                    'name' => 'Subscribers',
                    'icon' => 'fa-regular fa-user',
                    'urlName' => 'admin.subscriber.index',
                    'active' => 'admin.subscriber*',
                    'canany' => ['subscriptores'],
                    'submodules' => []
                ],
                [
                    'name' => 'Webmails',
                    'icon' => 'fa-solid fa-envelopes-bulk',
                    'urlName' => 'admin.email-web.index',
                    'active' => 'admin.email-web*',
                    'canany' => ['correos'],
                    'submodules' => []
                ],
                [
                    'name' => 'Blog',
                    'icon' => 'fa-solid fa-blog',
                    'urlName' => null,
                    'active' => 'admin.blog*',
                    'canany' => ['blog', 'blog categorías', 'blog etiquetas'],
                    'submodules' => [
                        [
                            'name' => 'Posts',
                            'urlName' => 'admin.blog.post.index',
                            'active' => 'admin.blog.post*',
                            'canany' => ['blog'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Categories',
                            'urlName' => 'admin.blog.category.index',
                            'active' => 'admin.blog.category*',
                            'canany' => ['blog categorías'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Tags',
                            'urlName' => 'admin.blog.tag.index',
                            'active' => 'admin.blog.tag*',
                            'canany' => ['blog etiquetas'],
                            'submodules' => []
                        ],
                    ]
                ],
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'E-Commerce',
            'modules' => [
                [
                    'name' => 'Orders',
                    'icon' => 'fa-solid fa-bag-shopping',
                    'urlName' => 'admin.order.index',
                    'active' => 'admin.order*',
                    'canany' => ['ordenes'],
                    'submodules' => []
                ],
                [
                    'name' => 'Catalog',
                    'icon' => 'fa-solid fa-cart-shopping',
                    'urlName' => null,
                    'active' => 'admin.catalog*',
                    'canany' => ['productos', 'producto categorías', 'producto marcas', 'producto géneros'],
                    'submodules' => [
                        [
                            'name' => 'Products',
                            'urlName' => 'admin.catalog.product.index',
                            'active' => 'admin.catalog.product*',
                            'canany' => ['productos'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Categories',
                            'urlName' => 'admin.catalog.category.index',
                            'active' => 'admin.catalog.category*',
                            'canany' => ['producto categorías'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Brands',
                            'urlName' => 'admin.catalog.brand.index',
                            'active' => 'admin.catalog.brand*',
                            'canany' => ['producto marcas'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Genders',
                            'urlName' => 'admin.catalog.gender.index',
                            'active' => 'admin.catalog.gender*',
                            'canany' => ['producto géneros'],
                            'submodules' => []
                        ],

                    ]
                ],
                [
                    'name' => 'Configurator PC',
                    'icon' => 'fa-solid fa-laptop-code',
                    'urlName' => null,
                    'active' => 'admin.configurator*',
                    'canany' => ['configurador pasos', 'configurador compatibilidades', 'configurador rendimiento'],
                    'submodules' => [
                        [
                            'name' => 'Stages',
                            'urlName' => 'admin.configurator.stage.index',
                            'active' => 'admin.configurator.stage*',
                            'canany' => ['configurador pasos'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Compatibilities',
                            'urlName' => 'admin.configurator.compatibility.index',
                            'active' => 'admin.configurator.compatibility*',
                            'canany' => ['configurador compatibilidades'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Budgets',
                            'urlName' => 'admin.configurator.budget.index',
                            'active' => 'admin.configurator.budget*',
                            'canany' => ['configurador rangos'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Rendimientos',
                            'urlName' => 'admin.configurator.performance.index',
                            'active' => 'admin.configurator.performance*',
                            'canany' => ['configurador rendimiento'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'Juegos',
                            'urlName' => 'admin.configurator.game.index',
                            'active' => 'admin.configurator.game*',
                            'canany' => ['configurador juegos'],
                            'submodules' => []
                        ],
                        [
                            'name' => 'FPS',
                            'urlName' => 'admin.configurator.fps.index',
                            'active' => 'admin.configurator.fps*',
                            'canany' => ['configurador fps'],
                            'submodules' => []
                        ]
                    ]
                ],
                [
                    'name' => 'Wholesale',
                    'icon' => 'fa-solid fa-box-open',
                    'urlName' => 'admin.wholesale.index',
                    'active' => 'admin.wholesale.*',
                    'canany' => ['mayoreo'],
                    'submodules' => []
                ],
                [
                    'name' => 'Promotions',
                    'icon' => 'fa-solid fa-percent',
                    'urlName' => 'admin.promotion.index',
                    'active' => 'admin.promotion.*',
                    'canany' => ['promociones'],
                    'submodules' => []
                ],
                [
                    'name' => 'Coupons',
                    'icon' => 'fa-solid fa-ticket',
                    'urlName' => 'admin.coupon.index',
                    'active' => 'admin.coupon.*',
                    'canany' => ['cupones'],
                    'submodules' => []
                ],
                [
                    'name' => 'Shipping zones',
                    'icon' => 'fa-solid fa-truck',
                    'urlName' => 'admin.setting.shipping-zone.index',
                    'active' => 'admin.setting.shipping-zone*',
                    'canany' => ['zonas de envío'],
                    'submodules' => []
                ],
                [
                    'name' => 'Shipping classes',
                    'icon' => 'fa-solid fa-tag',
                    'urlName' => 'admin.setting.shipping-class',
                    'active' => 'admin.setting.shipping-class',
                    'canany' => ['clases de envío'],
                    'submodules' => []
                ],
                [
                    'name' => 'Countries',
                    'icon' => 'fa-solid fa-earth-americas',
                    'urlName' => 'admin.setting.country',
                    'active' => 'admin.setting.country',
                    'canany' => ['países'],
                    'submodules' => []
                ],
                [
                    'name' => 'States',
                    'icon' => 'fa-solid fa-map',
                    'urlName' => 'admin.setting.state',
                    'active' => 'admin.setting.state',
                    'canany' => ['estados'],
                    'submodules' => []
                ],
                [
                    'name' => 'Cities',
                    'icon' => 'fa-solid fa-city',
                    'urlName' => 'admin.setting.city',
                    'active' => 'admin.setting.city',
                    'canany' => ['ciudades'],
                    'submodules' => []
                ],
                [
                    'name' => 'Analytic search',
                    'icon' => 'fa-solid fa-chart-simple',
                    'urlName' => 'admin.analytic-search.index',
                    'active' => 'admin.analytic-search*',
                    'canany' => ['analytic search'],
                    'submodules' => []
                ],
            ]
        ],
    ],
    [
        'section' => [
            'name' => 'Settings',
            'modules' => [
                [
                    'name' => 'Users',
                    'icon' => 'fa-solid fa-users',
                    'urlName' => 'admin.user.index',
                    'active' => 'admin.user*',
                    'canany' => ['usuarios'],
                    'submodules' => []
                ],
                [
                    'name' => 'Configuration',
                    'icon' => 'fa-solid fa-gear',
                    'urlName' => 'admin.setting.welcome',
                    'active' => 'admin.setting*',
                    'canany' => [null],
                    'submodules' => []
                ]
            ]
        ],
    ],
];
