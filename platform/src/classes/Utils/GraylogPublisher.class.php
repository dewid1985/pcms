<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.01.15
 * Time: 16:22
 */
class GraylogPublisher extends GELFMessagePublisher implements IGelfPublisher
{
    /**
     * @return GELFMessagePublisher
     */
    public static function create($host, $port = self::GRAYLOG2_DEFAULT_PORT, $chunk = self::CHUNK_SIZE_WAN)
    {
        return new self($host, $port, $chunk);
    }

    /**
     * @param IGelfMessage $message
     * @return boolean
     */
    public function send(IGelfMessage $message)
    {
        return parent::publish($message);
    }
}