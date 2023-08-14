<?php

namespace app\Models\Films;

use app\Models\ActiveRecordEntity;
use app\Models\Users\UsersModel;
use app\Services\DB;

class Film extends ActiveRecordEntity
{

    protected $name;
    protected $text;
    protected $createdAt;
    protected $authorId;

    protected $filmPreviewPath;
    protected $filmPath;
    protected $hot;


    protected static function getTableName():string
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

    /**
     * @return mixed
     */
    public function getFilmPath()
    {
        return $this->filmPath;
    }

    /**
     * @return int
     */
//    public function getAuthorId()
//    {
//        return $this->authorId;
//    }

public function getAuthor():UsersModel //Возвращаем пользователя который опубликовал фильм
{
    return UsersModel::getById($this->authorId);
}





}