<?php

class newClass
{

    protected $result = array();

    protected $str;

    protected $result_str;

    static function create()
    {
        return new static();
    }


    public function index()
    {
        $array = ['top', 'top.help', 'top.help.name', 'top.help.name.dewid', 'top.help.first_name', 'top.info', 'top.info.information', 'top.game'];

        foreach ($array as $k => $v) {
            echo $this->prepare($v) . "</br>";
        }
    }

    public function prepare($v)
    {

        $this->result_str = "";

        $this->result[$v] = $v;
        if (count($this->result) == 1) {
            return '|--' . $v;
        }

        for ($i = 1; $i <= count(explode(".", $v)); $i++) {
            if ($i > count(explode(".", $v)) - 1) {
                $this->result_str .= "|--";
            } else {
                $this->result_str .= "|&nbsp&nbsp";
            };
        }

        return $this->result_srt . $v;
        //echo  count(explode(".",$v));

    }


    public function test(HttpRequest $httpRequest)
    {
        $fb = new \Facebook\Facebook($this->conectApiFacebook);

        $helper = $fb->getRedirectLoginHelper();
        $permissions =
            [
                'public_profile',
                'user_friends',
                'email',
                'user_about_me',
                'user_actions.books',
                'user_actions.fitness',
                'user_actions.music',
                'user_actions.news',
                'user_actions.video',
                'user_birthday',
                'user_education_history',
                'user_events',
                'user_games_activity', 'user_hometown', 'user_likes', 'user_location', 'user_managed_groups', 'user_photos',
                'user_posts', 'user_relationships', 'user_relationship_details', 'user_religion_politics', 'user_tagged_places',
                'user_videos', 'user_website', 'user_work_history', 'read_custom_friendlists', 'read_insights', 'read_audience_network_insights',
                'read_page_mailboxes', 'manage_pages', 'publish_pages', 'publish_actions', 'rsvp_event', 'pages_show_list', 'pages_manage_cta', 'ads_read', 'ads_management'];

        $loginUrl = $helper->getLoginUrl('http://localhost/fb-callback', $permissions);

        echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

        die;
    }

    public function fbCallbackAction(HttpRequest $request)
    {


        $fb = new \Facebook\Facebook($this->conectApiFacebook);

//
//        $access = $fb->getOAuth2Client()->getAccessTokenFromCode($request->getGetVar('code'), 'http://localhost/fb-callback');
//
//
//        print_r($access);die;

        $linkData = [
            'link' => 'http://www.pravda.ru/news/world/formerussr/other/12-01-2016/1288479-gumanit-0/',
            'message' => 'testing app',
            'group_id' => 1167217399975069
        ];
//
//
//        $linkData = [
//            'link' => 'http://www.pravda.ru/news/world/formerussr/other/12-01-2016/1288479-gumanit-0/',
//            'message' => 'gfdgfdgfdgdfg',
//            'place' => 1119568754721644,
//            'is_published' => true,
//            'include_hidden' => true,
//            'published' => true
//        ];




        try {
            $response = $fb->post('/1167217399975069/feed', $linkData, (new PlatformSocialApp())->dao()->getById(28)->getAppAdmin()->getAppAccessToken());
//            $response = $fb->get('/829309640524576/?fields=access_token', $access->getValue());

//    $response = $fb->get('/me/accounts', $access->getValue());
//            $response = $fb->sendRequest(
//                'GET',
//                '1167217399975069',
//                $params = [
//                    'id' => '1167217399975069',
//                    'link' => 'http://pravda.ru',
//                    'message' => 'test'
//                ],
//                $access->getValue()
//            );
//
//            $groupData = [
//                'name' => 'Test Group Name',
//                'admin' => 904798146272873,
//                'privacy' => 'open'
//
//            ];

            //         $response = $fb->get('/me/accounts', $access->getValue());


//         $response = $fb->post('/1119568754721644/feed', [
//             'message' => 'bla bla bla',
//             'link' => 'http://www.pravda.ru/news/world/12-01-2016/1288531-Istanbul-0/'
//         ], 'CAAVd4k7HZAL0BAChHuea5WXHZAPvXf7ZBXFAZAqQpTYL70yZCoxEKduZAiXIwthzGi57z8y5bKnZCxcgHkxmD3u0ZA6hrhEsVviTcefr8hX8uQod25lJGNubjatlu0tQgSQ8tcHgIDERCSLYBCRULcBDZC7cJWAZAGmkTS2jdjq6ein3lCTminJjDa');

        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
//
        echo  "<pre/>";
        print_r($response); die;

        $graphNode = $response->getGraphNode();


        echo 'Posted with id: ' . $graphNode['id'];

    }

}

newClass::create()->index();
