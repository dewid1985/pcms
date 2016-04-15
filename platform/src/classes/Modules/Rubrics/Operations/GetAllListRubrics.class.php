<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 19.01.15
 * Time: 13:11
 */
class GetAllListRubrics extends RubricsOperation implements IModuleOperation
{
    protected $rubricsList = array();

    protected $test;

    /**
     * @return array
     */
    public function getRubricsList()
    {
        return $this->rubricsList;
    }

    /**
     * @param array $rubricsList
     */
    public function setRubricsList($rubricsList)
    {
        $this->rubricsList = $rubricsList;
    }


    function __construct()
    {
        parent::__construct();
    }

    /**
     * @return ModuleRubricsGetAllListOperationRequest
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
        try{
            $data = PlatformCommonRubric::dao()->getListRubricsByProject(
                PlatformCommonProject::dao()->getById($this->getRequest()->getProjectId())
            );
        }catch (ObjectNotFoundException $e)
        {
            $data = array();
        }
        $this->getModuleObject()->setResponse(
            ModuleRubricsGetAllListOperationResponse::create()
                ->setData(
                    $this->prepareData($data)
                )
        );

    }

    protected function prepareData($data)
    {
        $result = array();
        foreach ($data as $k => $v) {
            /** @var PlatformCommonRubric $v */
            $args = array();
            $tmp = array_reverse(explode('.', $v->getPath()));
            $temp = array();

            for ($t = 0, $countTmp = count($tmp); $t < $countTmp; $t++) {
                unset($r);
                $r[$tmp[$t]] = $temp;
                $temp = $r;
            }

            $args = array_merge_recursive($args, $temp);
            $result = array_merge_recursive($result, $args);
        }

        return $this->insertArrayRubric($result);
    }

    protected function insertArrayRubric(array $data)
    {
        $result = array();
        $key = 0;

        foreach ($data as $k => $v) {

            $result[$key]['dataId'] = PlatformCommonRubric::dao()->getByName($k)->getName();
            $result[$key]['value'] = PlatformCommonRubric::dao()->getByName($k)->getRubricData()->getShortName();

            if (count($v) == 0) {
                $result[$key]['data'] = array();
            } else {
                $result[$key]['data'] = $this->insertArrayRubric($v);
            }
            $key++;
        }
        return $result;
    }
}