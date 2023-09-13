<?php

namespace App\Domain\DTO;

use DateTime;

class TempoDTO implements DTO
{
    protected $description;
    protected $city;
    protected $city_name;
    protected $condition_slug;

    function __construct(
        string $description, 
        string $city, 
        string $city_name, 
        string $condition_slug
    )
    {
        $this->description = $description;
        $this->city = $city;
        $this->city_name = $city_name;
        $this->condition_slug = $condition_slug;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getCityName()
    {
        return $this->city_name;
    }

    public function getConditionSlug()
    {
        return $this->condition_slug;
    }

    public function toArray(): array
    {
        return [
            'description' => $this->description,
            'city' => $this->city,
            'city_name' => $this->city_name,
            'condition_slug' => $this->condition_slug,
        ];
    }
}
