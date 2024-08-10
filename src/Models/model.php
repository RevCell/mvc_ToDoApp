<?php

namespace App\Models;

use App\Database\MySQL\MySQLConnection;

abstract class model
{
    protected $connection;
    protected $table;

    public function __construct()
    {
        $this->connection = MySQLConnection::getInstance();
        $this->connection->settable($this->table);
    }

    public function create(array $data)
    {
        $create=$this->connection->insert($data);
        if (!$create)
            return false;
        $lastInsertedId=$this->connection->lastInsertedId();
        return (new static())->where("id",$lastInsertedId)->get()[0] ?? false;


        /*$column_raw=array_keys($data);
        $column=implode(",",$column_raw);

        $value_raw_stg01=array_values($data);
        $value_raw_stg02=array_map(function ($value_raw_stg01){
            return "'$value_raw_stg01'";
        },$value_raw_stg01);
        $value=implode(",",$value_raw_stg02);
        $sql="insert into $this->table ($column) values ($value) ";
        var_dump($sql);*/

    }

    public function delete() :bool
    {
        return $this->connection->delete();
        /*$sql= "delete from $this->table where ";
        $col_val_sql=[];
        foreach ($col_val as $column => $value){
            $col_val_sql []= "$column='$value'";
        }
        $col_val_sql= implode(" AND ",$col_val_sql);
        $sql .=$col_val_sql;
        var_dump($sql);*/
    }

    public function where(string $column,$value): model
    {
        $this->connection->where([$column=>$value]);
        return $this;
    }

    public function get(array $column=['*'])
    {
        return $this->connection->select($column);
    }

    public function update(array $data,array $where=[]): bool
    {
        return $this->connection->where($where)->update($data);
    }
}