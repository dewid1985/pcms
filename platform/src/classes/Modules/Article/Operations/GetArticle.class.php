<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.14
 * Time: 18:29
 */
class GetArticle extends ArticleOperation implements IModuleOperation
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleArticleGetOperationRequest
     */
    protected function getRequest()
    {
        return $this->getModuleObject()->getRequest();
    }

    /**
     * @return mixed|void
     */
    public function operation()
    {
        $articles = PlatformCommonArticle::dao()->getByArticleAndProject(
            $this->getRequest()->getArticleId(),
            $this->getRequest()->getProjectId()
        );

        $this->getModuleObject()->setResponse(
            ModuleArticleGetOperationResponse::create()
                ->setArticleId($articles->getId())
                ->setCreatedAt($articles->getCreatedAt())
                ->setPublishedAt($articles->getPublishedAt())
                ->setRubrics($articles->getArticleDraft()->getRubrics())
                ->setMetaDescription($articles->getArticleDraft()->getMetaDescription())
                ->setMetaKeywords($articles->getArticleDraft()->getMetaKeywords())
                ->setTitle($articles->getArticleDraft()->getTitle())
                ->setAnons($articles->getArticleDraft()->getAnons())
                ->setAuthor($articles->getArticleDraft()->getAuthor())
                ->setText($articles->getArticleDraft()->getText())
        );
    }
}