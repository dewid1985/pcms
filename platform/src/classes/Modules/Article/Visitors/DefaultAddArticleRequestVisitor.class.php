<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31.12.14
 * Time: 12:57
 */

class DefaultAddArticleRequestVisitor extends ArticleVisitor implements IModuleVisitor
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Выполнение визитера
     *
     * @return mixed
     */
    public function visit()
    {
    }
}