<?php

namespace App\Database\MySQL;

use App\Database\Databasconnectioninterface;
use App\Database\DatabaseOperationInterface;
use JetBrains\PhpStorm\NoReturn;

class MySQLConnection implements Databasconnectioninterface,DatabaseOperationInterface
{
    //------------------------prop_str--------------------------------------
    protected static $database;
    protected $connection;
    protected $where ='';
    protected $table;
    protected $where_values_raw;
    //------------------------prop_end--------------------------------------

    //------------------------method_str--------------------------------------
    private function __construct()
    {
        $dsn= "mysql:host=localhost;dbname=todo_list;";
        $db_connect=new \PDO($dsn,"root","");
        $db_connect->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        $this->connection=$db_connect;
    }

    public static function getInstance()
    {
        if (!empty(self::$database))
            return self::$database;
        self::$database = new self;
        return self::$database;
    }

    public function connection(): \PDO
    {
        return $this->connection;
    }

    public function execute($sql)
    {
        $this->connection->query($sql);
    }

    public function where(array $data = [],string $operator = "AND"): MySQLConnection
    {
        $sql= " where ";
        $col_val_sql=[];
        $where_values_raw=[];
        foreach ($data as $column => $value){
            $col_val_sql []= "$column=:$column";
            $where_values_raw[":$column"]=$value;
        }
        $col_val_sql= implode("$operator",$col_val_sql);
        $sql .=$col_val_sql;
        $this->where .= $sql;
        $this->where_values_raw = $where_values_raw;
        return $this;
    }

    public function settable($table)
    {
        $this->table=$table;
    }

    public function delete() :bool
    {
       $sql="DELETE FROM $this->table";
       if (!empty($this->where)){
           $sql .= $this->where;
       }
       $prep_statment=$this->connection->prepare($sql);
       return $prep_statment->execute($this->where_values_raw);
    }

    public function insert(array $data): bool
    {
        $column_raw=array_keys($data);
        $values_raw=[];
        foreach ($data as $columns => $values){
            $values_raw[":$columns"]=$values;
        }
        $column=implode(",",$column_raw);
        $values=implode(",",array_keys($values_raw));
        $sql="insert into $this->table ($column) values ($values) ";
        $prep_statment=$this->connection->prepare($sql);
        /*var_dump($prep_statment);
        die();*/
        try {
            return $prep_statment->execute($values_raw);
        }
        catch (\Exception $e){
            return false;
        }
    }

    public function select(array $columns=["*"])
    {
        $sql="SELECT ". implode(",",$columns)."FROM ". $this->table ;
        if (!empty($this->where))
        {
            $sql .=$this->where;
        }
        $prep_statment=$this->connection->prepare($sql);
        $prep_statment->execute($this->where_values_raw);
        return $prep_statment->fetchAll();
    }

        public function update(array $data) :bool
    {
        $sql = "UPDATE $this->table SET ";
        $values_with_prefix=[];
        $preColumns_with_values=[];
        foreach ($data as $columns => $values){
            $values_with_prefix[] = "$columns=:UPDATE_$columns";
            $preColumns_with_values[":UPDATE_$columns"]=$values;
        }
        $values_with_prefix=implode(",",$values_with_prefix);
        $sql .=$values_with_prefix;
        if (!empty($this->where)){
            $sql .=$this->where;
        }
        $prep_statement=$this->connection->prepare($sql);
        $merge_params=array_merge($preColumns_with_values,$this->where_values_raw);
        //var_dump($prep_statement); exit();
        return $prep_statement->execute($merge_params);
    }

    public function lastInsertedId()
    {
        return $this->connection->lastInsertId();
    }
}