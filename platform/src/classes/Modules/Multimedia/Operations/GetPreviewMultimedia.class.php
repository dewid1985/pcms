<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.03.15
 * Time: 13:03
 */
class GetPreviewMultimedia extends MultimediaOperation implements IModuleOperation
{

    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleMultimediaGetPreviewListRequest
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
        $this->getModuleObject()->setResponse(
            ModuleMultimediaGetPreviewListResponse::create()->setData(
                $this->prepareData(
                    PlatformMultimediaImages::dao()
                        ->getById($this->getRequest()->getId())->getPreview())
            )
        );
    }

    public function prepareData(array $array)
    {
        $r = [];
        foreach ($array as $k => $v) {
            /** @var PlatformMultimediaCroppedImages $v */

            $r[] = [
                'path' => Helpers\Uploader\UpProvider::create()->getMultimediaHost() . $v->getPath(),
                'title' => $v->getImagesSize()->getTitle(),
                'width' => $v->getImagesSize()->getWidth(),
                'height' => $v->getImagesSize()->getHeight()
            ];
        }
        return $r;
    }
}