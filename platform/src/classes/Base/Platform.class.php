<?php

/**
 * Class PcmsPlatform
 */
class Platform extends PlatformBase
{
    /**
     * @var DBPool|null
     */
    private $dbpoll = null;

    /**
     * @var null
     */
    private $dbConfig = null;

    /**
     * @param PlatformArray $dbConfig
     */
    private function setDbConfig(PlatformArray $dbConfig)
    {
        $this->dbConfig = $dbConfig;
    }


    /**
     * @return PlatformConfig
     */
    public function getConfig(){
        return (new PlatformConfig())->setConfig(ENVIRONMENT_PLATFORM);
    }
    /**
     * @return PlatformArray
     */
    private function getDbConfig()
    {
        if (is_null($this->dbConfig))
            $this->setDbConfig(
                PlatformConfig::create()
                    ->setConfig(ENVIRONMENT_PLATFORM)
                    ->getItemConfig('databases')
            );
        return $this->dbConfig;
    }

    /**
     * Инициализирую платформу
     */
    public function init()
    {
        $this->databasesConnection();
    }

    /**
     * @return DBPool|null
     */
    private function getDBPool()
    {
        if (is_null($this->dbpoll))
            $this->dbpoll = DBPool::me();
        return $this->dbpoll;
    }

    /**
     * Connection databases
     */
    private function databasesConnection()
    {
        foreach ($this->getDbConfig()->get() as $k => $v) {

            /** @var PlatformArray $dataBases */
            $dataBases = $this->getDbConfig()->getValueByKey($k);


            if (PlatformDatabasesEnum::databasesDefault()->getId() == $k) {
                $this->getDBPool()->setDefault(
                    $this->getDBspawn($dataBases)->setEncoding(DEFAULT_ENCODING)
                );
                continue;
            }

            $this->getDBPool()->addLink(
                PlatformDatabasesEnum::create($k)->getName(),
                $this->getDBspawn($dataBases)->setEncoding(DEFAULT_ENCODING)
            );
        }
    }

    /**
     * @param PlatformArray $dataBases
     * @return DB
     */
    private function getDBspawn(PlatformArray $dataBases)
    {
        return DB::spawn(
            $dataBases->getItem('connector'),
            $dataBases->getItem('user'),
            $dataBases->getItem('pass'),
            $dataBases->getItem('host'),
            $dataBases->getItem('bases'),
            FALSE
        );
    }
}