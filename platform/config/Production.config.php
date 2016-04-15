<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.14
 * Time: 13:29
 */
return [
    /** Полдключение к базе данных может быть несколько конектов */
    'databases' => [
        PlatformDatabasesEnum::databasesDefault()->getId() => [
            'connector' => 'PgSQL',
            'host' => '192.168.5.60:6432',
            'bases' => 'pcms',
            'user' => 'pcms',
            'pass' => ''
        ]
    ],
    /** SMS сервис */
    'smsService' => [
        'host' => 'smsxml.chudotelecom.ru',
        'path' => '/',
        'port' => 80,
        'login' => 'Pravda_xml',
        'password' => 'X7YYV2H8'
    ],
    'UpProvider' => [
        /**
         * Классы отвечающие  за загрузску файлов
         * |Обязательно должен находится хотябы один класс|
         **/
        'loadersClass' => [
            'Helpers\Uploader\LocalStore',
            'Helpers\Uploader\WebDavStore'
        ],
        /**
         * Классы отвечающие за отдачу файлов
         * |Обязательно должен находится хотябы один класс|
         */
        'recipientClass' => [
            'Helpers\Uploader\LocalStore',
            'Helpers\Uploader\WebDavStore'
        ],
        /** Сервер с которого будут отдаваться картинки урл хоста */
        'returnMultimediaHost' => 'http://img.multimedia.pravda.ru/upload/',
        /**
         * Настройки классов
         * |TmpStore обязателен|
         */
        'WebDavStore' => [
            'host' => 'http://webdav.pravda.local/',
            'auth' => false,
            'user' => 'admin',
            'password' => 'admin',
            'path' => 'upload/'
        ],
        'LocalStore' => [
            'host' => null,
            'auth' => false,
            'user' => null,
            'password' => null,
            'path' => PATH_INDEX . 'images' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR
        ],
        'TmpStore' => [
            'host' => null,
            'auth' => false,
            'user' => null,
            'password' => null,
            'path' => PATH_PLATFORM_BASE . 'store' . DIRECTORY_SEPARATOR,
        ]
    ]
];























