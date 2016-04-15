<?php

/**
 * Сохранение черновика
 *
 * Created by PhpStorm.
 * User: root
 * Date: 09.02.15
 * Time: 11:32
 */
class AddNews extends NewsOperation implements IModuleOperation
{
    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleNewsAddOperationRequest
     */
    private function getRequest()
    {
        return $this->getModuleObject()->getRequest();
    }

    /**
     * Выполнение операции
     *
     * @return mixed
     */
    public function operation()
    {

        /** @var PlatformCommonNews $article */
        $news = PlatformCommonNews::dao()
            ->add(
                PlatformCommonNews::create()
                    ->setProjectId($this->getRequest()->getProjectId())
                    ->setNewsDraftId(
                        PlatformCommonNewsDraft::dao()
                            ->add(
                                PlatformCommonNewsDraft::create()
                                    ->setTitle($this->getRequest()->getTitle())
                                    ->setAnons($this->getRequest()->getAnons())
                                    ->setText($this->getRequest()->getText())
                                    ->setMetaDescription($this->getRequest()->getMetaDescription())
                                    ->setMetaKeywords($this->getRequest()->getMetaKeywords())
                                    ->setRubrics($this->getRequest()->getRubrics())
                                    ->setPreview($this->getRequest()->getPreview())
                                    ->setAdminId($this->getRequest()->getAdminId())
                            )
                            ->getId()
                    )
                    ->setCreatedAt(TimestampTZ::makeNow())
                    ->setPublishedAt($this->getRequest()->getPublishedAt())
                    ->setPublished(FALSE)
            );

        PlatformCommonNewsDraft::dao()
            ->save(
                PlatformCommonNews::dao()
                    ->getById($news->getId())
                    ->getNewsDraft()
                    ->setNews($news)
            );

        $this->getModuleObject()
            ->setResponse(
                ModuleNewsAddOperationResponse::create()
                    ->setNewsId($news->getId())
            );
    }
}