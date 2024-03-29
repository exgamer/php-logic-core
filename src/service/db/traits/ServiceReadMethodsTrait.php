<?php
namespace concepture\php\logic\core\service\db\traits;

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
     * @param  $condition
     * @return array
     */
    public function oneById(int $id, $condition = null) : array
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
     * @param $condition
     * @return array
     */
    public function oneByCondition($condition) : array
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
     * @param $condition

     * @return array
     */
    public function allByIds(array $ids, $condition = null) : array
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
     * @param $condition
     * @return array
     */
    public function allByCondition($condition) :array
    {

        return $this->getStorage()->allByCondition($condition);
    }
}

