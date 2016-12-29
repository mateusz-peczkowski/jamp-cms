<?php

return array(

    'template' => array(
        'client_name'       =>  'JAMPsystem',
        // 'name'              => 'webreligion.co based on jampsystem v1.8',
        'name'              => 'JAMPsystem based on jampsystem v1.8',
        'signature'         =>  'Created for JAMPsystem<br><span id="year-copy"></span> &copy; <a href="http://jampstudio.pl" target="_blank">jampstudio.pl</a> based on <a href="http://system.jampstudio.pl" target="_blank">jampsystem v1.8</a>',
        'version'           => '',
        'author'            => 'JAMPsystem',
        'robots'            => 'noindex, nofollow',
        'meta_title'             => 'JAMPsystem - Admin Panel',
        'title'             => '<img src="/backend/jampsystem/jampsystem.png" title="JAMPsystem" />',
        'description'       => '',
        'page_preloader'    => true,
        // 'page_preloader'    => false,
        // 'navbar-default'             for a light header
        // 'navbar-inverse'             for a dark header
        'header_navbar'     => 'navbar-inverse',
        // ''                           empty for a static header/main sidebar
        // 'navbar-fixed-top'           for a top fixed header/sidebars
        // 'navbar-fixed-bottom'        for a bottom fixed header/sidebars
        'header'            => 'navbar-fixed-top',
        // ''                           empty for the default full width layout
        // 'fixed-width'                for a fixed width layout (can only be used with a static header/main sidebar)
        'layout'            => '',
        // 'sidebar-visible-lg-mini'    main sidebar condensed - Mini Navigation (> 991px)
        // 'sidebar-visible-lg-full'    main sidebar full - Full Navigation (> 991px)
        // 'sidebar-alt-visible-lg'     alternative sidebar visible by default (> 991px) (You can add it along with another class - leaving a space between)
        // 'sidebar-light'              for a light main sidebar (You can add it along with another class - leaving a space between)
        'sidebar'           => 'sidebar-visible-lg-full',
        // ''                           Disable cookies (best for setting an active color theme from the next variable)
        // 'enable-cookies'             Enables cookies for remembering active color theme when changed from the sidebar links (the next color theme variable will be ignored)
        'cookies'           => '',
        // '', 'classy', 'social', 'flat', 'amethyst', 'creme', 'passion'
        'theme'             => '',
        // Used as the text for the header link - You can set a value in each page if you like to enable it in the header
        'header_link'       => '',
        // The name of the files in the inc/ folder to be included in page_head.php - Can be changed per page if you
        // would like to have a different file included (eg a different alternative sidebar)
        'inc_sidebar'       => 'page_sidebar',
        'inc_sidebar_alt'   => 'page_sidebar_alt',
        'inc_header'        => 'page_header',
        // The following variable is used for setting the active link in the sidebar menu
        // 'active_page'       => basename($_SERVER['PHP_SELF'])
    ),

    /* Primary navigation array (the primary navigation will be created automatically based on this array, up to 3 levels deep) */
    // $primary_nav = array(
    'navigation' => array(
        array(
            'type'  =>  'separator',
            // 'url'   => 'separator',
        ),
        array(
            'name'  => trans('backend.page.index'),
            'controller'    =>  'Backend_PagesController',
            'action'        =>  'index',
            'sub'   =>  array(
                array(
                    'name'  => trans('backend.page.edit'),
                    'controller'    =>  'Backend_PagesController',
                    'action'        =>  'edit',
                    'visible'       =>  false,
                    ),
                array(
                    'name'          =>  trans('backend.page.create'),
                    'controller'    =>  'Backend_PagesController',
                    'action'        =>  'create',
                    'visible'       =>  false,
                    ),
                array(
                    'name'  => trans('backend.page.galleries'),
                    'controller'    =>  'Backend_PagesController',
                    'action'        =>  'galleries',
                    'visible'       =>  false,
                    ),
                 array(
                    'name'  => trans('backend.page.articles'),
                    'controller'    =>  'Backend_PagesController',
                    'action'        =>  'articles',
                    'visible'       =>  false,
                    ),
                array(
                    'name'  => trans('backend.page.advanced'),
                    'controller'    =>  'Backend_PagesController',
                    'action'        =>  'advanced',
                    'visible'       =>  false,
                    ),
                array(
                    'name'  => trans('backend.page.meta'),
                    'controller'    =>  'Backend_PagesController',
                    'action'        =>  'meta',
                    'visible'       =>  false,
                    ),
                array(
                    'name'          =>  trans('backend.additional_data.title'),
                    'controller'    =>  'Backend_PagesController',
                    'action'        =>  'additional_data',
                    'visible'       =>  false,
                ),
            ),
            'icon'  => 'fa fa-rocket',
        ),
        array(
            'name'  => trans('backend.home'),
            'controller'   => 'Backend_LoginController',
            'action'   => 'index',
            'icon'  => 'gi gi-compass'
        ),
        array(
            'name'  => trans('backend.article.index'),
            'controller'    =>  'Backend_ArticlesController',
            'action'        =>  'index',
            'sub'   =>  array(
                array(
                    'name'  => trans('backend.article.edit'),
                    'controller'    =>  'Backend_ArticlesController',
                    'action'        =>  'edit',
                    'visible'       =>  false,
                    ),
                array(
                    'name'  => trans('backend.article.galleries'),
                    'controller'    =>  'Backend_ArticlesController',
                    'action'        =>  'galleries',
                    'visible'       =>  false,
                    ),
                array(
                    'name'          =>  trans('backend.article.create'),
                    'controller'    =>  'Backend_ArticlesController',
                    'action'        =>  'create',
                    'visible'       =>  false,
                ),
                array(
                    'name'          =>  trans('backend.additional_data.title'),
                    'controller'    =>  'Backend_ArticlesController',
                    'action'        =>  'additional_data',
                    'visible'       =>  false,
                ),
            ),
            'icon'  => 'fa fa-archive',
        ),
        array(
            'name'  => trans('backend.modules.show'),
            'icon'  => 'gi gi-airplane',
            'sub'   => array(
                // array(
                //     'name'  => trans('backend.news.index'),
                //     'controller'    =>  'Backend_NewsController',
                //     'action'        =>  'index',
                //     'sub'   =>  array(
                //         array(
                //             'name'          =>  trans('backend.news.edit'),
                //             'controller'    =>  'Backend_NewsController',
                //             'action'        =>  'edit',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.news.create'),
                //             'controller'    =>  'Backend_NewsController',
                //             'action'        =>  'create',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.news.galleries'),
                //             'controller'    =>  'Backend_NewsController',
                //             'action'        =>  'galleries',
                //             'visible'       =>  false,
                //             ),
                //     ),
                // ),
                // array(
                //     'name'  => trans('backend.press.index'),
                //     'controller'    =>  'Backend_PressesController',
                //     'action'        =>  'index',
                //     'sub'   =>  array(
                //         array(
                //             'name'          =>  trans('backend.press.edit'),
                //             'controller'    =>  'Backend_PressesController',
                //             'action'        =>  'edit',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.press.create'),
                //             'controller'    =>  'Backend_PressesController',
                //             'action'        =>  'create',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.automotive.galleries'),
                //             'controller'    =>  'Backend_PressesController',
                //             'action'        =>  'galleries',
                //             'visible'       =>  false,
                //             ),
                //     ),
                // ),
                // array(
                //     'name'  => trans('backend.product.index'),
                //     'controller'    =>  'Backend_ProductsController',
                //     'action'        =>  'index',
                //     'sub'   =>  array(
                //         array(
                //             'name'          =>  trans('backend.product.edit'),
                //             'controller'    =>  'Backend_ProductsController',
                //             'action'        =>  'edit',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.product.create'),
                //             'controller'    =>  'Backend_ProductsController',
                //             'action'        =>  'create',
                //             'visible'       =>  false,
                //             ),
                //     ),
                //     // 'url'   => action('Backend_PartnersController@index'),
                // ),
                // array(
                //     'name'  => trans('backend.team.index'),
                //     'controller'    =>  'Backend_TeamsController',
                //     'action'        =>  'index',
                //     'sub'   =>  array(
                //         array(
                //             'name'          =>  trans('backend.team.edit'),
                //             'controller'    =>  'Backend_TeamsController',
                //             'action'        =>  'edit',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.team.create'),
                //             'controller'    =>  'Backend_TeamsController',
                //             'action'        =>  'create',
                //             'visible'       =>  false,
                //             ),
                //     ),
                //     // 'url'   => action('Backend_TeamsController@index'),
                // ),
                //  array(
                //     'name'  => trans('backend.faqcategory.index'),
                //     'controller'    =>  'Backend_FaqCategoriesController',
                //     'action'        =>  'index',
                //     'sub'   =>  array(
                //         array(
                //             'name'          =>  trans('backend.faqcategory.index'),
                //             'controller'    =>  'Backend_FaqCategoriesController',
                //             'action'        =>  'index',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.faqcategory.show'),
                //             'controller'    =>  'Backend_FaqCategoriesController',
                //             'action'        =>  'show',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.faqcategory.edit'),
                //             'controller'    =>  'Backend_FaqCategoriesController',
                //             'action'        =>  'edit',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.faqcategory.create'),
                //             'controller'    =>  'Backend_FaqCategoriesController',
                //             'action'        =>  'create',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.faq.edit'),
                //             'controller'    =>  'Backend_FaqsController',
                //             'action'        =>  'edit',
                //             'visible'       =>  false,
                //             ),
                //         array(
                //             'name'          =>  trans('backend.faq.create'),
                //             'controller'    =>  'Backend_FaqsController',
                //             'action'        =>  'create',
                //             'visible'       =>  false,
                //             ),
                //     ),
                // ),
            ),
        ),

        array(
            'name'  => trans('backend.form.index'),
            'icon'  => 'gi gi-more_items',
            'sub'   => array(
                array(
                    'name'  => trans('backend.form.definitions'),
                    'controller'    =>  'Backend_FormsController',
                    'action'        =>  'index',
                    'params'        =>  array('all'),
                    'sub'   =>  array(
                        array(
                            'name'          =>  trans('backend.form.edit'),
                            'controller'    =>  'Backend_FormsController',
                            'action'        =>  'edit',
                            'visible'       =>  false,
                        ),
                        array(
                            'name'          =>  trans('backend.form.create'),
                            'controller'    =>  'Backend_FormsController',
                            'action'        =>  'create',
                            'visible'       =>  false,
                        ),
                        array(
                            'name'          =>  trans('backend.formcontrol.index'),
                            'visible'       =>  false,
                            'sub'   =>  array(
                                array(
                                    'name'          =>  trans('backend.formcontrol.edit'),
                                    'controller'    =>  'Backend_FormControlsController',
                                    'action'        =>  'edit',
                                    'visible'       =>  false,
                                ),
                                array(
                                    'name'          =>  trans('backend.formcontrol.create'),
                                    'controller'    =>  'Backend_FormControlsController',
                                    'action'        =>  'create',
                                    'visible'       =>  false,
                                ),
                            ),
                       ),
                    ),
                ),
                array(
                    'name'  => trans('backend.form.sent'),
                    'controller'    =>  'Backend_FormSubmitsController',
                    'action'        =>  'index',
                    'params'        =>  array('all'),
                    // 'url'   =>  action('Backend_FormSubmitsController@index', array('all')),
                    'sub'   =>  array(
                        array(
                            'name'          =>  trans('backend.formsubmit.show'),
                            'controller'    =>  'Backend_FormSubmitsController',
                            'action'        =>  'show',
                            'visible'       =>  false,
                            ),
                ),
                ),  
                
            ),
        ),

        array(
            'name'  => trans('backend.configuration.index'),
            // 'controller'    =>  'Backend_AutomotivesController',
            // 'action'        =>  'index',
            'icon'  => 'fa fa-cogs',
            'sub'   =>  array(
                array(
                    'name'          =>  trans('backend.default.index'),
                    'controller'    =>  'Backend_DefaultsController',
                    'action'        =>  'index',
                    // 'visible'       =>  false,
                     'sub'   =>  array(
                        array(
                            'name'          =>  trans('backend.default.meta'),
                            'controller'    =>  'Backend_DefaultsController',
                            'action'        =>  'meta',
                            'visible'       =>  false,
                            ),
                    ),
                ),
                array(
                    'name'  => trans('backend.modredirect.index'),
                    'controller'    =>  'Backend_ModredirectsController',
                    'action'        =>  'index',
                ),
                array(
                    'name'  => trans('backend.languagekey.index'),
                    'controller'    =>  'Backend_LanguageKeysController',
                    'action'        =>  'index',
                ),


            ),
        ),
        array(
            'type'  =>  'separator',
            // 'url'   => 'separator',
        ),

        array(
            'name'  => trans('backend.trash.index'),
            'controller'    =>  'Backend_TrashController',
            'action'        =>  'index',
            'icon'  => 'fa fa-trash',
        ),

    ),
    'icons' =>  array(
            'create'    =>  'fa fa-plus',
            'edit'      =>  'fa fa-pencil',
            'destroyever'   =>  'fa fa-trash',
            'destroy'   =>  'fa fa-trash',
            'restore'   =>  'fa fa-repeat',
            'delete'   =>  'fa fa-trash',
            'check_delete'   =>  'fa fa-trash',
            'preview'   =>  'fa fa-search-plus',
            'activate'   =>  'fa fa-check-circle',
            'deactivate'   =>  'fa fa-times-circle',
            'check_deactivate'   =>  'fa fa-times-circle',
        ),

    'toolbar'   => array(
        'buttons'   =>  array(
            'create'    =>  'fa fa-plus',
            'edit'      =>  'fa fa-pencil',
            'destroyever'   =>  'fa fa-trash',
            'destroy'   =>  'fa fa-trash',
            'delete'    =>  'fa fa-trash',
            'restore'    =>  'fa fa-repeat',
            'check_delete'   =>  'fa fa-trash',
            'activate'   =>  'fa fa-check-circle',
            'deactivate'   =>  'fa fa-times-circle',
            'check_deactivate'   =>  'fa fa-times-circle',
            'show'  =>  'fa fa-search',
            ),
        ),
    'system'    =>  array(
        'url'   =>  'http://system.jampstudio.pl',
        ),
);

?>