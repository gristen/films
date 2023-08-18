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


    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setAuthor(UsersModel $user):void
    {
        $this->authorId = $user->getId();
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }

    /**
     * @param mixed $filmPath
     */
    public function setFilmPath($filmPath): void
    {
        $this->filmPath = $filmPath;
    }

    /**
     * @param mixed $filmPreviewPath
     */
    public function setFilmPreviewPath($filmPreviewPath): void
    {
        $this->filmPreviewPath = $filmPreviewPath;
    }

    /**
     * @param mixed $hot
     */
    public function setHot($hot): void
    {
        $this->hot = $hot;
    }


public function getAuthor():UsersModel //Возвращаем пользователя который опубликовал фильм
{
    return UsersModel::getById($this->authorId);
}





}