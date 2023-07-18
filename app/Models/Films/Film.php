<?php

namespace app\Models\Films;

class Film
{
    protected $name;
    protected $text;
    protected $authorId;
    protected $created;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }
}