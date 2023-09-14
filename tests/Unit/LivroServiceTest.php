<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Domain\Services\LivroService;
use App\Domain\Repositories\LivroRepository;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Collection;

class LivroServiceTest extends TestCase
{
    public function testListarLivros()
    {
        Livro::factory(3)->create();
        $service = app(LivroService::class);
        $result = $service->list([]);
        $this->assertInstanceOf(Collection::class, $result['data']);
    }

    public function testCriarLivro()
    {
        $service = app(LivroService::class);

        $dadosLivro = [
            'titulo' => 'Livro de Teste',
            'descricao' => 'Descrição de Teste',
            'autor' => 'Autor de Teste',
            'numero_de_paginas' => 100,
        ];

        $service->create($dadosLivro);

        $livroCriado = Livro::where('titulo', 'Livro de Teste')->first();

        $this->assertNotNull($livroCriado);
    }

    public function testAtualizarLivro()
    {
        $livro = Livro::factory()->create();

        $service = app(LivroService::class);

        $dadosLivroAtualizado = [
            'titulo' => 'Novo Título',
            'descricao' => 'Nova Descrição',
            'autor' => 'Novo Autor',
            'numero_de_paginas' => 200,
        ];

        $service->update($dadosLivroAtualizado, $livro->id);

        $livroAtualizado = Livro::find($livro->id);

        $this->assertEquals($dadosLivroAtualizado['titulo'], $livroAtualizado->titulo);
        $this->assertEquals($dadosLivroAtualizado['descricao'], $livroAtualizado->descricao);
        $this->assertEquals($dadosLivroAtualizado['autor'], $livroAtualizado->autor);
        $this->assertEquals($dadosLivroAtualizado['numero_de_paginas'], $livroAtualizado->numero_de_paginas);
    }

    public function testExcluirLivro()
    {
        $livro = Livro::factory()->create();

        $service = app(LivroService::class);

        $service->destroy($livro->id);
        $livroExcluido = Livro::find($livro->id);

        $this->assertNull($livroExcluido);
    }
}