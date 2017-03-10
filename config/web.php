<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['admin'],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@app/views' => [
                        '@app/themes',
                        '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app',
                    ],
                    '@dektrium/user/views' => '@app/themes/user',
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'iiMX2qWn0MmQSGnFwGj0PQ6v3Cfx6SWA',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
            'defaultRoles' => ['user'], //role biasa
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'zyx\phpmailer\Mailer',
            'viewPath' => '@app/mail',
            'useFileTransport' => false,
            'config' => [
                'mailer' => 'smtp',
                'host' => 'serverus1.computesta.com',
                'port' => '465',
                'smtpsecure' => 'ssl',
                'smtpauth' => true,
                'username' => 'test@project.computesta.com',
                'password' => 'test123!',
            ],
            'messageConfig' => [
                'from' => ['test@project.computesta.com']
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    
      'urlManager' => [
      'enablePrettyUrl' => true,
      'showScriptName' => false,
      'rules' => [
      ],
      ],
     
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*', //untuk setting role admin diawal
            'user/*', //untuk setting user diawal
        ]
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'], //['admin'] harus sesuai dengan username
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => '@app/themes/layouts/main',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'],
        'generators' => [
            'computestaModel' => [
                'class' => 'app\components\model\Generator',
                'templates' => [
                    'computesta' => '@app/components/model/default',
                ]
            ],
            'computestaAjaxcrud' => [
                'class' => 'app\components\ajaxcrud\Generator',
                'templates' => [
                    'computestaAjaxcrud' => '@app/components/ajaxcrud/default',
                ]
            ]
        ],
    ];
}

return $config;
