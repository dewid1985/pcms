<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 03.12.14
 * Time: 17:07
 */
abstract class PlatformBasicMethodMappedController extends MethodMappedController
{
    /**
     * @var ViewResolver
     */
    protected $viewResolver;

    /**
     * construct
     */
    public function __construct()
    {
        $this->initiate();
    }

    /**
     * Обработчик запроса
     *
     * (non-PHPdoc)
     * @see MethodMappedController::handleRequest()
     */
    public function handleRequest(HttpRequest $request)
    {
        $mav = parent::handleRequest($request);
        return $mav;
    }

    /**
     * Ошибка запроса
     *
     * @return ModelAndView
     */
    public function badRequest()
    {
        $this->responseCode400();
        return ModelAndView::create()->setView($this->getView('error/400'));
    }

    /**
     * Ошибка Запрещенно
     *
     * @return ModelAndView
     */
    public function forbidden()
    {
        $this->responseCode403();
        return ModelAndView::create()->setView($this->getView('error/403'));
    }

    /**
     * Нет такой страницы
     *
     * @return ModelAndView
     */
    public function notFound()
    {
        $this->responseCode404();
        return ModelAndView::create()->setView($this->getView('error/404'));
    }

    /**
     * Выбирает Action
     *
     * @param HttpRequest $request
     * @return null
     */
    public function chooseAction(HttpRequest $request)
    {
        $parts = (array)explode('/', trim($request->getServerVar('REQUEST_URI'), '/'));
        $action = $this->getActionNameFromRequestParts($parts);
        if ($action) $request->setAttachedVar('action', $action);
        return parent::chooseAction($request);
    }

    /**
     * Получаю имя из запроса
     *
     * @param array $parts
     * @return null
     */
    protected function /* string */
    getActionNameFromRequestParts(array $parts)
    {
        return (isset($parts[1]) && ($action = $parts[1])) ? $action : null;
    }

    /**
     * Возраващает обьект ModelAndView
     *
     * @param Model $model
     * @param string $viewName
     * @return ModelAndView
     */
    protected function mav(Model $model, $viewName)
    {
        return
            ModelAndView::create()
                ->setModel($model)
                ->setView($this->getView($viewName));
    }

    /**
     * Редиректит на другую вьюху
     *
     * @param $url
     * @return ModelAndView
     */
    protected function mavCleanRedirect($url)
    {
        return
            ModelAndView::create()
                ->setModel(Model::create())
                ->setView(CleanRedirectView::create($url));
    }

    /**
     * Возвращает вьюху в виде JSON
     *
     * @param Model $model
     * @return ModelAndView
     */
    protected function mavJson(Model $model)
    {
        return
            ModelAndView::create()
                ->setModel($model)
                ->setView(JsonView::create());
    }


    /**
     * Внутренняя ошибка
     *
     * @param Model $model
     * @return ModelAndView
     */
    protected function internalError(Model $model)
    {
        $this->responseCode500();
        return ModelAndView::create()->setModel($model)->setView($this->getView('error/500'));
    }

    /**
     * Не правильный запрос
     *
     * @param Model $model
     * @return ModelAndView
     */
    protected function invalidRequest(Model $model)
    {
        $this->responseCode500();
        return ModelAndView::create()->setModel($model)->setView($this->getView('error/500'));
    }

    /**
     * Получить вьюху
     *
     * @param $viewName
     * @return View
     */
    protected function getView($viewName)
    {

        return $this->getViewResolver()->resolveViewName('error/400');
    }

    /**
     * Начинает инициализировать
     */
    final protected function initiate()
    {
        $this->setDefaultAction('notFound');
        $this->setMethodMappingList(array_merge(
            array(
                'forbidden' => 'forbidden',
                'notFound' => 'notFound'
            ),
            $this->getMapping()
        ));
        $this->initiateMisc();
    }

    /**
     * Мапинг методов конроллера
     * Можно вернуть пустой массив если брать с учетом
     * что экшен будет тот который прописан в роут конфиге
     *
     * @return array
     */
    abstract protected function /* array */
    getMapping();

    protected function initiateMisc()
    { /* override me */
    }

    /**
     * Получить резолвер вьюх
     *
     * @return ViewResolver
     */
    public function getViewResolver()
    {
        return $this->viewResolver;
    }

    /**
     * Установить резолвер вьюх
     *
     * @param ViewResolver $viewResolver
     * @return $this
     */
    public function setViewResolver(ViewResolver $viewResolver)
    {
        $this->viewResolver = $viewResolver;
        return $this;
    }

    /**
     * Ошибка 400
     */
    protected function responseCode400()
    {
        $this->header("HTTP/1.1 400 Bad Request");
    }

    /**
     * Ошибка 403
     */
    protected function responseCode403()
    {
        $this->header("HTTP/1.1 403 Forbidden");
    }

    /**
     * Ошибка 404
     */
    protected function responseCode404()
    {
        $this->header("HTTP/1.1 404 Not Found");
    }

    /**
     * Ошибка 500
     */
    protected function responseCode500()
    {
        $this->header("HTTP/1.1 500 Internal Server Error");
    }

    /**
     * @param $header
     */
    protected function header($header)
    {
        if (!headers_sent()) header($header);
    }
}