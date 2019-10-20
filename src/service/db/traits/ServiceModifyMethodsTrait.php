<?php
namespace concepture\php\logic\core\service\db\traits;

use concepture\php\data\core\data\DataValidationErrors;

/**
 * Trait ServiceModifyMethodsTrait
 * @package concepture\php\logic\core\service\traits
 * @author Olzhas Kulzhambekov <exgamer@live.ru>
 */
trait ServiceModifyMethodsTrait
{
    /**
     * @param $data
     * @return array
     */
    public function insert($data)
    {
        $data = $this->validateInsertData($data);
        if ($data instanceof DataValidationErrors) {

            return $data;
        }
        $this->beforeInsert($data);
        $this->beforeInsertExternal($data);
        $id = $this->getStorage()->insert($data);
        $this->afterInsert($data);
        $this->afterInsertExternal($data);

        return $id;
    }

    /**
     * @param $data
     * @return array
     */
    protected function validateInsertData($data)
    {

        return $this->validateData($data);
    }

    /**
     * @param $data
     */
    protected function beforeInsert(&$data){}

    /**
     * @param $data
     */
    protected function afterInsert(&$data){}

    /**
     * @param $data
     */
    protected function beforeInsertExternal(&$data){}

    /**
     * @param $data
     */
    protected function afterInsertExternal(&$data)
    {
    }

    /**
     * @param int $id
     * @param $data
     * @return array
     */
    public function updateById(int $id, $data)
    {
        $oldData = $this->getOldData(['id' => $id]);
        $changedData = $this->getChangedData($data, $oldData);
        $data = $this->validateUpdateData($data);
        if ($data instanceof DataValidationErrors) {

            return $data;
        }
        $this->preUpdate($id, $data, $oldData, $changedData);
        $this->preUpdateExternal($id, $data, $oldData, $changedData);
        $this->getStorage()->updateById($id, $data);
        $this->postUpdate($id, $data, $oldData, $changedData);
        $this->postUpdateExternal($id, $data, $oldData, $changedData);
    }

    /**
     * @param array $params
     * @param $condition
     * @return bool
     */
    public function update(array $params, $condition) : bool
    {
        return $this->getStorage()->update($params, $condition);
    }

    /**
     * @param $data
     * @return array
     */
    protected function validateUpdateData($data)
    {

        return $this->validateData($data);
    }

    /**
     * Метод для дополнительной обработки текущей сущности перед обновлением
     *
     * @param int $id
     * @param array $data
     * @param array $oldData
     * @param array $changedData
     */
    public function preUpdate(int $id, array  &$data,  array $oldData = [], array $changedData = []){}

    /**
     * Метод для дополнительной обработки текущей сущности после обновления
     *
     * @param int $id
     * @param array $data
     * @param array $oldData
     * @param array $changedData
     */
    public function postUpdate(int $id, array  &$data,  array $oldData = [], array $changedData = []){}

    /**
     * Метод для дополнительной обработки связанных сущностей перед обновлением
     *
     * @param int $id
     * @param array $data
     * @param array $oldData
     * @param array $changedData
     */
    public function preUpdateExternal(int $id, array  &$data,  array $oldData = [], array $changedData = []){}

    /**
     * Метод для дополнительной обработки связанных сущностей после обновления
     *
     * @param int $id
     * @param array $data
     * @param array $oldData
     * @param array $changedData
     */
    public function postUpdateExternal(int $id, array  &$data,  array $oldData = [], array $changedData = []){}

    /**
     * Удаление
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->preDelete($id);
        $this->preDeleteExternal($id);
        $this->getStorage()->deleteById($id);
        $this->postDelete($id);
        $this->postDeleteExternal($id);
    }

    /**
     * Метод для дополнительной обработки текущей сущности перед удалением
     *
     * @param int $id
     */
    public function preDelete(int $id){}

    /**
     * Метод для дополнительной обработки текущей сущности после удаления
     *
     * @param int $id
     */
    public function postDelete(int $id){}

    /**
     * Метод для дополнительной обработки связанных сущностей перед удалением
     *
     * @param int $id
     */
    public function preDeleteExternal(int $id){}

    /**
     * Метод для дополнительной обработки связанных сущностей после удаления
     *
     * @param int $id
     */
    public function postDeleteExternal(int $id){}


    public function validateData(array $data)
    {
        return $data;
    }

    /**
     * Возвращает старую запись
     *
     * @param array $condition
     * @return array
     */
    protected function getOldData(array $condition)
    {

        return [];
    }

    /**
     * Возвращает массив с измененными данными
     *
     * @param array $data
     * @param array $oldData
     *
     * Возвращает массив где значение массив данных где 1 элемент старове значение второй новое
     * [
     *      0 => 1,
     *      1 => 2
     * ]
     *
     * @return array
     */
    protected function getChangedData(array $data, array $oldData)
    {
        $changedData = [];
        foreach ($oldData as $attr=>$value){
            if (! isset($data[$attr])){
                continue;
            }
            if ($value == $data[$attr]){
                continue;
            }
            $changedData[$attr] = [
                $value,
                $data[$attr]
            ];
        }

        return $changedData;
    }
}

