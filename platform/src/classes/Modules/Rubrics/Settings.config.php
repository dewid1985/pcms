<?php
/**
 * Базовый конфиг модуля в платформе
 * обьявление Валидаторов на определенный тип
 * запрос или ответ
 *
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 18:11
 */
return array(
    'visitors' => array(
        'AddRubrics' => [
            'Request' => [
                'DefaultAddRubricsRequestVisitor'
            ],
            'Response' => [
                'DefaultAddRubricsResponseVisitor'
            ]
        ],
        'SaveRubrics' => [
            'Request' => [
                'DefaultSaveRubricsRequestVisitor'
            ],
            'Response' => [
                'DefaultSaveRubricsResponseVisitor'
            ]
        ],
        'DeleteRubrics' => [
            'Request' => [
                'DefaultDeleteRubricsRequestVisitor'
            ],
            'Response' => [
                'DefaultDeleteRubricsResponseVisitor'
            ]
        ],
        'GetRubrics' => [
            'Request' => [
                'DefaultGetRubricsRequestVisitor'
            ],
            'Response' => [
                'DefaultGetRubricsResponseVisitor'
            ]
        ],
        'UpdateRubrics' => [
            'Request' => [
                'DefaultUpdateRubricsRequestVisitor'
            ],
            'Response' => [
                'DefaultUpdateRubricsResponseVisitor'
            ]
        ],
        'GetAllListRubrics' => [
            'Request' => [
                'DefaultGetAllListRubricsRequestVisitor'
            ],
            'Response' => [
                'DefaultGetAllListRubricsResponseVisitor'
            ]
        ],
        'SearchRubrics' => [
            'Request' => [
                'DefaultSearchRubricsRequestVisitor'
            ],
            'Response' => [
                'DefaultSearchRubricsResponseVisitor'
            ]

        ]
    )
);