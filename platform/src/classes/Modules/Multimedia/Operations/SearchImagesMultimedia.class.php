<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.03.15
 * Time: 15:26
 */
class SearchImagesMultimedia extends MultimediaOperation implements IModuleOperation
{

    /**
     * __construct
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleMultimediaSearchOperationRequest
     */
    protected function getRequest()
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
            $data = $this->preparedData(
                PlatformMultimediaImages::dao()->getBySearchOperationRequest($this->getRequest())
            );

            $this->getModuleObject()->setResponse(
                ModuleMultimediaSearchOperationResponse::create()
                    ->setDraw($this->getRequest()->getDraw())
                    ->setRecordsTotal(empty($data[0]['count']) ? 0 : $data[0]['count'])
                    ->setRecordsFiltered(empty($data[0]['count']) ? 0 : $data[0]['count'])
                    ->setData($data)
            );
    }

    private function preparedData(array $data)
    {
        foreach ($data as $k => $v) {
            $data[$k]['ico_file'] = Helpers\Uploader\UpProvider::create()->getMultimediaHost() . $v['ico_file'];
        }

        return $data;
    }
}