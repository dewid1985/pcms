<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.04.15
 * Time: 12:33
 */
namespace Helpers\Uploader {

    use Interfaces\IPlatformUp;

    class LocalStore extends BaseStore implements IPlatformUp
    {
        public function getPath()
        {
            return UpProvider::create()
                ->getConfig()
                ->getItem('LocalStore')
                ->getItem('path');
        }


        public function uploadFile(\PlatformFile $file)
        {
            if (!file_exists($this->getPath() . $file->getUploadingPath()))
                mkdir($this->getPath() . $file->getUploadingPath(), 0777, true);

            copy(
                BaseStore::create()->getTmpStore()->getPath() . $file->getFileNameAndPath(),
                $this->getPath() . $file->getFileNameAndPath()
            );
        }

        public function getFile(\PlatformFile $file)
        {
            if(TmpStore::create()->setFileNameAndPathTmp($file->getFileNameAndPath())->isFileExist())
                return null;

            return file_get_contents($this->getPath().$file->getFileNameAndPath());
        }

    }
}