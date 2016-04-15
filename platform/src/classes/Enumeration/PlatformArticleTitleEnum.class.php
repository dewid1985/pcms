<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.01.15
 * Time: 17:51
 */
class PlatformArticleTitleEnum extends Enum
{

    const
        ADD_ARTICLE_TITLE = 1,
        SAVE_ARTICLE_TITLE = 2;

    protected static $names = array(
        self::ADD_ARTICLE_TITLE => "Cоздание статьи",
        self::SAVE_ARTICLE_TITLE => "Обновление статьи"
    );

    public static function addArticle()
    {
        return new self(self::ADD_ARTICLE_TITLE);
    }

    public static function saveAticle()
    {
        return new self(self::SAVE_ARTICLE_TITLE);
    }

}