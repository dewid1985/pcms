<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.01.15
 * Time: 18:30
 */
interface IGelfMessage
{
    public function setVersion($version);

    public function getVersion();

    public function setTimestamp($timestamp);

    public function getTimestamp();

    public function setShortMessage($shortMessage);

    public function getShortMessage();

    public function setFullMessage($fullMessage);

    public function getFullMessage();

    public function setFacility($facility);

    public function getFacility();

    public function setHost($host);

    public function getHost();

    public function setLevel($level);

    public function getLevel();

    public function setFile($file);

    public function getFile();

    public function setLine($line);

    public function getLine();

    public function setAdditional($key, $value);

    public function getAdditional($key);
}