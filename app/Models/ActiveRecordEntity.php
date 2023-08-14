<?php

namespace app\Models;

use app\Models\Films\Film;
use app\Services\DB;

abstract class ActiveRecordEntity
{
    protected $id;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    public static function getById(int $id): ?self // self данном контексте означает текущий класс, то есть класс, в котором объявлен данный метод
    {
        $db = DB::getInstance();
        $ent = $db->query('SELECT * FROM`'.static::getTableName().'`WHERE id = :id;',[':id'=>$id],static::class);
        return $ent?$ent[0]:null; // Возвращает первый объект из результата запроса или null, если результаты отсутствуют
    }
    public function __set($name, $value) //сюда прилетают название полей с БД которые не соответствуют с свойствами в классе и мы тут уже манипулируем с их названием
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    /**
     * @return Film[]
     */
    public static function findAll():array
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM `".static::getTableName() . '`;',[],static::class); //класс у которого этот метод вызвали
    }
    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }


    abstract protected static function getTableName():string;



}