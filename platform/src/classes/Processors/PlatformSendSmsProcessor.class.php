<?php

/**
 * Отправить смс сообщение
 *
 * Created by PhpStorm.
 * User: root
 * Date: 23.12.14
 * Time: 12:59
 */
class PlatformSendSmsProcessor extends PlatformBaseProcessor
{
    /**
     * Отправка смс сообщения
     *
     * @param PlatformSmsRequest $request
     * @return PlatformSmsResponse
     */
    public function send(PlatformSmsRequest $request)
    {
        $response = PlatformSmsResponse::create();
        try {
            $config = PlatformConfig::create()
                ->setConfig(ENVIRONMENT_PLATFORM)
                ->getItemConfig('smsService');

            PlatformSendSms::create()
                ->setHost($config->getValueByKey('host'))
                ->setPort($config->getValueByKey('port'))
                ->setPath($config->getValueByKey('path'))
                ->setLogin($config->getValueByKey('login'))
                ->setPassword($config->getValueByKey('password'))
                ->setMessage($request->getMessage())
                ->setPhone($request->getPhone())
                ->send();
            return $response->setResult(TRUE);
        } catch (PlatformConfigException $e) {
            Logger::me()->exception($e);
        } catch (WrongArgumentException $e) {
            Logger::me()->exception($e);
        } catch (PlatformSendSmsException $e) {
            Logger::me()->exception($e);
        }
    }
}