<?php
namespace concepture\php\logic\core\db;

use concepture\php\data\core\db\DataProvider as Base;
use concepture\php\data\core\db\Storage;
use concepture\php\logic\core\service\db\Service;

/**
 * Class DataProvider
 * @package concepture\php\logic\core\db
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
class DataProvider extends Base
{
    protected $service;

    /**
     * @return Service
     */
    public function getService() : Service
    {
        return $this->service;
    }

    /**
     * @param Service $service
     */
    public function setService(Service $service)
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