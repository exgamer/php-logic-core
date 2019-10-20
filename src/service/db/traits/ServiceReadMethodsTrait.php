<?php
namespace concepture\php\logic\core\service\db\traits;

use concepture\php\data\core\db\ReadCondition;

/**
 * Trait ServiceReadMethodsTrait
 * @package concepture\php\logic\core\service\traits
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
trait ServiceReadMethodsTrait
{
    /**
     * Возвращает одну запись по id
     * @param int $id
     *
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     * @param array $condition
     * @return array
     */
    public function oneById(int $id, array $condition = null)
    {

        return $this->getStorage()->oneById($id, $condition);
    }

    /**
     * Возвращает запись по ассоциативному массиву условий
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     * @param array $condition
     * @return array
     */
    public function oneByCondition(array $condition)
    {

        return $this->getStorage()->oneByCondition($condition);
    }

    /**
     * Возвращает массив записей по идентификаторам
     *
     * @param array $ids
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     * @param array $condition

     * @return array
     */
    public function allByIds(array $ids, array $condition = null)
    {

        return $this->getStorage()->allByIds($ids, $condition);
    }

    /**
     * Возвращает массив записей по ассоциативному массиву условий
     * [
     *    'caption' => 'some',
     *    'description' => 'some',
     * ]
     *
     *
     * @param array $condition
     * @return array
     */
    public function allByCondition(array $condition)
    {

        return $this->getStorage()->allByCondition($condition);
    }

    /**
     * Возвращает данные по ReadCondition
     *
     * @param ReadCondition $condition
     * @return array
     */
    public function allByReadCondition(ReadCondition $condition)
    {

        return $this->getStorage()->allByCondition($condition);
    }
}

