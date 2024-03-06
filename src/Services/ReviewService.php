<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Storage\StorageInterface;

class ReviewService
{
    public function __construct(private readonly DatabaseInterface $db, private ?StorageInterface $storage=null)
    {

    }
    public function getAllReviews()
    {
        $selectFields = 'r.*, m.name,m.preview AS movie_name, u.username';
        $joinClauses = [
            ['type' => 'INNER', 'table' => 'movies m', 'on' => 'r.movie_id = m.id'],
            ['type' => 'INNER', 'table' => 'users u', 'on' => 'r.user_id = u.id']
        ];
        $tableName = 'reviews r';

        $reviews = $this->db->join($selectFields, $tableName, $joinClauses);

        return $reviews;
    }




}