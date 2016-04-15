<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 12.01.16
 * Time: 15:24
 */
class SocialController extends ProjectAuthMappedController
{

    /** @var  Form */
    protected $form;


    protected $standalone = false;

    /**
     * @return Form
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @return boolean
     */
    public function isStandalone()
    {
        return $this->standalone;
    }

    /**
     * @param boolean $standalone
     */
    public function setStandalone($standalone)
    {
        $this->standalone = $standalone;
    }

    /**
     * @param Form $form
     */
    public function setForm(Form $form)
    {
        $this->form = $form;
    }

    public function usersView(HttpRequest $httpRequest)
    {
        return (new ModelAndView())
            ->setModel(new Model())
            ->setView('social/users');
    }


    /**
     * @param HttpRequest $httpRequest
     * @return ModelAndView
     */
    public function newView(HttpRequest $httpRequest)
    {
        return (new ModelAndView())
            ->setModel(new Model())
            ->setView('social/new');
    }

    public function appView(HttpRequest $httpRequest)
    {
        return (new ModelAndView())
            ->setModel(new Model())
            ->setView('social/index');
    }

    public function editAppView(HttpRequest $httpRequest)
    {

        $app = (new PlatformSocialApp())->dao()->getById($httpRequest->getAttachedVar('appId'));

        return (new ModelAndView())
            ->setModel((new Model())->set('app', $app))
            ->setView('social/' . $app->getSocialNetwork()->getName() . '/edit');

    }

    public function adminAppView(HttpRequest $httpRequest)
    {
        $app = (new PlatformSocialApp())->dao()->getById($httpRequest->getAttachedVar('appId'));
        $model = (new Model())->set('app', $app);
        $admin = $app->getAppAdmin();
        Session::assign('appAdminId', $admin->getId());

        switch ($app->getSocialNetwork()->getId()) {
            case PlatformSocialNameEnum::FACEBOOK : {
                $connector = [
                    'app_id' => $app->getAppId(),
                    'app_secret' => $app->getAppSecretKey(),
                    'default_graph_version' => 'v2.5'
                ];


                $facebook = new \Facebook\Facebook($connector);

                $model->set(
                    'pages',
                    $facebook->get('/me/accounts', $admin->getAppAccessToken())->getBody()
                );

                $model->set(
                    'groups',
                    $facebook->get('/' . $admin->getSocialAdminId() . '/groups', $admin->getAppAccessToken())->getBody()
                );

                break;
            }
            case PlatformSocialNameEnum::VK: {
                $model->set(
                    'groups',
                    (new VkRequest())
                        ->setAccessToken($admin->getAppAccessToken())
                        ->execute('groups.get', $admin->getSocialAdminId(), 1, 'admin')
                );

            }
        };


        return (new ModelAndView())
            ->setModel($model)
            ->setView('social/' . $app->getSocialNetwork()->getName() . '/admin');
    }

