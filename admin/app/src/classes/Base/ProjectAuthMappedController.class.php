<?php
/***************************************************************************
 *   Метод мапед Контроллер с проверкой аторизации                         *
 *   @author Schon Dewid  2015                                             *
 ***************************************************************************/
abstract class ProjectAuthMappedController extends ProjectMethodMappedController
{
    private $ajaxRequestVar = 'HTTP_X_REQUESTED_WITH';
    private $ajaxRequestValueList = array('XMLHttpRequest');
    private $pjaxRequestVar = 'HTTP_X_PJAX';

    /** @var  Form */
    private $requestForm;

    /**
     * @param HttpRequest $request
     *
     * @return ModelAndView
     */
    public function handleRequest(HttpRequest $request)
    {
        if(PlatformAuthAdminProcessor::create()->isAuthorized()->isResult())
                    return parent::handleRequest($request);

        return ModelAndView::create()
            ->setModel(Model::create())
            ->setView(RedirectView::create('/auth'));
    }

    /**
     * @return PlatformCommonProject
     */
    public function getProject()
    {
        return PlatformCommonProject::dao()->getById(Session::get('projectId'));
    }

    public function importErrorForm($formName)
    {
        /** @var array $formValidationConfig */
        $formValidationConfig = (new ProjectConfig())
            ->setConfig(
                ucfirst($formName)
            )
            ->getAllConfig();

        foreach ($this->requestForm->getPrimitiveNames() as $value) {

            if ($value == 'formName')
                continue;

            $primitive = $this->requestForm->getPrimitiveList()[$value];

            if ($primitive instanceof RangedPrimitive)
                $primitive->setMin(5);


            if (
                !is_null($formValidationConfig[$value]['primitiveSettings'])
                && is_array($formValidationConfig[$value]['primitiveSettings'])
            ) {
                foreach ($formValidationConfig[$value]['primitiveSettings'] as $k => $v) {
                    switch ($k) {
                        case 'min': {
                            $primitive->setMin($v);
                            break;
                        }
                        case 'max': {
                            $primitive->setMax($v);
                            break;
                        }
                    }
                }
            }

            if (
                !is_null($formValidationConfig[$value]['pattern'])
                && $primitive instanceof PrimitiveString
            ) {
                $primitive->setAllowedPattern($formValidationConfig[$value]['pattern']);
            }

            if (!is_null($customLabel = $formValidationConfig[$value]['addCustomLabel']))
                $this->requestForm->addCustomLabel($value, Form::WRONG, $customLabel['error']);

            if (!is_null($missingLabel = $formValidationConfig[$value]['addMissingLabel']))
                $this->requestForm->addMissingLabel($value, $missingLabel['error']);

        }

    }


    /**
     * @return PlatformUsersAdmin
     */
    public function getAdmin()
    {
        return PlatformUsersAdmin::dao()->getById(Session::get('uId'));
    }

    /**
     * @param HttpRequest $httpRequest
     * @param PlatformBaseRequest $request
     * @return ModelAndView|PlatformBaseRequest
     */
    public function assembleRequest(HttpRequest $httpRequest, PlatformBaseRequest $request)
    {
        $this->requestForm = $request->proto()->makeForm();
        FormUtils::object2form($httpRequest, $this->requestForm);
        if ($this->isPostVar($httpRequest, 'formName'))
            $this->importErrorForm($httpRequest->getPostVar('formName'));
        $this->requestForm->importMore($httpRequest->getPost())->importMore($httpRequest->getGet());
        $this->requestForm->checkRules();

        if ($this->requestForm->getErrors())
            return $this->getMavError($this->requestForm);

        FormUtils::form2object($this->requestForm, $request);

        return $request;
    }


    /**
     * @param Form $form
     * @return ModelAndView
     */
    public function getMavError(Form $form)
    {
        $model = (new Model())->set('success', false);

        foreach($form->getInnerErrors() as $key => $num )
        {
            $model->set($key, $form->getTextualErrorFor($key));
        }

        return $this->mavJson($model);
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