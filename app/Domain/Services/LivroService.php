<?php 

namespace App\Domain\Services;

use App\Domain\Repositories\LivroRepository;
use App\Domain\Entities\Livro;
use App\Models\Livro as LivroModel;

class LivroService
{
    protected $livroRepository;

    public function __construct(LivroRepository $livroRepository)
    {
        $this->livroRepository = $livroRepository;
    }

    public function list(array $data): array
    {
        $queryA = $this->livroRepository->model->query();
        $queryB = $this->livroRepository->model->query();

        $limit = isset($data['limit']) ? $data['limit'] : 10;
        $offset = isset($data['offset']) ? $data['offset'] : 0;
        $ordem = $data['order'] ?? 'created_at';
        $tp_ordem = $data['typeOrder'] ?? 'asc';

        $lista = $queryA
            ->where($this->filter($data))
            ->offset($limit * $offset)
            ->limit($limit)
            ->orderBy($ordem, $tp_ordem)
            ->get();

        $total = $queryB
            ->where($this->filter($data))
            ->count();

        return [
            'data' => $lista,
            'total' => $total
        ];
    }

    private function filter(array $dados): array
    {
        $where = [];

        if (isset($dados['titulo'])) {
            $where[] = ['titulo', 'like', '%' . $dados['titulo'] . '%'];
        }

        if (isset($dados['descricao'])) {
            $where[] = ['descricao', 'like', '%' . $dados['descricao'] . '%'];
        }

        if (isset($dados['autor'])) {
            $where[] = ['autor', 'like', '%' . $dados['autor'] . '%'];
        }

        if (isset($dados['numero_de_paginas'])) {
            $where[] = ['numero_de_paginas', '=', $dados['numero_de_paginas']];
        }

        return $where;
    }

    public function create(array $data): LivroModel
    {
        $livro = new Livro(
            null,
            $data['titulo'],
            $data['descricao'],
            $data['autor'],
            $data['numero_de_paginas']
        );

        return $this->livroRepository->create($livro);
    }

    public function update(array $data, int $id): LivroModel
    {
        $livro = new Livro(
            $id,
            $data['titulo'],
            $data['descricao'],
            $data['autor'],
            $data['numero_de_paginas']
        );

        return $this->livroRepository->update($livro);
    }

    public function find (int $id): LivroModel
    {
        return $this->livroRepository->find($id);
    }

    public function destroy (int $id): void
    {
        $this->livroRepository->destroy($id);
    }
}
