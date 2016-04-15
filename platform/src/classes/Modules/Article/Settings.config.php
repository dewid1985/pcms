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
        'AddArticle' => array(
            'Request' => array(
                'DefaultAddArticleRequestVisitor'
            ),
            'Response' => array(
                'DefaultAddArticleResponseVisitor'
            )
        ),
        'DeleteArticle' => array(
            'Request' => array(
                'DefaultDeleteArticleRequestVisitor'
            ),
            'Response' => array(
                'DefaultDeleteArticleResponseVisitor'
            )
        ),
        'GetArticle' => array(
            'Request' => array(
                'DefaultGetArticleRequestVisitor'
            ),
            'Response' => array(
                'DefaultGetArticleResponseVisitor'
            )
        ),
        'UpdateArticle' => array(
            'Request' => array(
                'DefaultSaveArticleRequestVisitor'
            ),
            'Response' => array(
                'DefaultSaveArticleResponseVisitor'
            )
        ),
        'SearchArticle' => array(
            'Request' => array(
                'DefaultSearchArticleRequestVisitor'
            ),
            'Response' => array(
                'DefaultSearchArticleResponseVisitor'
            )
        ),
        'AutoSaveArticle' => array(
            'Request' => array(
                'DefaultAutoSaveArticleRequestVisitor'
            ),
            'Response' => array(
                'DefaultAutoSaveArticleResponseVisitor'
            )
        )
    )
);