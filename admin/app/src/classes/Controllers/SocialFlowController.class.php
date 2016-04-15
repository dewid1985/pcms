<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.01.16
 * Time: 15:30
 */
class SocialFlowController extends ProjectAuthMappedController
{

    public function indexView()
    {
        return (new ModelAndView())
            ->setView('/social-flow/index')
            ->setModel(new Model());
    }

    public function newView()
    {
        return (new ModelAndView())
            ->setView('/social-flow/new')
            ->setModel((new Model())->set('flow', null));
    }


    public function getAppAction(HttpRequest $httpRequest)
    {
        $apps = (new PlatformSocialApp())->dao()->getList();
        $result = [];


        foreach ($apps as $app) {
            $result[] = [
                'text' => $app->getName(),
                'value' => $app->getId(),
                'selected' => false,
                'description' => $app->getSocialNetwork()->getName(),
                'imageSrc' => $app->getIco()
            ];
        }

        return $this->mavJson(
            (new Model())
                ->set('success', true)
                ->set('data', $result)
        );
    }

    public function listAction(HttpRequest $httpRequest)
    {
        $model = new Model();
        $result = (new PlatformSocialFlow())
            ->dao()
            ->listFlows($httpRequest->getGetVar('start'), $httpRequest->getGetVar('length'));

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

    public function addAction(HttpRequest $httpRequest)
    {
        $model = new Model();

        $form = (new Form())
            ->add((new PrimitiveString('name'))->required())
            ->addMissingLabel(
                'name',
                (new PlatformAppFlowErrorEnum(PlatformAppFlowErrorEnum::REQUIRED_NAME))->getError()
            );

        $form->import($httpRequest->getPost());

        if ($form->getErrors()) {
            $model->set('success', false);

            foreach ($form->getErrors() as $k => $v) {
                $model->set($k, $form->getTextualErrorFor($k));
            }

            return $this->mavJson($model);
        }

        $flow = (new PlatformSocialFlow())
            ->dao()
            ->add(
                (new PlatformSocialFlow())
                    ->setName($form->get('name')->getRawValue())
                    ->setSecretKey(crc32($form->get('name')->getRawValue()))
                    ->setAccessToken(md5($form->get('name')->getRawValue()))
            );

        foreach (json_decode($httpRequest->getPostVar('gIds'), true) as $id)
            (new PlatformSocialFlowGroups())
                ->dao()->add((new PlatformSocialFlowGroups())->setFlowId($flow->getId())->setGroupId($id));


        foreach (json_decode($httpRequest->getPostVar('pIds'), true) as $id)
            (new PlatformSocialFlowPages())
                ->dao()->add((new PlatformSocialFlowPages())->setFlowId($flow->getId())->setPageId($id));

        return
            $this->mavJson($model->set('success', true));

    }

    public function getGroupAction(HttpRequest $httpRequest)
    {

        $appId = $httpRequest->getPostVar('appId');

        if (!$httpRequest->getPostVar('gIds'))
            $gIds = [];
        else
            $gIds = explode(',', $httpRequest->getPostVar('gIds'));

        if (!$httpRequest->getPostVar('pIds'))
            $pIds = [];
        else
            $pIds = explode(',', $httpRequest->getPostVar('pIds'));

        $groups =
            (new PlatformSocialAppAdminGroup())->dao()->getByAppId($appId, $gIds);

        $pages =
            (new PlatformSocialAppAdminPage())->dao()->getByAppId($appId, $pIds);

        return $this->mavJson(
            (new Model())
                ->set('success', false)
                ->set('groups', $groups)
                ->set('pages', $pages)
        );
    }

    public function saveAction(HttpRequest $httpRequest)
    {
        $model = new Model();

        $form = (new Form())
            ->add((new PrimitiveString('name'))->required())
            ->addMissingLabel(
                'name',
                (new PlatformAppFlowErrorEnum(PlatformAppFlowErrorEnum::REQUIRED_NAME))->getError()
            );

        $form->import($httpRequest->getPost());

        if ($form->getErrors()) {
            $model->set('success', false);

            foreach ($form->getErrors() as $k => $v) {
                $model->set($k, $form->getTextualErrorFor($k));
            }

            return $this->mavJson($model);
        }


        $flow = (new PlatformSocialFlow())->dao()->getById($httpRequest->getPostVar('flowId'));

        (new PlatformSocialFlow())->dao()->save(
            $flow->setName($httpRequest->getPostVar('name'))
        );

        foreach ($flow->getPages() as $dimension)
            (new PlatformSocialFlowPages())->dao()->drop($dimension);

        foreach ($flow->getGroups() as $dimension)
            (new PlatformSocialFlowGroups())->dao()->drop($dimension);

        foreach (json_decode($httpRequest->getPostVar('gIds'), true) as $id)
            (new PlatformSocialFlowGroups())
                ->dao()->add((new PlatformSocialFlowGroups())->setFlowId($flow->getId())->setGroupId($id));


        foreach (json_decode($httpRequest->getPostVar('pIds'), true) as $id)
            (new PlatformSocialFlowPages())
                ->dao()->add((new PlatformSocialFlowPages())->setFlowId($flow->getId())->setPageId($id));

        return
            $this->mavJson($model->set('success', true));

    }

    public function editAction(HttpRequest $httpRequest)
    {
        $flow = (new PlatformSocialFlow())
            ->dao()->getById($httpRequest->getAttachedVar('flowId'));

        return (new ModelAndView())
            ->setModel((new Model())->set('flow', $flow))
            ->setView('/social-flow/new');
    }

    public function dropAction(HttpRequest $httpRequest)
    {
        if(!$this->isAjaxRequest($httpRequest)){
            $this->responseCode400();
            return $this->mavJson(
                (new Model())->set('success', false)
                ->set('error', 'bad request')
            );
        }

        if(!$this->isPostVar($httpRequest, 'id')){
            $this->responseCode400();
            return $this->mavJson(
                (new Model())->set('success', false)
                    ->set('error', 'bad request')
            );
        }


        $flow = (new PlatformSocialFlow())->dao()->getById($httpRequest->getPostVar('id'));

        (new PlatformSocialFlow())->dao()->save($flow->setDeleted(true));

        return $this->mavJson((new Model())->set('success', true));
    }

    public function getAccessAction(HttpRequest $httpRequest)
    {
        if(!$this->isAjaxRequest($httpRequest)){
            $this->responseCode400();
            return $this->mavJson(
                (new Model())->set('success', false)
                    ->set('error', 'bad request')
            );
        }

        if(!$this->isPostVar($httpRequest, 'id')){
            $this->responseCode400();
            return $this->mavJson(
                (new Model())->set('success', false)
                    ->set('error', 'bad request')
            );
        }

        $flow = (new PlatformSocialFlow())->dao()->getById($httpRequest->getPostVar('id'));

        return $this->mavJson(
            (new Model())
                ->set('success', true)
                ->set('accessToken', $flow->getAccessToken())
                ->set('secretKey', $flow->getSecretKey())
        );

    }

    public function updateAccessTokenAction(HttpRequest $httpRequest)
    {
        if(!$this->isAjaxRequest($httpRequest)){
            $this->responseCode400();
            return $this->mavJson(
                (new Model())->set('success', false)
                    ->set('error', 'bad request')
            );
        }

        if(!$this->isPostVar($httpRequest, 'id')){
            $this->responseCode400();
            return $this->mavJson(
                (new Model())->set('success', false)
                    ->set('error', 'bad request')
            );
        }

        $flow = (new PlatformSocialFlow())->dao()->getById($httpRequest->getPostVar('id'));

        $flow->updateAccessToken();

        return $this->mavJson(
            (new Model())
                ->set('success', true)
                ->set('accessToken', $flow->getAccessToken())
        );

    }

    public function getMapping()
    {
        return [
            'index' => 'indexView',
            'new' => 'newView',
            'getApp' => 'getAppAction',
            'getGroup' => 'getGroupAction',
            'add' => 'addAction',
            'list' => 'listAction',
            'edit' => 'editAction',
            'save' => 'saveAction',
            'drop' => 'dropAction',
            'getAccess' => 'getAccessAction',
            'updateAccessToken' => 'updateAccessTokenAction'
        ];

    }
}