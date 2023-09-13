<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Livro;
use App\Models\Livro as LivroModel;

interface LivroRepositoryInterface
{
    public function create(Livro $livro): LivroModel;

    public function update(Livro $livro): LivroModel;

    public function find(int $id): LivroModel;

    public function destroy(int $id): void;
}
