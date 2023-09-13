<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Livro;
use App\Models\Livro as LivroModel;

class LivroRepository implements LivroRepositoryInterface
{
    public $model;

    public function __construct(LivroModel $model)
    {
        $this->model = $model;
    }

    public function create(Livro $livro): LivroModel
    {
        return $this->model->create($livro->toArray());
    }

    public function update(Livro $livro): LivroModel
    {
        if (!$livro->getId()) 
            throw new \Exception('ID indisponível.');

        $data = $this->model->find($livro->getId());

        if (!$data) 
            throw new \Exception('Registro inexistente.');

        $data->update($livro->toArray());

        return $data;
    }

    public function find(int $id): LivroModel
    {
        return $this->model->find($id);
    }

    public function destroy(int $id): void
    {
        if (!$this->model->exists($id)) 
            throw new \Exception('Registro inexistente.');

        $this->model->destroy($id);
    }
}