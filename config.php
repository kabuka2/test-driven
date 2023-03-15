<?php

use app\Template\TemplateTwig;
use app\Template\Template;

return  [
        'is_develop' => false,
        'urlManager' => [
            'base_url' => 'site/index',
            '404' => '/error_404',
            'route' => [
                '/test'      => 'site/index',
                '/error_404' => 'site/error404',
                '/save_user' => 'site/saveUser'
            ],
        ],
        'base_path' => __DIR__.DIRECTORY_SEPARATOR,
        'path_to_save_files' => __DIR__.DIRECTORY_SEPARATOR.'files_save'.DIRECTORY_SEPARATOR,
        'dist' => [
            'css' => [
                '../css/main.css',

            ],
            'js' => [
                '../js/main.js',
            ],
            'fonts' => [
                '../fonts/bootstrap-icons.woff'
            ],
        ],
        'view'=> [
            'render_class'=> TemplateTwig::class, // ||TemplateTwig::class,
            Template::class => [ // default php
                'path_view' => sprintf('%sresources%sview%sphp%s',
                    __DIR__.DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR
                ),
                'layout' => 'main',
            ],

            TemplateTwig::class => [ // twig
                'cache' => sprintf('%sresources%scache%spage%s',
                    __DIR__.DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR
                ),
                'path_view' => sprintf('%sresources%sview%stwig%s',
                    __DIR__.DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR,
                    DIRECTORY_SEPARATOR,

                ),
                'auto_reload' => true, // bool - recompile the template whenever the source code changes
                'strict_variables' => true,// ignore variables
                'debug' => false,
                'charset' => 'utf-8',
                'autoescape' => false,
                'optimizations' => 0, // 0 || 1
                'layout' => 'main',
            ],
        ],

    ];