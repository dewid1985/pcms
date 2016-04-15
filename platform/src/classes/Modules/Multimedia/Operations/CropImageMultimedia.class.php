<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 24.03.15
 * Time: 11:10
 */
class CropImageMultimedia extends MultimediaOperation implements IModuleOperation
{
    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleMultimediaCropImageOperationRequest
     */
    private function getRequest()
    {
        return $this->getModuleObject()->getRequest();
    }

    /**
     * Выполнение операции
     *
     * @return mixed
     */
    public function operation()
    {
        PlatformMultimediaCroppedImages::dao()
            ->add(
                PlatformMultimediaCroppedImages::create()
                    ->setPath($this->getRequest()->getPath())
                    ->setImages($this->getRequest()->getImages())
                    ->setImagesSize($this->getRequest()->getImagesSize())
                    ->setCroppedAt($this->getRequest()->getCroppedAt())
            );
    }
}