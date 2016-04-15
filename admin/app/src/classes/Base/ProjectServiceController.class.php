<?php

/***************************************************************************
 *   Метод мапед Контроллер                                                *
 * @author Schon Dewid  2015                                             *
 ***************************************************************************/
abstract class ProjectServiceController extends PlatformBasicMethodMappedController
{
    private $ajaxRequestVar = 'HTTP_X_REQUESTED_WITH';
    private $ajaxRequestValueList = array('XMLHttpRequest');
    private $pjaxRequestVar = 'HTTP_X_PJAX';
    /**
     * @var PlatformSocialFlow
     */
    private $flow;

    /**
     * @return PlatformSocialFlow
     */
    public function getFlow()
    {
        return $this->flow;
    }

    /**
     * @param PlatformSocialFlow $flow
     */
    public function setFlow(PlatformSocialFlow $flow)
    {
        $this->flow = $flow;
    }


    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param HttpRequest $request
     *
     * @return ModelAndView
     */
    public function handleRequest(HttpRequest $request)
    {
        if(in_array($request->getAttachedVar('action'), $this->getFreeAction()))
        {
            return parent::handleRequest($request);
        }

        if (
            !$this->isPostVar($request, 'secretKey') &&
            !$this->isPostVar($request, 'accessToken')
        ) {
            return $this->mavJson(
                (new Model())
                    ->set('success', false)
                    ->set('errorCode', 101)
                    ->set('error', 'no access data')
            );
        }

        try {
            $this->setFlow(
                (new PlatformSocialFlow())
                    ->dao()
                    ->getBySecretCode($request->getPostVar('secretKey'))
            );

        } catch (ObjectNotFoundException $e) {
            return $this->mavJson(
                (new Model())
                    ->set('success', false)
                    ->set('errorCode', 102)
                    ->set('error', 'no flow')
            );
        }

        if($this->getFlow()->getAccessToken() != $request->getPostVar('accessToken'))
            return
                $this->mavJson(
                    (new Model())
                        ->set('success', false)
                        ->set('errorCode', 103)
                        ->set('error', 'Access denied')
                );

        return parent::handleRequest($request);
    }

    /**
     * @param HttpRequest $request
     *
     * @return null
     */
    public function chooseAction(HttpRequest $request)
    {
        $action = Primitive::choice('action')->setList($this->getMethodMapping());
        if ($this->getDefaultAction())
            $action->setDefault($this->getDefaultAction());
        Form::create()
            ->add($action)
            ->import($request->getGet())
            ->importMore($request->getPost())
            ->importMore($request->getAttached());
        if (!$command = $action->getValue())
            return $action->getDefault();
        return $command;
    }

    /**
     * @return boolean
     */
    public function isAjaxRequest(HttpRequest $request)
    {
        $form = Form::create()
            ->add(
                Primitive::plainChoice($this->ajaxRequestVar)
                    ->setList($this->ajaxRequestValueList)
            )
            ->add(
                Primitive::boolean('_isAjax')
            )
            ->import($request->getServer())
            ->importOneMore('_isAjax', $request->getGet());

        if ($form->getErrors()) {
            return false;
        }
        if ($form->getValue($this->ajaxRequestVar)) {
            return true;
        }
        if ($form->getValue('_isAjax')) {
            return true;
        }
        return false;
    }

    /**
     * @return boolean
     */
    function isPjaxRequest(HttpRequest $request)
    {
        $form = Form::create()
            ->add(
                Primitive::boolean($this->pjaxRequestVar)
            )
            ->add(
                Primitive::boolean('_isPjax')
            )
            ->import($request->getServer())
            ->importOneMore('_isPjax', $request->getGet());

        if ($form->getErrors()) {
            return false;
        }
        return $form->getValue($this->pjaxRequestVar) || $form->getValue('_isPjax');
    }

    /**
     * @param HttpRequest $httpRequest
     * @param $var
     * @return bool
     */

    /**
     * @return array
     */
    public abstract function getFreeAction();

    /**
     * @param HttpRequest $httpRequest
     * @param $var
     * @return bool
     */
    protected function isPostVar(HttpRequest $httpRequest, $var)
    {
        return array_key_exists($var, $httpRequest->getPost());
    }

    /**
     * @param HttpRequest $httpRequest
     * @param $var
     * @return bool
     */
    protected function isGetVar(HttpRequest $httpRequest, $var)
    {
        return array_key_exists($var, $httpRequest->getGet());
    }
}