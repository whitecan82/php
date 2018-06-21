<?php

namespace app\db;
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:'.dirname(__FILE__).'/../dbData/TEST.db',
    // 'username' => 'root',
    // 'password' => 'root',
    'charset' => 'utf8',

    // 'connectionString' => ,


    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