    public function appAddAction(HttpRequest $httpRequest)
    {
        /** @var PlatformSocialAppRequest $request */
        $request = $this->assembleRequest($httpRequest, new PlatformSocialAppRequest());
        $picture = false;
        $createdAt = TimestampTZ::makeNow();

        if ($request instanceof ModelAndView)
            return $request;

        $form = $this->getValidatedFormUploadedFile()->import($httpRequest->getFiles());

        if ($form->getErrors())
            return $this->getMavError($form);

        try {
            (new PlatformImageProcessor)->upload(
                $image = (new PlatformImage())
                    ->setPath('app/' . $request->getAppId())
                    ->setFileName($createdAt->toStamp())
                    ->setMimeType($form->get('icoAppFile')->getRawValue()['type'])
                    ->setImage($form->get('icoAppFile')->getRawValue()['tmp_name'])
            );

            \Helpers\Uploader\UpProvider::create()->uploadFile(
                PlatformFile::create()
                    ->setFile($image->getImage())
                    ->setFileNameAndPath($image->getFile())
                    ->setUploadingPath($image->getPath())
            );

            (new PlatformImageProcessor())->resizeImage(
                $image
                    ->setCompressedToHeight(128)
                    ->setCompressedToWidth(128)
                    ->setPrefix(PlatformImagesTypeEnum::ico())
            );

            \Helpers\Uploader\UpProvider::create()->uploadFile(
                PlatformFile::create()
                    ->setFile($image->getImage())
                    ->setFileNameAndPath($image->getFile())
                    ->setUploadingPath($image->getPath())
            );

            $picture = true;
        } catch (BaseException $e) {
            return $this->mavJson(
                (new Model())
                    ->set('success', false)
                    ->set('icoAppFile', PlatformFileUploadMessageEnum::getErrorUploadImage()->getMessage())
            );
        }

        if (
            $this->isPostVar($httpRequest, 'appAdminName') &&
            $this->isPostVar($httpRequest, 'appAccessToken') &&
            $this->isPostVar($httpRequest, 'appSocialAdminId')
        ) {
            $form = (new Form())
                ->set(
                    (new PrimitiveString('appAdminName'))
                        ->setMin(5)
                        ->required()
                )
                ->addCustomLabel(
                    'appAdminName', Form::WRONG, PlatformAddAppAdminErrorEnum::getErrorName()->getError()
                )
                ->addMissingLabel(
                    'appAdminName', PlatformAddAppAdminErrorEnum::getErrorRequiredName()->getError()
                )
                ->set(
                    (new PrimitiveString('appAccessToken'))
                        ->setMin(5)
                        ->required()
                )
                ->addCustomLabel(
                    'appAccessToken', Form::WRONG, PlatformAddAppAdminErrorEnum::getErrorAccessToken()->getError()
                )
                ->addMissingLabel(
                    'appAccessToken', PlatformAddAppAdminErrorEnum::getErrorRequiredAccessToken()->getError()
                )
                ->add(
                    (new PrimitiveInteger('appSocialAdminId'))
                        ->required()
                )
                ->addCustomLabel(
                    'appSocialAdminId', Form::WRONG, PlatformAddAppAdminErrorEnum::getErrorSocialAdmin()->getError()
                )
                ->addMissingLabel(
                    'appSocialAdminId', PlatformAddAppAdminErrorEnum::getErrorSocialAdmin()->getError()
                );

            $form->import($httpRequest->getPost());

            if ($form->getErrors())
                return $this->getMavError($form);

            $this->setStandalone(true);
        }

        $response = (new PlatformSocialApp())

            ->setName($request->getName())
            ->setAppId($request->getAppId())
            ->setAppSecretKey($request->getAppSecretKey())
            ->setSocialNetwork(PlatformSocialNameEnum::getByName($request->getSocialNetwork()))
            ->setCreatedAt($createdAt)
            ->setAdmin($this->getAdmin())
            ->setPicture($picture)
            ->add();

        if ($this->isStandalone()) {
            $admin = $this->saveAppAdmin(
                $response,
                [
                    'id' => $form->get('appSocialAdminId')->getRawValue(),
                    'name' => $form->get('appAdminName')->getRawValue(),
                ],
                $form->get('appAccessToken')->getRawValue()
            );

            Session::assign('appAdminId', $admin->getId());
        }

        if ($response instanceof PlatformSocialApp)
            return
                (new ModelAndView())
                    ->setView(new JsonView)
                    ->setModel(
                        (new Model())
                            ->set('success', true)
                            ->set('id', $response->getId())
                            ->set('socialNetwork', $request->getSocialNetwork())
                    );
        else
            return
                (new ModelAndView())
                    ->setView(new JsonView())
                    ->setModel(
                        (new Model())
                            ->set('success', false)
                            ->set('appError', true)
                    );
    }


    /**
     * @return Form
     */
    protected function getValidatedFormUploadedFile()
    {
        return Form::create()
            ->set(
                Primitive::file('icoAppFile')
                    ->setAllowedMimeTypes(['image/jpeg', 'image/gif', 'image/png'])
                    ->required()
            )
            ->addCustomLabel('icoAppFile', Form::WRONG, PlatformFileUploadMessageEnum::getErrorImageMimeType()->getName())
            ->addMissingLabel('icoAppFile', PlatformFileUploadMessageEnum::getErrorRequiredImage()->getName());
    }

