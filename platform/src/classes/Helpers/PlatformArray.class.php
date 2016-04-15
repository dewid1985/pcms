<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.12.14
 * Time: 11:34
 */
class PlatformArray extends PlatformBase
{
    private $array = array();

    /**
     * устанавливаю значение массива
     *
     * @param $array
     * @return $this
     */
    public function setArray($array)
    {
        $this->array = $array;
        return $this;
    }

    /**
     * Поиск значения по ключу в массиве
     * если значение является массивов возвращаю обьект
     * PlatformArray (рекурсия)
     *
     * @param $key
     * @return $this
     */
    public function getItem($key)
    {
        Assert::isIndexExists($this->array, $key);

        if(!is_array($this->array[$key]))
            return $this->array[$key];

        return PlatformArray::create()->setArray($this->array[$key]);
    }

    /**
     * Alias $this->getItem();
     *
     * @param $key
     * @return $this
     */
    public function getValueByKey($key)
    {
        return $this->getItem($key);
    }

    /**
     * Возвращаю массив
     *
     * @return array
     */
    public function get()
    {
        return $this->array;
    }
}