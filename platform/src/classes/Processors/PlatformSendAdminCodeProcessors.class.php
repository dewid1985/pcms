<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 23.12.14
 * Time: 14:42
 */
class PlatformSendAdminCodeProcessors extends PlatformBaseProcessor
{

    /**
     * Отправка сообщение сервисам по названию сервиса
     *
     * @param PlatformSendCodeRequest $request
     */
    public function send(PlatformSendCodeRequest $request)
    {
        $processor = PlatformUsersAdminCodeTypeEnum::create($request->getType()->getId())->getName();
        $messageTpl = file_get_contents(PATH_PROJECT_TEMPLATES.'messages/confirmation.txt');

        $processor::{'create'}()->send(
            PlatformSmsRequest::create()
                ->setMessage(str_replace('%code%', $request->getCode(),$messageTpl))
                ->setPhone(PlatformUsersAdmin::dao()->getById(Session::get('uId'))->getPhone())
        );

        PlatformUsersAdminCode::addCode(
            PlatformAdminCodeRequest::create()
                ->setCode($request->getCode())
                ->setCreatedAt(TimestampTZ::makeNow())
                ->setType($request->getType())
                ->setActive(TRUE)
                ->setAdminId(Session::get('uId'))
        );
    }
}