    public function adminAction(HttpRequest $httpRequest)
    {
        $app = PlatformSocialApp::dao()->getById($httpRequest->getAttachedVar('appId'));
        $model = new Model();

        switch ($app->getSocialNetwork()->getId()) {
            case PlatformSocialNameEnum::FACEBOOK : {

                $config = [
                    'app_id' => $app->getAppId(),
                    'app_secret' => $app->getAppSecretKey(),
                    'default_graph_version' => 'v2.5'
                ];

                $url = $httpRequest->getServerVar('REQUEST_SCHEME') . ':' .
                    Project::getBaseUrl() . 'fb-callback';

                Session::assign('appId', $app->getId());
                Session::assign('urlCallback', $url);


                $model
                    ->set('connect', $config)
                    ->set('url', $url)
                    ->set('socialNetwork', $app->getSocialNetwork()->getName())
                    ->set(
                        'permissions',
                        (new ProjectConfig())
                            ->setConfig(ucfirst($app->getSocialNetwork()->getName()))
                            ->getAllConfig()
                    );

                break;
            }
            case PlatformSocialNameEnum::VK : {
                $url = 'https://oauth.vk.com/authorize?';

                $config = [
                    'client_id' => $app->getAppId(),
                    'scope' => (new ProjectConfig())
                        ->setConfig(ucfirst($app->getSocialNetwork()->getName()))
                        ->getAllConfig(),
                    'redirect_uri' => 'https://pravda.ru',
                    'display' => 'page',
                    'response_type' => 'code',
                    'v' => 5.44
                ];

                foreach ($config as $k => $v) {
                    if (is_array($v))
                        $url .= $k . '=' . implode(',', $v) . '&';
                    else
                        $url .= $k . '=' . $v . '&';
                }
                $url .= 'v=5.44';

                $url = (new GenericUri())->parse($url, true)->normalize()->toString();

                $model
                    ->set('connect', $config)
                    ->set('url', $url)
                    ->set('socialNetwork', $app->getSocialNetwork()->getName())
                    ->set(
                        'permissions',
                        (new ProjectConfig())
                            ->setConfig(ucfirst($app->getSocialNetwork()->getName()))
                            ->getAllConfig()
                    );

                break;
            }
        }

        return (new ModelAndView())
            ->setView('social/users')
            ->setModel($model);
    }

    public function fbCallbackAction(HttpRequest $httpRequest)
    {
        $app = PlatformSocialApp::dao()->getById($httpRequest->getSessionVar('appId'));
        $model = new Model();

        $config = [
            'app_id' => $app->getAppId(),
            'app_secret' => $app->getAppSecretKey(),
            'default_graph_version' => 'v2.5'
        ];

        $facebook = new \Facebook\Facebook($config);

        $accessToken = $facebook
            ->getOAuth2Client()
            ->getAccessTokenFromCode(
                $httpRequest->getGetVar('code'),
                $httpRequest->getSessionVar('urlCallback')
            );

        $me = $facebook->get('/me', $accessToken->getValue());

        $admin = $this->saveAppAdmin($app, json_decode($me->getBody(), true), $accessToken->getValue());

        if ($admin instanceof PlatformSocialAppAdmin) {
            Session::assign('appAdminId', $admin->getId());

            $model
                ->set('success', true)
                ->set('adminName', $admin->getName())
                ->set('adminId', $admin->getId())
                ->set('socialAdminId', $admin->getSocialAdminId())
                ->set('accessToken', $admin->getAppAccessToken())
                ->set(
                    'pages',
                    $facebook->get('/me/accounts', $admin->getAppAccessToken())->getBody()
                )
                ->set(
                    'groups',
                    $facebook->get('/' . $admin->getSocialAdminId() . '/groups', $admin->getAppAccessToken())->getBody()
                );
        } else {
            $model
                ->set('success', false);
        }

        return (new ModelAndView())
            ->setView('social/callback/fb-callback')
            ->setModel($model);
    }

    public function vkCallbackAction(HttpRequest $httpRequest)
    {
        $admin = PlatformSocialAppAdmin::dao()->getById($httpRequest->getSessionVar('appAdminId'));

        $model = new Model();

        $dataGroup = (new VkRequest())
            ->setAccessToken($admin->getAppAccessToken())
            ->execute('groups.get', $admin->getSocialAdminId(), 1, 'admin');

        $model
            ->set('success', true)
            ->set('adminName', $admin->getName())
            ->set('adminId', $admin->getId())
            ->set('socialAdminId', $admin->getSocialAdminId())
            ->set('accessToken', $admin->getAppAccessToken())
            ->set('groups', $dataGroup);


        return (new ModelAndView())
            ->setView('social/callback/vk-callback')
            ->setModel($model);
    }

    public function addGroupAction(HttpRequest $httpRequest)
    {
        $request = new PlatformSocialAppAdminGroup();

        $request->setAppAdmin(PlatformSocialAppAdmin::dao()->getById($httpRequest->getSessionVar('appAdminId')));

        $response = $this->performanceAjax($httpRequest, $request);

        if ($response instanceof ModelAndView)
            return $response;

        if ($response instanceof PlatformSocialAppAdminGroup)
            return $this->mavJson((new Model())->set('success', true)->set('groupId', $response->getId()));

        return $this->mavJson(
            (new Model())
                ->set('success', false)
                ->set('error', 'no save object')
        );
    }

