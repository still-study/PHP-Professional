<?php

//class Db
//{
//    protected $tableName;
//
//    public function table($tableName)
//    {
//        $this->tableName = $tableName;
//        return $this;
//    }
//
//    public function first($id)
//    {
//        $sql = "SELECT * FROM {$this->tableName} WHERE id = {$id}";
//        return $sql;
//    }
//}
//
//$db = new Db();
//
//echo $db->table('user')->first(3);
////выведет SELECT * FROM user WHERE id = 3


class Db
{
    protected $tableName;
    protected $whereParam = [];

    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function get()
    {
        if (!empty($this->whereParam)) {

            $where = "WHERE " . implode(" AND ", $this->whereParam);
        } else $where = "";
        $sql = "SELECT * FROM {$this->tableName} {$where}";
        return $sql;
    }

    public function where($param1, $param2)
    {
        $array = [$param1, $param2];
        $value = implode(" = ", $array);
        array_push($this->whereParam, $value);
        return $this;
    }

}

$db = new Db();

echo $db->table('product')->where('name', 'Alex')->where('session', 123)->where(id, 5)->get();
//что должно вывести SELECT * FROM product WHERE name = Alex AND session = 123 AND id = 5
