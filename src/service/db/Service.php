<?php
namespace concepture\php\logic\core\service\db;

use concepture\php\data\core\data\StorageInterface;
use concepture\php\data\core\db\DataModifyInterface;
use concepture\php\data\core\db\DataReadInterface;
use concepture\php\data\core\db\Storage;
use concepture\php\core\helper\ContainerHelper;
use concepture\php\logic\core\service\db\traits\ServiceModifyMethodsTrait;
use concepture\php\logic\core\service\db\traits\ServiceReadMethodsTrait;
use concepture\php\logic\core\service\Service as Base;
use ReflectionException;

/**
 * Class Service
 * @package concepture\php\logic\core\service\db
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
abstract class Service extends Base implements ServiceInterface, DataModifyInterface, DataReadInterface
{
    use ServiceModifyMethodsTrait;
    use ServiceReadMethodsTrait;

    /**
     * @var Storage
     */
    private $_storage;
    /**
     * @var array
     */
    private $storageConfig = [];

    /**
     * @return array
     */
    public function getStorageConfig(): array
    {
        return $this->storageConfig;
    }

    /**
     * @param array $storageConfig
     */
    public function setStorageConfig(array $storageConfig)
    {
        $this->storageConfig = $storageConfig;
    }

    /**
     * @return Storage
     * @throws ReflectionException
     */
    public function getStorage() : StorageInterface
    {
        if ($this->_storage instanceof StorageInterface){
            return $this->_storage;
        }
        $className = $this->getStorageClass();
        $storageConfig = [
            $className,
            $this->storageConfig
        ];
        $storage = ContainerHelper::createObject($storageConfig);
        $this->_storage = $storage;

        return $this->_storage;
    }

    /**
     * @return string
     */
    protected abstract function getStorageClass() : string;
}