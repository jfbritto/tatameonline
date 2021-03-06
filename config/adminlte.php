<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Sistema de gerenciamento de academias de luta',

    'title_prefix' => 'TaTameOnline | ',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>TaTame</b>Online',

    'logo_mini' => '<b>TT</b>On',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | light variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => 'top-nav',

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we have the option to enable a right sidebar.
    | When active, you can use @section('right-sidebar')
    | The icon you configured will be displayed at the end of the top menu,
    | and will show/hide de sidebar.
    | The slide option will slide the sidebar over the content, while false
    | will push the content, and have no animation.
    | You can also choose the sidebar theme (dark or light).
    | The right Sidebar can only be used if layout is not top-nav.
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and a URL. You can also specify an icon from Font
    | Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    */

    'menu' => [
        // [
        //     'text' => 'search',
        //     'search' => false,
        // ],

        //********* */
        //** ROOT ***/
        //********* */
        ['header' => 'ROOT', 'can'  => 'root'],

        [
            'text'        => 'Home',
            'url'         => 'root',
            'icon' => 'fas fa-home',
            'can'  => 'root',
        ],
        [
            'text'        => 'Academias',
            'url'         => 'root/academy',
            'icon' => 'fas fa-briefcase',
            'can'  => 'root',
        ],
        [
            'text'        => 'Esportes',
            'url'         => 'root/sport',
            'icon' => 'fas fa-futbol',
            'can'  => 'root',
        ],
        [
            'text'        => 'Bugs',
            'url'         => 'root/bug',
            'icon' => 'fas fa-bug',
            'can'  => 'root',
        ],

        //********* */
        //* ADMIN ***/
        //********* */
        ['header' => 'ADMINISTRADOR', 'can'  => 'admin'],

        [
            'text'        => 'Home',
            'url'         => 'admin',
            'icon' => 'fas fa-home',
            'can'  => 'admin',
        ],
        [
            'text'        => 'Alunos',
            'url'         => 'admin/student',
            'icon' => 'fas fa-user-graduate',
            'can'  => 'admin',
        ],
        [
            'text'        => 'Instrutores',
            'url'         => 'admin/instructor',
            'icon' => 'fas fa-user-graduate',
            'can'  => 'admin',
        ],
        [
            'text'        => 'Aulas',
            'url'         => 'admin/lesson',
            'icon' => 'fas fa-users',
            'can'  => 'admin',
        ],
        [
            'text'        => 'Graduações',
            'url'         => 'admin/graduation',
            'icon' => 'fas fa-graduation-cap',
            'can'  => 'admin',
        ],
        [
            'text'        => 'Financeiro',
            'url'         => 'admin/financial',
            'icon' => 'fas fa-dollar-sign',
            'can'  => 'admin',
        ],
        [
            'text'        => 'Bugs',
            'url'         => 'admin/bug',
            'icon' => 'fas fa-bug',
            'can'  => 'admin',
        ],

        //************** */
        //* INSTRUTOR ***/
        //************* */
        ['header' => 'INSTRUTOR', 'can'  => 'instructor'],

        [
            'text'        => 'Home',
            'url'         => 'instructor',
            'icon' => 'fas fa-home',
            'can'  => 'instructor',
        ],
        [
            'text'        => 'Alunos',
            'url'         => 'instructor/student',
            'icon' => 'fas fa-user-graduate',
            'can'  => 'instructor',
        ],
        [
            'text'        => 'Aulas',
            'url'         => 'instructor/lesson',
            'icon' => 'fas fa-users',
            'can'  => 'instructor',
        ],
        [
            'text'        => 'Bugs',
            'url'         => 'instructor/bug',
            'icon' => 'fas fa-bug',
            'can'  => 'instructor',
        ],

        //********** */
        //** ALUNO ***/
        //********** */
        ['header' => 'ALUNO', 'can'  => 'student'],

        [
            'text'        => 'Home',
            'url'         => 'student',
            'icon' => 'fas fa-home',
            'can'  => 'student',
        ],
        [
            'text'        => 'Aulas',
            'url'         => 'student/lesson',
            'icon' => 'fas fa-users',
            'can'  => 'student',
        ],
        [
            'text'        => 'Graduações',
            'url'         => 'student/graduation',
            'icon' => 'fas fa-graduation-cap',
            'can'  => 'student',
        ],
        [
            'text'        => 'Financeiro',
            'url'         => 'student/financial',
            'icon' => 'fas fa-dollar-sign',
            'can'  => 'student',
        ],
        [
            'text'        => 'Bugs',
            'url'         => 'student/bug',
            'icon' => 'fas fa-bug',
            'can'  => 'student',
        ],

        // [
        //     'text'        => 'Aulas',
        //     'url'         => 'admin/pages',
        //     // 'icon'        => 'fas fa-fw fa-share',
        //     // 'label'       => 4,
        //     // 'label_color' => 'success',
        //     'can'  => 'admin',
        // ],
        // ['header' => 'account_settings'],
        // [
        //     'text' => 'profile',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-user',
        // ],
        // [
        //     'text' => 'change_password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        // [
        //     'text'    => 'multilevel',
        //     'icon'    => 'fas fa-fw fa-share',
        //     'submenu' => [
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'level_one',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'level_two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'level_two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'level_three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'level_one',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
        // ['header' => 'labels'],
        // [
        //     'text'       => 'important',
        //     'icon_color' => 'red',
        // ],
        // [
        //     'text'       => 'warning',
        //     'icon_color' => 'yellow',
        // ],
        // [
        //     'text'       => 'information',
        //     'icon_color' => 'aqua',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Configure which JavaScript plugins should be included. At this moment,
    | DataTables, Select2, Chartjs and SweetAlert are added out-of-the-box,
    | including the Javascript and CSS files from a CDN via script and link tag.
    | Plugin Name, active status and files array (even empty) are required.
    | Files, when added, need to have type (js or css), asset (true or false) and location (string).
    | When asset is set to true, the location will be output using asset() function.
    |
    */

    'plugins' => [
        [
            'name' => 'Datatables',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.css',
                ],
            ],
        ],
        [
            'name' => 'Select2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        [
            'name' => 'Chartjs',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        [
            'name' => 'Sweetalert2',
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//unpkg.com/sweetalert/dist/sweetalert.min.js',
                ],
            ],
        ],
        [
            'name' => 'Pace',
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],
];
