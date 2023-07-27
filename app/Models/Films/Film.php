<?php

namespace app\Models\Films;

use app\Services\DB;

class Film
{
    private $id;
    private $name;
    private $text;
    private $createdAt;
    private $authorId;

    private $filmPreviewPath;
    private $filmPath;
    private $hot;

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
        $db = new DB();
        return $db->query("SELECT * FROM `".static::getTableName() . '`;',[],static::class);
    }

    public static function getTableName()
    {
        return 'films';
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText() :string
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getFilmPreviewPath()
    {
        return $this->filmPreviewPath;
    }



    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
}