<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.15
 * Time: 15:09
 */
class ServicesController extends ProjectServiceController
{

    public function indexView(HttpRequest $httpRequest)
    {

        return
            (new ModelAndView())
                ->setModel(
                    (new Model())
                        ->set('tplName', 'services/home')
                )
                ->setView('services/index');
    }

    public function docView(HttpRequest $httpRequest)
    {
        return
            (new ModelAndView())
                ->setModel(
                    (new Model())
                        ->set('tplName', 'services/doc'))
                ->setView('services/index');

    }

    /**
     * @param HttpRequest $httpRequest
     * @return ModelAndView
     */
    public function linkAction(HttpRequest $httpRequest)
    {
        $link = (new PlatformSocialPublishedLink())
            ->setFlow($this->getFlow())
            ->setDescription($httpRequest->getGetVar('description'))
            ->setLinkUrl($httpRequest->getGetVar('link'))
            ->setImgUrl($httpRequest->getGetVar('imgUrl'))
            ->setCreatedAt(TimestampTZ::makeNow());

        /** @var PlatformSocialPublishedLink $link */
        $link->dao()->add($link);

        return $this->mavJson(
            (new Model())->set('success', true)->set('message', 'Added to queue')
        );
    }

    /**
     * @return array
     */
    protected function getMapping()
    {
        return [
            'index' => 'indexView',
            'doc' => 'docView',
            'link' => 'linkAction'
        ];
    }

    /**
     * @return array
     */
    public function getFreeAction()
    {
        return [
            'index', 'doc'
        ];
    }
}