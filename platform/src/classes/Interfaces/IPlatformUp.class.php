<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 03.04.15
 * Time: 18:12
 */

namespace Interfaces {

    interface IPlatformUp
    {
        public function uploadFile(\PlatformFile $file);

        public function getFile(\PlatformFile $file);

        public function getFileTmp(\PlatformFile $file);

        public function uploadTmp(\PlatformFile $file);
    }
}