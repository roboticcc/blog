<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'rules' => [
                '<action:>' => 'site/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
            'showScriptName' => false,
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'transport' => [
//                'scheme' => 'smtp',
//                'host' => 'smtp-relay.sendinblue.com',
                'username' => 'cosmeanq@gmail.com',
                'password' => '6BnEcrRxDFYvszgw',
                'port' => 587,
            ],
            'useFileTransport' => false,
        ],
    ],
];
