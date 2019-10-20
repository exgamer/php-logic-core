<?php
namespace concepture\php\logic\core\db;

use concepture\php\data\core\db\DataProvider as Base;
use concepture\php\data\core\db\Storage;

/**
 * Class DataProvider
 * @package concepture\php\logic\core\db
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class DataProvider extends Base
{
    protected $service;

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return Storage
     */
    public function getStorage()
    {
        return $this->getService()->getStorage();
    }
}