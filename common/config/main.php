<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__.'/../../vendor/yiisoft/extensions.php'),
    'modules' => [
        'social' => [
            'class' => 'kartik\social\Module',
            'disqus' => [
                'settings' => ['shortname' => 'DISQUS_SHORTNAME']
            ],
        ],
        'facebook' => [
            'appId' => '1470370433278988',
            'secret' => '76086a9f0a630b3ce3a7fc372ed4ceba',
        ]
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mycomponent' => [
            'class' => 'components\MyComponent',
        ],
        'faqwidget' => [
            'class' => 'components\FaqWidget',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '1470370433278988',
                    'clientSecret' => '76086a9f0a630b3ce3a7fc372ed4ceba',
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => '1061969384369-hiv2uq68b5vi41a10e9qn36mimt54akg.apps.googleusercontent.com',
                    'clientSecret' => 'lwPsHkjbs9UsmSPUF9ZXxBsT',
                ]
            ]
        ],
    ],
    
//    'authClientCollection' => [
//        'class' => 'yii\authclient\Collection',
//        'clients' => [
//            'facebook' => [
//                'class' => 'yii\authclient\Facebook',
//                'clientId' => 'your client id',
//                'clientSecret' => 'your client secret',
//            ],
//        ],
//    ],
];
