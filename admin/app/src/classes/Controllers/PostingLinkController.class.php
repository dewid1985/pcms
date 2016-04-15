<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.12.15
 * Time: 16:13
 */
class PostingLinkController extends ProjectMethodMappedController
{
    const
        VKACCESSTOKEN = '3287fe4dc6e737b137cbedd518af562ac095600aeac950dee67973e48266251361820fb78ed18cb586938',
        VKGROUPID = 110539904;

    public function postingAction(HttpRequest $httpRequest)
    {
        $model = (new Model());

        $form = (new Form())
            ->set(Primitive::string('description')->required())
            ->set(Primitive::httpUrl('link')->required())
            ->set(Primitive::httpUrl('imgUrl'))
            ->set(Primitive::string('project')->setMax(10)->setMin(4))
            ->set(Primitive::string('responseType')->setMax(5));

        $form->import($httpRequest->getGet());

        try {

            $response = (new VkRequest())
                ->setAccessToken(self::VKACCESSTOKEN)
                ->setImgUrl($form->get('imgUrl')->getRawValue())
                ->setGroupId(self::VKGROUPID)
                ->setMessage($form->get('description')->getRawValue())
                ->setAttachments($form->get('link')->getRawValue())
                ->execute();

            $model->set('success', true);

            /** @var LightMetaProperty $property */
            foreach ($response->proto()->getPropertyList() as $item => $property) {
                $getter = $property->getGetter();
                if (!is_null($method = $response->{$getter}()))
                    $model->set($item, $method);
            }

        } catch (ServiceException $e) {
            $model
                ->set('success', false)
                ->set('error', $e->getMessage())
                ->set('code', $e->getCode());
        }

        if ($form->get('responseType')->getRawValue() == 'json') {
            $view = new JsonView();
        } else {
            $model->set('tplName', 'services/vk/response');
            $view = 'services/index';
        }

        return (new ModelAndView())
            ->setView($view)
            ->setModel($model);
    }

    public function calcView(HttpRequest $httpRequest)
    {
        return
            (new ModelAndView())
                ->setModel(
                    (new Model())
                        ->set('tplName', 'services/calc')
                )
                ->setView('services/index');
    }

    protected function getMapping()
    {
        return [
            'posting' => 'postingAction',
            'calc' => 'calcView'

        ];
    }


}