    public function addPageAction(HttpRequest $httpRequest)
    {
        $request = new PlatformSocialAppAdminPage();

        $request->setAppAdmin(PlatformSocialAppAdmin::dao()->getById($httpRequest->getSessionVar('appAdminId')));


        $response = $this->performanceAjax($httpRequest, $request);

        if ($response instanceof ModelAndView)
            return $response;

        if ($response instanceof PlatformSocialAppAdminPage)
            return $this->mavJson((new Model())->set('success', true)->set('pageId', $response->getId()));

        return $this->mavJson(
            (new Model())
                ->set('success', false)
                ->set('error', 'no save object')
        );

    }

    private function performanceAjax(HttpRequest $httpRequest, Prototyped $identifiableObject)
    {
        if (!$this->isAjaxRequest($httpRequest)) {
            $this->responseCode400();
            return
                $this->mavJson(
                    (new Model())
                        ->set('success', false)
                        ->set('error', 'no ajax request')
                );
        }

        try {
            $this->setForm($identifiableObject->proto()->makeForm());

            FormUtils::object2form($httpRequest, $this->getForm());

            $this->getForm()
                ->import($httpRequest->getPost());

            FormUtils::form2object($this->getForm(), $identifiableObject);

            try {
                $response = $identifiableObject->add();
            } catch (Exception $e) {
                $response = $identifiableObject->dao()->add($identifiableObject);
            }

            return $response;

        } catch (Exception $e) {
            $this->responseCode500();
            return $this->mavJson(
                (new Model())
                    ->set('success', false)
                    ->set('error', 'Internal Server Error')
            );
        }
    }

    public function listAction(HttpRequest $httpRequest)
    {
        $model = new Model();
        $result = (new PlatformSocialApp())
            ->dao()
            ->listApps($httpRequest->getGetVar('start'), $httpRequest->getGetVar('length'));

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

    public function dropAppAction(HttpRequest $httpRequest)
    {
        $model = new Model();

        if (!$this->isAjaxRequest($httpRequest)) {
            $this->responseCode400();
            return
                $this->mavJson(
                    (new Model())
                        ->set('success', false)
                        ->set('error', 'no ajax request')
                );
        }


        $app = (new PlatformSocialApp)->dao()->getById($httpRequest->getPostVar('id'));

        if ($app->getAppAdmin()) {

            if ($groups = $app->getAppAdmin()->getAdminGroups())
                foreach ($groups as $group) $group->drop();

            if ($pages = $app->getAppAdmin()->getAdminPages())
                foreach ($pages as $page) $page->drop();

            $app->getAppAdmin()->drop();

        }

        $app->drop();

        $model->set('success', true);


        return $this->mavJson($model);
    }

    public function updateAppAction(HttpRequest $httpRequest)
    {
        $app = (new PlatformSocialApp())->dao()->getById($httpRequest->getAttachedVar('appId'));
        $admin = $app->getAppAdmin();

        $app->setName($httpRequest->getPostVar('name'));
        $admin->setAppAccessToken($httpRequest->getPostVar('appAccessToken'));
        $admin->update();
        $app->update();

        return $this->mavJson((new Model())->set('success', true));

    }


    /**
     * @param PlatformSocialApp $app
     * @param array $params
     * @param string $accessToken
     * @return Identifiable|null
     */
    private function saveAppAdmin(PlatformSocialApp $app, array $params, $accessToken)
    {
        return (new PlatformSocialAppAdmin())
            ->setApp($app)
            ->setName($params['name'])
            ->setAppAccessToken($accessToken)
            ->setSocialAdminId($params['id'])
            ->add();
    }

    protected function getMapping()
    {
        return [
            'users' => 'usersView',
            'new' => 'newView',
            'app' => 'appView',
            'add' => 'appAddAction',
            'admin' => 'adminAction',
            'fbCallback' => 'fbCallbackAction',
            'vkCallback' => 'vkCallbackAction',
            'addGroup' => 'addGroupAction',
            'addPage' => 'addPageAction',
            'list' => 'listAction',
            'dropApp' => 'dropAppAction',
            'editApp' => 'editAppView',
            'updateApp' => 'updateAppAction',
            'adminApp' => 'adminAppView'
        ];
    }
}

