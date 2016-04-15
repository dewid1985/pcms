<?php

interface IModuleOperation
{
    /**
     * Выполнение операции
     *
     * @return mixed
     */
    public function operation();


    public function getResponse();
}