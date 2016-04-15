<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.04.15
 * Time: 12:48
 */

namespace Helpers\Uploader {

    class BaseStore extends \PlatformBase
    {
        /**
         * @return TmpStore
         */
        public function getTmpStore()
        {
            return TmpStore::create();
        }

        /**
         * @param \PlatformFile $file
         */
        public function getFileTmp(\PlatformFile $file)
        {
            TmpStore::create()->getFile($file);
        }

        /**
         * @param \PlatformFile $file
         */
        public function uploadTmp(\PlatformFile $file)
        {

            TmpStore::create()->uploadFile($file);
        }
    }
}