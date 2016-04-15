<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.12.14
 * Time: 17:34
 */

RouterRewrite::me()
    /********************************Authorization******************************************/
    ->addRoute(
        'in Admin',
        RouterTransparentRule::create('/')
            ->setDefaults(
                [
                    'area' => 'AdministrationPanel',
                    'action' => 'index'
                ]
            )
    )
    ->addRoute(
        'index action Authorization',
        RouterTransparentRule::create('/auth')
            ->setDefaults(
                [
                    'area' => 'Authorization',
                    'action' => 'index'
                ]
            )
    )
    ->addRoute(
        'sign in',
        RouterTransparentRule::create('/signin')
            ->setDefaults(
                [
                    'area' => 'Authorization',
                    'action' => 'signin'
                ]
            )
    )
    ->addRoute(
        'logout',
        RouterTransparentRule::create('/logout')
            ->setDefaults(
                [
                    'area' => 'Authorization',
                    'action' => 'logout'
                ]
            )
    )
    ->addRoute(
        'send code',
        RouterTransparentRule::create('/sendcode')
            ->setDefaults(
                [
                    'area' => 'Authorization',
                    'action' => 'sendCode'
                ]
            )
    )
    /********************************Articles******************************************/
    ->addRoute(
        'articles list',
        RouterTransparentRule::create('/articles/:responseType')
            ->setDefaults(
                [
                    'area' => 'Articles',
                    'action' => 'index',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'article editor',
        RouterTransparentRule::create('/articles/editor/:responseType')
            ->setDefaults(
                [
                    'area' => 'Articles',
                    'action' => 'editor',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'article add',
        RouterTransparentRule::create('/articles/add/:responseType')
            ->setDefaults(
                [
                    'area' => 'Articles',
                    'action' => 'addDraft',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'article get',
        RouterTransparentRule::create('/articles/get/:articleId/:responseType/')
            ->setRequirements(
                [
                    'articleId' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'Articles',
                    'action' => 'getDraft',
                    'articleId' => null,
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'article save',
        RouterTransparentRule::create('/articles/save/:responseType')
            ->setDefaults(
                [
                    'area' => 'Articles',
                    'action' => 'saveDraft',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'article auto save',
        RouterTransparentRule::create('/articles/auto-save/:responseType')
            ->setDefaults(
                [
                    'area' => 'Articles',
                    'action' => 'autoSave',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'article list',
        RouterTransparentRule::create('/articles/list/:responseType')
            ->setDefaults(
                [
                    'area' => 'Articles',
                    'action' => 'getList',
                    'responseType' => null
                ]
            )

    )
    /********************************News******************************************/
    ->addRoute(
        'news list',
        RouterTransparentRule::create('/news/:responseType')
            ->setDefaults(
                [
                    'area' => 'News',
                    'action' => 'index',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'news editor',
        RouterTransparentRule::create('/news/editor/:responseType')
            ->setDefaults(
                [
                    'area' => 'News',
                    'action' => 'editor',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'news add',
        RouterTransparentRule::create('/news/add/:responseType')
            ->setDefaults(
                [
                    'area' => 'News',
                    'action' => 'addDraft',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'news get',
        RouterTransparentRule::create('/news/get/:newsId/:responseType/')
            ->setRequirements(
                [
                    'newsId' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'News',
                    'action' => 'getDraft',
                    'articleId' => null,
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'news save',
        RouterTransparentRule::create('/news/save/:responseType')
            ->setDefaults(
                [
                    'area' => 'News',
                    'action' => 'saveDraft',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'news ',
        RouterTransparentRule::create('/news/list/:responseType')
            ->setDefaults(
                [
                    'area' => 'News',
                    'action' => 'getList',
                    'responseType' => null
                ]
            )

    )
    /********************************Rubrics******************************************/
    ->addRoute(
        'index rubrics',
        RouterTransparentRule::create('/rubrics/:responseType')
            ->setDefaults(
                [
                    'area' => 'Rubrics',
                    'action' => 'index',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'editor rubrics',
        RouterTransparentRule::create('/rubrics/editor')
            ->setDefaults(
                [
                    'area' => 'Rubrics',
                    'action' => 'editor',
                ]
            )
    )
    ->addRoute(
        'add rubrics',
        RouterTransparentRule::create('/rubrics/add/:responseType')
            ->setDefaults(
                [
                    'area' => 'Rubrics',
                    'action' => 'add',
                    'responseType' => null
                ]
            )
    )
    ->addRoute(
        'get json rubrics',
        RouterTransparentRule::create('/rubrics/get/')
            ->setDefaults(
                [
                    'area' => 'Rubrics',
                    'action' => 'getRubrics',
                    'responseType' => 'json'
                ]
            )
    )
    ->addRoute(
        'get rubrics list json of tree',
        RouterTransparentRule::create('/rubrics/getlist')
            ->setDefaults(
                [
                    'area' => 'Rubrics',
                    'action' => 'getRubricsList',
                    'responseType' => 'json'
                ]
            )
    )
    ->addRoute(
        'get rubric by id',
        RouterTransparentRule::create('/rubrics/get/:id')
            ->setRequirements(
                [
                    'id' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'Rubrics',
                    'action' => 'getById',
                    'responseType' => 'json'
                ]
            )
    )
    /********************************Admins******************************************/
    ->addRoute(
        'Add admin Users',
        RouterTransparentRule::create('/admins/add/')
            ->setDefaults(
                [
                    'area' => 'ManagingAdmins',
                    'action' => 'add'
                ]
            )
    )
    /********************************Project******************************************/
    ->addRoute(
        'get system projects',
        RouterTransparentRule::create('/admins/project/getlist')
            ->setDefaults(
                [
                    'area' => 'Project',
                    'action' => 'getProjectList'
                ]
            )
    )
    /********************************Multimedia******************************************/
    ->addRoute(
        'editor image',
        RouterTransparentRule::create('/multimedia/image')
            ->setDefaults(
                [
                    'area' => 'Multimedia',
                    'action' => 'image'
                ]
            )
    )
    ->addRoute(
        'unsorted image',
        RouterTransparentRule::create('/multimedia/unsorted')
            ->setDefaults(
                [
                    'area' => 'Multimedia',
                    'action' => 'unsortedList'
                ]
            )
    )
    ->addRoute(
        'upload image',
        RouterTransparentRule::create('/multimedia/upload')
            ->setDefaults(
                [
                    'area' => 'Multimedia',
                    'action' => 'upload',
                    'responseType' => 'json'
                ]
            )
    )
    ->addRoute(
        'get images list view',
        RouterTransparentRule::create('/multimedia/images/')
            ->setDefaults(
                [
                    'area' => 'Multimedia',
                    'action' => 'images',
                    'responseType' => 'json'
                ]
            )
    )
    ->addRoute(
        'get list images',
        RouterTransparentRule::create('/multimedia/images/list')
            ->setDefaults(
                [
                    'area' => 'Multimedia',
                    'action' => 'imagesList',
                    'responseType' => 'json'
                ]
            )
    )
    ->addRoute(
        'crop images',
        RouterTransparentRule::create('/multimedia/images/crop/:imageId/:sizeId')
            ->setRequirements(
                [
                    'imageId' => '\d+',
                    'sizeId' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'Multimedia',
                    'action' => 'crop',
                    'responseType' => null,
                    'imageId' => null,
                    'sizeId' => null
                ]
            )
    )
    ->addRoute(
        'crop image and resize',
        RouterTransparentRule::create('/multimedia/images/crop')
            ->setDefaults(
                [
                    'area' => 'Multimedia',
                    'action' => 'cropImage',
                    'responseType' => 'json',
                ]
            )
    )
    ->addRoute(
        'get list prewiew by images id',
        RouterTransparentRule::create('/multimedia/images/preview/:imageId')
            ->setRequirements(
                [
                    'imageId' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'Multimedia',
                    'action' => 'getPreview',
                    'responseType' => 'json',
                    'imageId' => null
                ]
            )
    )
    ->addRoute(
        'probe',
        RouterTransparentRule::create('/probe')
            ->setDefaults(
                [
                    'area' => 'Probe',
                    'action' => 'index'
                ]
            )
    )
    /******************************* Service ****************************/
    ->addRoute(
        'service index',
        RouterTransparentRule::create('/services')
            ->setDefaults(
                [
                    'area' => 'Services',
                    'action' => 'index'
                ]
            )
    )
    ->addRoute(
        'service docs',
        RouterTransparentRule::create('/services/doc')
            ->setDefaults(
                [
                    'area' => 'Services',
                    'action' => 'doc'
                ]
            )
    )
    ->addRoute(
        'service calc',
        RouterTransparentRule::create('/services/calc')
            ->setDefaults(
                [
                    'area' => 'PostingLink',
                    'action' => 'calc'
                ]
            )
    )
    ->addRoute(
        'add published link',
        (new RouterTransparentRule('/services/link'))
            ->setDefaults(
                [
                    'area' => 'Services',
                    'action' => 'link'
                ]
            )
    )

//    ->addRoute(
//        'testin login',
//        (new RouterTransparentRule('/fb-callback'))
//            ->setDefaults(
//                [
//                    'area' => 'Services',
//                    'action' => 'fbCallback'
//                ]
//            )
//    )
    /**************************************Social **************************************************/
    ->addRoute(
        'Social app index ',
        (new RouterTransparentRule('/social'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'app'
                ]
            )
    )
    ->addRoute(
        'Social add admin register',
        (new RouterTransparentRule('/social/app/add/admin/:socialNetwork/:appId'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'admin',
                    'socialNetwork' => null,
                    'appId' => null
                ]
            )
    )
    ->addRoute(
        'fb-callback',
        (new RouterTransparentRule('/fb-callback'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'fbCallback'
                ]
            )
    )
    ->addRoute(
        'vk-callback',
        (new RouterTransparentRule('/vk-callback'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'vkCallback'
                ]
            )
    )
    ->addRoute(
        'Social add App',
        (new RouterTransparentRule('/social/app/add'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'add'
                ]
            )
    )
    ->addRoute(
        'Social app new',
        (new RouterTransparentRule('/social/app/new'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'new'
                ]
            )
    )
    ->addRoute(
        'Social app ',
        (new RouterTransparentRule('/social/app'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'app'
                ]
            )
    )
    ->addRoute(
        'Social app list',
        (new RouterTransparentRule('/social/app/list'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'list'
                ]
            )
    )
    ->addRoute(
        'Social add group',
        (new RouterTransparentRule('/social/app/group/add'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'addGroup'
                ]
            )
    )
    ->addRoute(
        'Social add page',
        (new RouterTransparentRule('/social/app/page/add'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'addPage'
                ]
            )
    )
    ->addRoute(
        'Social delete app',
        (new RouterTransparentRule('/social/app/drop'))
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'dropApp'
                ]
            )
    )
    ->addRoute(
        'Social edit app',
        (new RouterTransparentRule('/social/app/edit/:appId'))
            ->setRequirements(
                [
                    'appId' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'editApp',
                    'appId' => null
                ]
            )
    )
    ->addRoute(
        'Social update app',
        (new RouterTransparentRule('/social/app/update/:appId'))
            ->setRequirements(
                [
                    'appId' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'updateApp',
                    'appId' => null
                ]
            )
    )
    ->addRoute(
        'Social admin app',
        (new RouterTransparentRule('/social/app/admin/:appId'))
            ->setRequirements(
                [
                    'appId' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'Social',
                    'action' => 'adminApp',
                    'appId' => null
                ]
            )
    )
    /**************************************************** Social flow**************************************************/
    ->addRoute(
        'Social flow index',
        (new RouterTransparentRule('/social/flow'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'index'
                ]
            )
    )
    ->addRoute(
        'Social flow',
        (new RouterTransparentRule('/social/flow/new'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'new'
                ]
            )
    )
    ->addRoute(
        'Social flow get app',
        (new RouterTransparentRule('/social/flow/get-app'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'getApp'
                ]
            )
    )
    ->addRoute(
        'Social flow get group app',
        (new RouterTransparentRule('/social/flow/get-group'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'getGroup'
                ]
            )
    )
    ->addRoute(
        'Social flow add',
        (new RouterTransparentRule('/social/flow/add'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'add'
                ]
            )
    )
    ->addRoute(
        'Social flow save',
        (new RouterTransparentRule('/social/flow/save'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'save'
                ]
            )
    )
    ->addRoute(
        'Social flow get list',
        (new RouterTransparentRule('/social/flow/list'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'list'
                ]
            )
    )
    ->addRoute(
        'Social flow edit',
        (new RouterTransparentRule('/social/flow/edit/:flowId'))
            ->setRequirements(
                [
                    'flowId' => '\d+'
                ]
            )
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'edit',
                    'flowId' => null
                ]
            )
    )
    ->addRoute(
        'Social flow drop',
        (new RouterTransparentRule('/social/flow/drop'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'drop'
                ]
            )
    )
    ->addRoute(
        'Social flow get access',
        (new RouterTransparentRule('/social/flow/get-access'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'getAccess'
                ]
            )
    )
    ->addRoute(
        'Social flow update access token',
        (new RouterTransparentRule('/social/flow/update-access'))
            ->setDefaults(
                [
                    'area' => 'SocialFlow',
                    'action' => 'updateAccessToken'
                ]
            )
    )
    ->addRoute(
        'Social link',
        (new RouterTransparentRule('/social/history'))
            ->setDefaults(
                [
                    'area' => 'SocialHistory',
                    'action' => 'index'
                ]
            )
    )->addRoute(
        'Social link: get list',
        (new RouterTransparentRule('/social/history/list'))
            ->setDefaults(
                [
                    'area' => 'SocialHistory',
                    'action' => 'getList'
                ]
            )
    )

//    ->addRoute(
//        'Main Controller variables in action',
//        RouterTransparentRule::create('/action/:variables')
//            ->setRequirements(
//                array(
//                    'variables' => '\d+'
//                )
//            )
//            ->setDefaults(
//                array(
//                    'area' => 'Main',
//                    'action' => 'in',
//                    'variables' => null
//                )
//            )
//    )

;