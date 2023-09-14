<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Livro;

class LivroControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get('/livros');
        $response->assertStatus(200);
    }

    public function testShow()
    {
        $livro = Livro::factory()->create();
        $response = $this->get("/livros/{$livro->id}");
        $response->assertStatus(200);
    }

    public function testStore()
    {
        $livroData = [
            'titulo' => 'Novo Livro',
            'descricao' => 'Descrição do novo livro',
            'autor' => 'Autor do novo livro',
            'numero_de_paginas' => 200,
        ];

        $response = $this->post('/livros', $livroData);
        $response->assertStatus(201);

        $this->assertDatabaseHas('livros', $livroData);
    }

    public function testUpdate()
    {
        $livro = Livro::factory()->create();
        $livroData = [
            'titulo' => 'Novo Título',
            'descricao' => 'Nova Descrição',
            'autor' => 'Novo Autor',
            'numero_de_paginas' => 150
        ];

        $response = $this->put("/livros/{$livro->id}", $livroData);
        $response->assertStatus(200);

        $this->assertDatabaseHas('livros', $livroData);
    }

    public function testDestroy()
    {
        $livro = Livro::factory()->create();

        $response = $this->delete("/livros/{$livro->id}");
        $response->assertStatus(200);

        $this->assertNull(Livro::find($livro->id));
    }
}
