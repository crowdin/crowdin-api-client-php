<?php


namespace Crowdin\Api\Service;

use Crowdin\Api\ApiInterface;
use Crowdin\Model\ModelInterface;

class ModelUpdateService
{
    protected $model;

    protected $api;

    /**
     * ModelUpdateService constructor.
     * @param ModelInterface $model
     * @param ApiInterface $api
     */
    public function __construct(ModelInterface $model, ApiInterface $api)
    {
        $this->model = $model;
        $this->api = $api;
    }

    /**
     * @return array
     */
    public function  getUpdateData()
    {
        //TODO fixed PK
        $dataModelPrev = $this->api->get($this->model->getPk());

        $dataModel = $this->model->getVars();

        $_data = [];

        foreach ($dataModelPrev->getData() as $key => $val)
        {
            if(isset($dataModel[$key]) && $dataModel[$key] != $val)
            {
                $_data[] = [
                    'op' => 'replace',
                    'path' => '/'.$key,
                    'value' => $dataModel[$key]
                ];
                //TODO array add|remove
            }
        }

        return $_data;
    }
}
