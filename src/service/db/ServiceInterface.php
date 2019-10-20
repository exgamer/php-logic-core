<?php
namespace concepture\php\logic\core\service\db;

use concepture\php\data\core\db\Storage;
use concepture\php\logic\core\service\ServiceInterface as Base;

/**
 * Interface ServiceInterface
 * @package concepture\php\logic\core\service\db
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
interface ServiceInterface extends Base
{
    public function getStorage(): Storage;
}
