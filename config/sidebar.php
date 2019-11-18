<?php

return [
    'system' => [
        'roles' => \App\Models\Role::ACCOUNT,
        'icon'  => 'remixicon-lock-2-line',
        'slug'  => '帳號管理',
        'route'  => 'accounts.index',
//        'items' => [
//            'roles'       => [
//                'slug'  => 'backend.setting.role',
//                'route' => 'roles.index',
//                'href'  => '#',
//            ],
//            'permissions' => [
//                'slug'  => 'backend.setting.permission',
//                'route' => 'permissions.index',
//                'href'  => '#',
//            ],
//            'users'       => [
//                'slug'  => 'backend.setting.account',
//                'route' => 'accounts.index',
//                'href'  => '#',
//            ],
//        ]
    ],

    'account' => [
        'roles' => \App\Models\Role::CATEGORY,
        'icon'  => 'remixicon-dashboard-line',
        'slug'  => '節目分類管理',
        'route'  => 'categories.index',
//        'items' => [
//            'user'  => [
//                'slug' => '使用者管理',
//                'href' => '#',
//            ],
//            'api'   => [
//                'slug' => 'API管理',
//                'href' => '#',
//            ],
//            'other' => [
//                'slug' => '附加功能管理',
//                'href' => '#',
//            ],
//            'point' => [
//                'slug' => '金額/點數',
//                'href' => '#',
//            ]
//        ]
    ],

    'edm' => [
        'roles' => \App\Models\Role::PROGRAM,
        'icon'  => 'remixicon-mail-open-line',
        'slug'  => '節目內容管理',
        'route'  => 'programs.index',
//        'items' => [
//            'user'  => [
//                'slug' => '電子郵件發送',
//                'href' => '#',
//            ],
//            'api'   => [
//                'slug' => '發送進度',
//                'href' => '#',
//            ],
//            'other' => [
//                'slug' => '電子郵件報表',
//                'href' => '#',
//            ],
//            'point' => [
//                'slug' => '無效名單報表',
//                'href' => '#',
//            ]
//        ]
    ],

    'message' => [
        'roles' => \App\Models\Role::NEWS,
        'icon'  => 'remixicon-discuss-line',
        'slug'  => '最新消息管理',
        'route'  => 'news.index',
//        'items' => [
//            'message' => [
//                'slug' => '簡訊發送',
//                'href' => '#',
//            ],
//            'api'     => [
//                'slug' => '發送進度',
//                'href' => '#',
//            ],
//            'report'  => [
//                'slug' => '簡訊報表',
//                'href' => '#',
//            ]
//        ]
    ],

    'app' => [
        'roles' => \App\Models\Role::PUSH,
        'icon'  => 'remixicon-rocket-2-line',
        'badge' => 'Hot',
        'slug'  => '推播管理',
        'route'  => 'pushs.index',
//        'items' => [
//            'category'    => [
//                'slug' => '分類標籤管理',
//                'href' => '#',
//            ],
//            'upload_fb'   => [
//                'slug' => '名單上傳FB',
//                'href' => '#',
//            ],
//            'tags'        => [
//                'slug' => '產生開信/分類標籤名單',
//                'href' => '#',
//            ],
//            'remarketing' => [
//                'slug' => '購物車再行銷',
//                'href' => '#',
//            ],
//            'point'       => [
//                'slug' => '統計圖表',
//                'href' => '#',
//            ]
//        ]
    ],
];
