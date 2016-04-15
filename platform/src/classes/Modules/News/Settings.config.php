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
        'AddNews' => array(
            'Request' => array(
                'DefaultAddNewsRequestVisitor'
            ),
            'Response' => array(
                'DefaultAddNewsResponseVisitor'
            )
        ),
        'DeleteNews' => array(
            'Request' => array(
                'DefaultDeleteNewsRequestVisitor'
            ),
            'Response' => array(
                'DefaultDeleteNewsResponseVisitor'
            )
        ),
        'GetNews' => array(
            'Request' => array(
                'DefaultGetNewsRequestVisitor'
            ),
            'Response' => array(
                'DefaultGetNewsResponseVisitor'
            )
        ),
        'UpdateNews' => array(
            'Request' => array(
                'DefaultSaveNewsRequestVisitor'
            ),
            'Response' => array(
                'DefaultSaveNewsResponseVisitor'
            )
        ),
        'SearchNews' => array(
            'Request' => array(
                'DefaultSearchNewsRequestVisitor'
            ),
            'Response' => array(
                'DefaultSearchNewsResponseVisitor'
            )
        )
    )
);