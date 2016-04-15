<?php

/**
 * Class PcmsConfig
 */
class PlatformConfig extends PlatformBase
{
    /**
     * Название подгружаемого файла-конфига
     *
     * @var null
     */
    private $configName = null;

    /**
     * Содержимое файла конфига (массив (array))
     *
     * @var array
     */
    private $configArray = array();

    /**
     * Каталог конфигурации
     *
     * @var $configPath
     */
    private $configPath = null;

    /**
     * Установка имени конфига
     *
     * @param $configName
     * @return $this
     */
    public function setConfig($configName)
    {
        $this->setConfigName($configName);
        $this->setConfigArray();
        return $this;
    }


    /**
     * Получение всего массива из файла-конфига
     *
     * @param null $configName
     * @return array
     */
    public function getAllConfig($configName = null)
    {
        $this->checkConfigName($configName);
        $this->setConfigName($configName);
        if (empty($this->configArray)) {
            return $this->configArray;
        }
        $this->setConfigArray();
        return $this->configArray;
    }

    /**
     * Получение ключа массива из файла-конфига
     *
     * @param $key
     * @param null $configName
     * @return PlatformArray|array
     */
    public function getItemConfig($key, $configName = null)
    {
        $this->checkConfigName($configName);
        $this->setConfigName($configName);

        if (empty($this->configArray))
            return $this->configArray;

        $this->setConfigArray();

        Assert::isIndexExists($this->configArray, $key);

        if (!is_array($this->configArray[$key]))
            return $this->configArray[$key];

        return PlatformArray::create()->setArray($this->configArray[$key]);
    }

    /**
     * Установка имени файла-конфига
     *
     * @param $configName
     */
    private function setConfigName($configName)
    {
        if (!is_null($configName)) {
            $this->configName = $configName;
        }
    }

    /**
     * Проверка существования имени файла-конфига
     *
     * @param $configName
     * @throws PlatformConfigException
     */
    private function checkConfigName($configName)
    {
        if (is_null($configName) && is_null($this->configName)) {
            throw new PlatformConfigException('No config file $configName :' .
                $configName . ' and $this->$configName :' . $this->configName);
        }
    }

    /**
     * Установка свойства конфигурации массивом из файла
     */
    private function setConfigArray()
    {
        if (is_null($this->getConfigPath())) {
            $this->setConfigPath($this->getDefaultConfigPath());
        }
        $this->configArray = require($this->getConfigPath() . $this->configName . '.config.php');
    }

    /**
     * Сеттер установки каталога кофигурации
     *
     * @param $configPath
     * @return $this
     */
    public function setConfigPath($configPath)
    {
        $this->configPath = $configPath;
        return $this;
    }

    /**
     * Геттер получения каталога конфигурации
     *
     * @return $configPath
     */
    public function getConfigPath()
    {
        return $this->configPath;
    }

    /**
     * Геттер возвращает католог конфигурации обьявленный по умолчанию
     *
     * @return string
     */
    public function getDefaultConfigPath()
    {
        return PATH_PLATFORM_CONFIG;
    }
}