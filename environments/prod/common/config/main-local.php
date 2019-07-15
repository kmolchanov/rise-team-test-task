<?php
return [
    'components' => [
        'mongodb' => [
            'class' => '\yii\mongodb\Connection',
            'dsn' => 'mongodb://@localhost:27017/rise-team-test-task',
            'options' => [
                "username" => "rise-team-test-task",
                "password" => "rise-team-test-task"
            ]
        ],
    ],
];
