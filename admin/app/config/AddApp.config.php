<?php
return [
    'name' => [
        'primitiveSettings' => [],
        'pattern' => null,
        'addCustomLabel' => [
            'error' => 'Не правильно введенны данные в поле `Название приложения`',
            'type' => Form::WRONG
        ],
        'addMissingLabel' => [
            'error' => 'Поле `Название приложения` обязательно для заполнения'
        ]
    ],
    'socialNetwork' => [
        'primitiveSettings' => [],
        'pattern' => null,
        'addCustomLabel' => [
            'error' => 'Нет данной социальной сети',
            'type' => Form::WRONG
        ],
        'addMissingLabel' => [
            'error' => 'Вы не выбрали социальную сеть'
        ]
    ],
    'appId' => [
        'primitiveSettings' => [
            'max' => 30,
            'min' => 7
        ],
        'pattern' => null,
        'addCustomLabel' => [
            'error' => 'Не правильно введены данные в поле `ID Приложения`',
            'type' => Form::WRONG
        ],
        'addMissingLabel' => [
            'error' => 'Полн `ID Приложения` обязательно для заполнения'
        ]
    ],
    'appSecretKey' => [
        'primitiveSettings' => [],
        'pattern' => null,
        'addCustomLabel' => [
            'error' => 'Не праильно введены данные в поле `Секретный ключ`',
            'type' => Form::WRONG
        ],
        'addMissingLabel' => [
            'error' => 'Поле `Секретный ключ` обязательно для заполнения'
        ]
    ]
];