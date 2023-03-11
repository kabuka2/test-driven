<?php

use app\template\TemplateTwig;
use app\template\Template;

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
                'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css',
                '../css/main.css',
                'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css',
            ],
            'js' => [
                'https://code.jquery.com/jquery-3.6.3.min.js',
                'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js',
                '../js/main.js',
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