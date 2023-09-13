<?php

namespace App\Domain\Entities;

use DateTime;

class Livro implements Entity
{
    protected $id;
    protected $titulo;
    protected $descricao;
    protected $autor;
    protected $numeroDePaginas;

    public function __construct(
        int $id = null, 
        string $titulo, 
        string $descricao, 
        string $autor, 
        int $numeroDePaginas
    ) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->autor = $autor;
        $this->numeroDePaginas = $numeroDePaginas;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getNumeroDePaginas()
    {
        return $this->numeroDePaginas;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'titulo' => $this->getTitulo(),
            'descricao' => $this->getDescricao(),
            'autor' => $this->getAutor(),
            'numero_de_paginas' => $this->getNumeroDePaginas()
        ];
    }
}
