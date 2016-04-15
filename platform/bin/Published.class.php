<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 29.01.16
 * Time: 17:18
 */
include(getcwd() . DIRECTORY_SEPARATOR . 'bin_config.inc.php');

class Published
{
    public function __construct()
    {
        $this->published();
    }

    public function published()
    {

        $links = (new PlatformSocialPublishedLink())
            ->dao()->getNotPublished(10);

        foreach ($links as $link) {
            try {

                $this->inPage($link);
                $this->inGroup($link);

                $link
                    ->dao()
                    ->save(
                        $link
                            ->setPublished(true)
                            ->setPublishedAt(TimestampTZ::makeNow())
                    );

            } catch (ObjectNotFoundException $e) {
                continue;
            }
        }
    }

    private function inGroup(PlatformSocialPublishedLink $link)
    {
        foreach ($link->getFlow()->getGroups() as $dimension) {
            $group = $dimension->getGroup();
            $admin = $group->getAppAdmin();
            $app = $admin->getApp();

            if ((int)$app->getSocialNetwork()->getId() == PlatformSocialNameEnum::FACEBOOK) {
                $connect = [
                    'app_id' => '' . $app->getAppId() . '',
                    'app_secret' => '' . $app->getAppSecretKey() . '',
                    'default_graph_version' => 'v2.5'
                ];

                $facebook = new \Facebook\Facebook($connect);

                $feed = '/' . $group->getGroupId() . '/feed';

                $option = [
                    'message' => '' . $link->getDescription() . '',
                    'link' => '' . $link->getLinkUrl() . '',
                    'group_id' => '' . $group->getGroupId() . ''
                ];

                $accessToken = '' . $admin->getAppAccessToken() . '';

                $response = $facebook->post($feed, $option, $accessToken);

                (new PlatformSocialPublishedLinkData())
                    ->dao()
                    ->add(
                        (new PlatformSocialPublishedLinkData())
                            ->setAppAdminGroup($dimension->getGroup())
                            ->setSocialNetwork($app->getSocialNetwork())
                            ->setPublishedLink($link)
                            ->setPostId($response->getGraphPage()->getId())
                    );
            }

            if ((int)$app->getSocialNetwork()->getId() == PlatformSocialNameEnum::VK) {

                $response = (new VkRequest())
                    ->setAccessToken($admin->getAppAccessToken())
                    ->setImgUrl($link->getImgUrl())
                    ->setGroupId($group->getGroupId())
                    ->setMessage($link->getDescription())
                    ->setAttachments($link->getLinkUrl())
                    ->execute();

                (new PlatformSocialPublishedLinkData())
                    ->dao()
                    ->add(
                        (new PlatformSocialPublishedLinkData())
                            ->setAppAdminGroup($dimension->getGroup())
                            ->setSocialNetwork($app->getSocialNetwork())
                            ->setPublishedLink($link)
                            ->setPostId($response->getPostId())
                    );

            }

        }
    }

    private function inPage(PlatformSocialPublishedLink $link)
    {
        foreach ($link->getFlow()->getPages() as $dimension) {
            $page = $dimension->getPage();
            $admin = $page->getAppAdmin();
            $app = $admin->getApp();

            if ((int)$app->getSocialNetwork()->getId() == PlatformSocialNameEnum::FACEBOOK) {
                $connect = [
                    'app_id' => '' . $app->getAppId() . '',
                    'app_secret' => '' . $app->getAppSecretKey() . '',
                    'default_graph_version' => 'v2.5'
                ];

                $facebook = new \Facebook\Facebook($connect);

                $feed = '/' . $page->getPageId() . '/feed';

                $option = [
//                    'admin_creator' => "1119568754721644",
                    'message' => '' . $link->getDescription() . '',
                    'link' => '' . $link->getLinkUrl() . '',
                    'place' => '' . $page->getPageId() . ''
                ];

                $accessToken = '' . $page->getAccessToken() . '';

                $response = $facebook->post($feed, $option, $accessToken);

                (new PlatformSocialPublishedLinkData())
                    ->dao()
                    ->add(
                        (new PlatformSocialPublishedLinkData())
                            ->setAppAdminPages($dimension->getPage())
                            ->setSocialNetwork($app->getSocialNetwork())
                            ->setPublishedLink($link)
                            ->setPostId($response->getGraphPage()->getId())
                    );
            }
        }
    }
}

//new Published();

$connect = [
    'app_id' => '1119568754721644',
    'app_secret' => '8facbdaa20df4c3c8a0d8eff645a5df8',
    'default_graph_version' => 'v2.6'
];

$facebook = new \Facebook\Facebook($connect);

$feed = '/1167217399975069/feed';

$option = [
   'message' => 'bla bla bla bla bla',
    'admin_creator' =>'[name=super man]'
];



$response =
    $facebook
        ->post(
            $feed,
            $option,
            'EAAVd4k7HZAL0BAESk82sF989ZAZCWeFuD5CFLbZBBQa2RuziJhOXKi7lXs8waAiXBUrx8S9YE2rK2ZBFL4IMP5kDCJ9R8OcrCH9J0n2Ympgj4ZCqAUFcNZBNRrnAbaJnkAkGJXKW1foOWxtwoQQzKIxpsZC43ZCfRPiZCZAHqYWsHpQ3gZDZD'
        );
