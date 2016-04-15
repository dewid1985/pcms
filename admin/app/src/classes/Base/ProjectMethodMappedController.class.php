<?php

/***************************************************************************
 *   Метод мапед Контроллер                                                *
 *   @author Schon Dewid  2015                                             *
 ***************************************************************************/
abstract class ProjectMethodMappedController extends PlatformBasicMethodMappedController
{
    private $ajaxRequestVar = 'HTTP_X_REQUESTED_WITH';
    private $ajaxRequestValueList = array('XMLHttpRequest');
    private $pjaxRequestVar = 'HTTP_X_PJAX';

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
    protected function isPostVar(HttpRequest $httpRequest, $var)
    {
        return array_key_exists($var, $httpRequest->getPost());
    }
}