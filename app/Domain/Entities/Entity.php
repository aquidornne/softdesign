<?php

namespace App\Domain\Entities;

interface Entity
{
    public function toArray(): array;
}