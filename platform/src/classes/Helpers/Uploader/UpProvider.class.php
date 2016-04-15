<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.04.15
 * Time: 12:39
 */
namespace Helpers\Uploader {

    use Exceptions\UpProviderException;
    use Interfaces\IPlatformUp;

    class UpProvider extends BaseStore implements IPlatformUp
    {

        public function getConfig()
        {
            return \PlatformConfig::create()
                ->setConfig(ENVIRONMENT_PLATFORM)
                ->getItemConfig('UpProvider');
        }

        public function uploadFile(\PlatformFile $file)
        {
            try {
                foreach ($this->getConfig()->getItem('loadersClass')->get() as $loader) {

                    $loader = $loader::{'create'}();

                    if ($loader instanceof IPlatformUp) {
                        /** @var IPlatformUp $loader */

                        $loader->uploadFile($file);
                    }
                }
            } catch (\Exception $e) {
                throw new UpProviderException('no boot loader configuration');
            }
        }

        public function getFile(\PlatformFile $file)
        {
            try {
                foreach ($this->getConfig()->getItem('recipientClass')->get() as $recipient) {

                    $recipient = $recipient::{'create'}();

                    if ($recipient instanceof IPlatformUp) {
                        /** @var IPlatformUp $recipient */

                        if($recipient->getFile($file)){
                            TmpStore::create()->saveFile($file, $recipient->getFile($file));
                        };
                    }
                }
            } catch (\Exception $e) {
                throw new UpProviderException('no boot recipient configuration'. $e->getMessage() ." " . $e->getLine());
            }
        }

        public function getMultimediaHost()
        {
           return $this->getConfig()->getItem('returnMultimediaHost');
        }
    }
}