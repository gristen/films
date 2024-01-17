<?php

namespace App\Models;

use App\Kernel\auth\User;

class Review
{
    public function __construct(
        private int $id,
        private string $rating,
        private string $review,
        private string $createdAt,
        private User $user,

    ) {
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRating(): string
    {
        return $this->rating;
    }

    public function getReview(): string
    {
        return $this->review;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
