<?php

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=yii2advanced',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\sendinblue\transactional\Mailer::class,
            'apikey' => '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',
        ],
    ],
];
