<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.04.15
 * Time: 12:34
 */

namespace Helpers\Uploader {

    use Interfaces\IPlatformUp;

    class WebDavStore extends BaseStore implements IPlatformUp
    {
        /**
         * @return $this|\PlatformArray
         */
        public function getConfig()
        {

            return UpProvider::create()
                ->getConfig()
                ->getItem('WebDavStore');
        }


        public function getPath()
        {
            return UpProvider::create()
                ->getConfig()
                ->getItem('WebDavStore')
                ->getItem('path');
        }

        public function uploadFile(\PlatformFile $file)
        {
            $config = $this->getConfig();

            $file->fileOpenTmp();

            \WebDav::create()
                ->setPassword($config->getItem('password'))
                ->setUser($config->getItem('user'))
                ->setUrl($config->getItem('host') . $config->getItem('path') . $file->getFileNameAndPath())
                ->setOption(CURLOPT_PUT, 1)
                ->setOption(CURLOPT_INFILE, $file->getOpenFile())
                ->setOption(CURLOPT_INFILESIZE, $file->getFileSize())
                ->init(true);
        }

        public function getFile(\PlatformFile $file)
        {
            $config = $this->getConfig();

            if(TmpStore::create()->setFileNameAndPathTmp($file->getFileNameAndPath())->isFileExist())
                return null;

            return \WebDav::create()
                ->setPassword($config->getItem('password'))
                ->setUser($config->getItem('user'))
                ->setUrl($config->getItem('host') . $config->getItem('path') . $file->getFileNameAndPath())
                ->setOption(CURLOPT_HEADER, 0)
                ->setOption(CURLOPT_RETURNTRANSFER, 1)
                ->init(true);

        }

    }
}