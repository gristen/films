<?php

namespace App\Models;

class Movie
{
    public function __construct(
        private int $id,
        private string $film,
        private string $name,
        private string $description,
        private string $preview,
        private int $categoryId,
        private string $createdAt,
        private array $reviews = [],
    ) {
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPreview(): string
    {
        return $this->preview;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getReviews(): array
    {
        return $this->reviews;
    }

    public function avgRating(): float
    {

        $rating = array_map(function (Review $review) {
            return $review->getRating();
        }, $this->reviews);

        if (count($rating) > 0) {

            return round(array_sum($rating) / count($rating), 1);
        } else {
            return 0.0;
        }
    }

    public function getFilm(): string
    {
        return $this->film;
    }
}
