<?php

namespace App\Http\Controllers;

use App\Domain\Services\LivroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LivroController extends Controller
{
    protected $livroService;

    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

    public function index(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'limit' => 'integer',
                'offset' => 'integer',
                'order' => 'string',
                'typeOrder' => 'string',
                'titulo' => 'nullable|string',
                'descricao' => 'nullable|string',
                'autor' => 'nullable|string',
                'numero_de_paginas' => 'nullable|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 'Parâmetros inválidos'], 400);
            }

            $livros = $this->livroService->list($request->all());

            return response()->json($livros, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|string',
                'descricao' => 'required|string',
                'autor' => 'required|string',
                'numero_de_paginas' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 'Dados inválidos'], 400);
            }

            $this->livroService->create($request->all());

            return response()->json(['message' => 'Livro criado com sucesso'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $livro = $this->livroService->find($id);

            if (!$livro) {
                return response()->json(['error' => 'Livro não encontrado'], 404);
            }

            return response()->json($livro, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'titulo' => 'required|string',
                'descricao' => 'required|string',
                'autor' => 'required|string',
                'numero_de_paginas' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 'Dados inválidos'], 400);
            }

            $this->livroService->update($request->all(), $id);

            return response()->json(['message' => 'Livro atualizado com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->livroService->destroy($id);

            return response()->json(['message' => 'Livro excluído com sucesso'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
