<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.02.16
 * Time: 18:27
 */
class SocialHistoryController extends ProjectAuthMappedController
{
    public function indexAction()
    {
        return (new ModelAndView())
            ->setView('social-history/index')
            ->setModel(new Model());
    }

    public function getListAction(HttpRequest $httpRequest)
    {
        $model = new Model();

        if (
            $this->isAjaxRequest($httpRequest) &&
            $this->isPjaxRequest($httpRequest)
        ){
            $this->responseCode400();
            return (new ModelAndView())
                ->setModel(
                    (new Model())
                        ->set('error', 'Forbidden')
                        ->set('success', false)
                );
        }

        $result =(new  PlatformSocialPublishedLink())
            ->dao()->getList($httpRequest->getGetVar('start'), $httpRequest->getGetVar('length'));

        if (!empty($result)) {
            $model
                ->set('draw', $httpRequest->getGetVar('draw'))
                ->set('recordsTotal', $result[0]['count'])
                ->set('recordsFiltered', $result[0]['count'])
                ->set('data', $result);
        } else {
            $model
                ->set('draw', $httpRequest->getGetVar('draw'))
                ->set('recordsTotal', 0)
                ->set('recordsFiltered', 0)
                ->set('data', []);
        }

        return $this->mavJson($model);

    }

    protected function getMapping()
    {
        return [
            'index' => 'indexAction',
            'getList' => 'getListAction'
        ];
    }
}