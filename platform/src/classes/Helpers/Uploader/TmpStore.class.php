<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.04.15
 * Time: 12:33
 */
namespace Helpers\Uploader {

    use Interfaces\IPlatformUp;

    class TmpStore extends BaseStore implements IPlatformUp
    {
        private $fileNameAndPathTmp;

        /**
         * @return mixed
         */
        public function getFileNameAndPathTmp()
        {
            return $this->fileNameAndPathTmp;
        }

        /**
         * @param $fileNameAndPathTmp
         * @return $this
         */
        public function setFileNameAndPathTmp($fileNameAndPathTmp)
        {
            $this->fileNameAndPathTmp = $fileNameAndPathTmp;
            return $this;
        }


        public function getPath()
        {
            return UpProvider::create()
                ->getConfig()
                ->getItem('TmpStore')
                ->getItem('path');
        }

        public function uploadFile(\PlatformFile $file)
        {
            if (!file_exists($this->getPath() . $file->getUploadingPath()))
                mkdir($this->getPath() . $file->getUploadingPath(), 0777, true);
            try {
                \FileUtils::upload($file->getFile(), $this->getPath() . $file->getFileNameAndPath());
            } catch (\Exception $e) {
                $data = file_get_contents($file->getFile());
                file_put_contents($this->getPath() . $file->getFileNameAndPath(), $data);
            }
        }

        public function getFile(\PlatformFile $file)
        {
            // TODO: Implement getFile() method.
        }

        public function isFileExist()
        {
            return file_exists($this->getPath() . $this->getFileNameAndPathTmp());
        }

        public function saveFile(\PlatformFile $file, $data)
        {
            if (!file_exists($this->getPath() . $file->getUploadingPath()))
                mkdir($this->getPath() . $file->getUploadingPath(), 0777, true);

            file_put_contents($this->getPath() . $file->getFileNameAndPath(), $data);
        }

    }
}