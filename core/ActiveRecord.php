<?php

namespace app\core;

class ActiveRecord extends BaseModel
{
    /**
     * @return string
     */
    public static function getPrimaryKey(): string
    {
        return "id";
    }

    /**
     * @param int $id
     * @return array|mixed
     */
    public static function getById(int $id)
    {
        $sql = "SELECT * FROM " . static::getTable() . " WHERE " . static::getPrimaryKey() . "=" . $id;

        $result = self::query($sql);

        return self::populate($result);
    }

    /**
     * @return array|mixed
     */
    public static function getAll()
    {
        $sql = "SELECT * FROM " . static::getTable();
        $result = self::query($sql);

        return self::populate($result);
    }

    /**
     * @param string $sqlQuery
     * @param int $mode
     * @return array
     */
    public static function query(string $sqlQuery = "", $mode = \PDO::FETCH_ASSOC): array
    {
        try {
            $params = Application::$app->db->pdo->prepare(
                $sqlQuery
            );

            $params->execute();
            return $params->fetchAll($mode);
        } catch (\Exception $e) {
            echo "Internal database error";
            return [];
        }
    }

    /**
     * @param array $result
     * @return array|mixed
     */
    private static function populate(array $result = []) {
        $objResult = [];

        foreach ($result as $record) {

            $class = get_called_class();
            $obj = new $class;

            foreach ($record as $column => $value) {
                if (property_exists($obj, $column)) {
                    $obj->$column = $value;
                }
            }
            if (count($result) === 1) {
                return $obj;
            }
            $objResult[] = $obj;
            unset($obj);
        }

        return $objResult;
    }


}