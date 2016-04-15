<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11.12.14
 * Time: 12:43
 */
class PlatformAuthAdminProcessor extends PlatformBaseProcessor
{

    /** @var null token */
    private $token = NULL;

    /**
     * check user admin
     *
     * @param PlatformAuthAdminRequest $request
     * @return PlatformAuthAdminResponse
     */
    public function checkUser(PlatformAuthAdminRequest $request)
    {
        try {
            PlatformUsersAdmin::dao()->getByLogin($request->getLogin());

            return PlatformAuthAdminResponse::create()->setResult(TRUE);
        } catch (ObjectNotFoundException $e) {
            Logger::me()->exception($e);
        }
        PlatformRequestHelper::me()
            ->getAdminAuthLogsRequest()
            ->setSystemUser(FALSE)
            ->setEntryAt(TimestampTZ::makeNow())
            ->setLogin(
                PlatformRequestHelper::me()
                    ->getHttpRequest()
                    ->getPostVar('login')
            )
            ->setPassword(
                PlatformRequestHelper::me()
                    ->getHttpRequest()
                    ->getPostVar('password')
            );

        return PlatformAuthAdminResponse::create();
    }

    /**
     * authorized user admin
     *
     * @param PlatformAuthAdminRequest $request
     * @return PlatformAuthAdminResponse
     */
    public function authorizedUser(PlatformAuthAdminRequest $request)
    {
        try {
            $admin = PlatformUsersAdmin::dao()->getByLogin($request->getLogin());
            if ($admin->getPassword() == $request->getMd5Password()) {
                Session::assign('uId', $admin->getId());
                Session::assign('token', $this->getToken($admin));

                /**
                 * @todo setup project id (create function getUserProject result set Session)
                 */
                Session::assign('projectId', PlatformCommonProject::dao()->getByName('Pravda')->getId());

                return PlatformAuthAdminResponse::create()->setResult(TRUE);
            }
        } catch (ObjectNotFoundException $e) {
            Logger::me()->exception($e);
        } catch (BaseException $e) {
            Logger::me()->exception($e);
        }
        return PlatformAuthAdminResponse::create();
    }

    /**
     * is authorized user admin
     *
     * @return PlatformAuthAdminResponse
     */
    public function isAuthorized()
    {
        try {
            $response = PlatformAuthAdminResponse::create()->setResult(
                $this->isPasswordVerify(
                    PlatformUsersAdmin::dao()->getById(
                        Session::get('uId')
                    )
                )
            );

            Session::assign(
                'token',
                $this->getToken(
                    PlatformUsersAdmin::dao()->getById(
                        Session::get('uId')
                    )
                )
            );

            if(Session::get('access') == FALSE)
                $response->setResult(FALSE);

            return $response;
        } catch (BaseException $e) {
            Logger::me()->exception($e);
        }
        return PlatformAuthAdminResponse::create();
    }

    /**
     * logout user admin
     */
    public function logout()
    {
        try {
            Session::dropAll();
        } catch (BaseException $e) {
            Logger::me()->exception($e);
        }
    }

    /**
     * get token user admin
     *
     * @param PlatformUsersAdmin $admin
     * @return bool|null|string
     */
    public function getToken(PlatformUsersAdmin $admin)
    {
        if (is_null($this->token))
            $this->token = password_hash($admin->getPassword(), PASSWORD_BCRYPT);
        return $this->token;
    }


    /**
     * password verify user admin
     *
     * @param PlatformUsersAdmin $usersAdmin
     * @return bool
     */
    public function isPasswordVerify(PlatformUsersAdmin $usersAdmin)
    {
        return password_verify(
            $usersAdmin->getPassword(),
            Session::get('token')
        );
    }

    /**
     * @param PlatformAuthAdminRequest $request
     * @return Identifier|null
     */
    public function getAdminId(PlatformAuthAdminRequest $request)
    {
        return PlatformUsersAdmin::dao()
            ->getByLogin(
                $request->getLogin()
            )
            ->getId();
    }

    /**
     * @param PlatformLogsAdminAuthLogsRequest $request
     */
    public static function saveLog(PlatformLogsAdminAuthLogsRequest $request)
    {
        PlatformLogsAdminAuthLogs::saveLog($request);
    }

    /**
     * @param HttpRequest $request
     * @return bool
     */
    public static function isBlackList(HttpRequest $request)
    {
        if(self::isWhiteList($request))
            return FALSE;
        return
            PlatformUsersBlackIpList::isBlackListIp($request->getServerVar('REMOTE_ADDR'));
    }

    /**
     * @param HttpRequest $request
     * @return bool
     */
    public static function isWhiteList(HttpRequest $request)
    {
        return
            PlatformUsersWhiteIpList::isWhiteListIp($request->getServerVar('REMOTE_ADDR'));
    }

    /**
     * @param $ip
     * @param TimestampTZ $time
     */
    public static function addIpBlackList($ip, TimestampTZ $time)
    {
        PlatformUsersBlackIpList::addIp($ip, $time);
    }

    /**
     * @param $code
     * @return bool
     */
    public static function checkAdminCode($code)
    {
       return PlatformUsersAdminCode::checkCode($code, Session::get('uId'));
    }
}