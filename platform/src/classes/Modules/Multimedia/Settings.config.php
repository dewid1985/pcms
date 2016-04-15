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
        'AddImageMultimedia' => array(
            'Request' => array(
                'DefaultAddImageMultimediaRequestVisitor'
            ),
            'Response' => array(
                'DefaultAddImageMultimediaResponseVisitor'
            )
        ),
        'SearchImagesMultimedia' => array(
            'Request' => array(
                'DefaultSearchImagesMultimediaRequestVisitor'
            ),
            'Response' => array(
                'DefaultSearchImagesMultimediaResponseVisitor'
            )
        ),
        'GetImageMultimedia' => array(
            'Request' => array(
                'DefaultGetImageMultimediaRequestVisitor'
            ),
            'Response' => array(
                'DefaultGetImageMultimediaResponseVisitor'
            )
        ),
        'CropImageMultimedia' => array(
            'Request' => array(
                'DefaultCropImageMultimediaRequestVisitor'
            ),
            'Response' => array(
                'DefaultCropImageMultimediaResponseVisitor'
            )
        ),
        'GetPreviewMultimedia' => array(
            'Request' => array(
                'DefaultGetPreviewMultimediaRequestVisitor'
            ),
            'Response' => array(
                'DefaultGetPreviewMultimediaResponseVisitor'
            )
        )
    )
);