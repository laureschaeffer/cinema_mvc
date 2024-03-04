<?php


namespace Model;

class GenreManager extends Manager {
    protected $tableName = "genre";

  

    public function getTableName()
    {
        return $this->tableName;
    }


    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }
}