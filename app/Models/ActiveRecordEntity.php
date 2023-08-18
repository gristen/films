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
    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    private function mapPropertiesToDbFormat():array
    {

        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();
        $mappedProperties = [];

        foreach ($properties as $property)
        {

            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore]=$this->$propertyName;

        }

        return $mappedProperties;
    }

    public function save():void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !==null)
        {
            $this->update($mappedProperties);
        }else
        {
            $this->insert($mappedProperties);
        }


    }

    public function delete(): void
    {
        $db = Db::getInstance();
        $db->query('DELETE FROM `' . static::getTableName() . '` WHERE id = :id', [':id' => $this->id]);
        $this->id = null;

    }


//$query = $dbh->prepare("UPDATE posts SET Title = :name , content = :dics , img = :img  WHERE id = $topID");
//$query->execute([
//"name"=>$postname,
//"dics"=>$postdics,
//"img"=>$PostimgName,
//]);

    private function update(array $mappedProperties):void
    {
        $columns2params = [];//сюда приходит поля которые в БД
        $params2value = [];//сдесь уже значения
        $index = 1;
        foreach ($mappedProperties as $column=>$value)
        {
            $param = ':param'.$index;// :param1
            $columns2params[] = $column . '=' . $param; // column 1 = :param1
            $params2value[$param] = $value; // [:param1 => value1]
            $index++;
        }
        $sql = 'UPDATE ' .static::getTableName() . ' SET '.implode(', ',$columns2params). ' WHERE id = '.$this->id;
        $db =DB::getInstance();
        $db->query($sql,$params2value,static::class);
    }

    private function insert(array $mappedProperties):void
    {
       $filteredProperties = array_filter($mappedProperties);
       $columns = [];
       $paramsNames = [];
       $params2value = [];

       foreach ($filteredProperties as $columnName =>$value)
       {
            $columns[] = '`' . $columnName . '`';
            $paramName = ':'.$columnName;
            $paramsNames[] = $paramName;
            $params2value[$paramName]=$value;
       }

       $columnsViaSAemicolon = implode(', ',$columns);
       $paramsNamesViaSAemicolon = implode(', ',$paramsNames);

       $sql = 'INSERT INTO ' . static::getTableName(). ' (' . $columnsViaSAemicolon . ') VALUES ( ' . $paramsNamesViaSAemicolon . ');';

       $db = DB::getInstance();
       $db->query($sql,$params2value,static::class);
     //  $this->refresh();

    }

    private function refresh(): void
    {
        $objectFromDb = static::getById($this->id);
        $reflector = new \ReflectionObject($objectFromDb);
        $properties = $reflector->getProperties();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $this->$propertyName = $property->getValue($objectFromDb);
        }
    }





    abstract protected static function getTableName():string;



}