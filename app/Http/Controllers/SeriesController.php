<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeriesController extends Controller
{
    /**
     * Exibe uma lista de séries.
     *
     * @return \Illuminate\View\View Retorna a visão 'series.index' com a lista de séries.
     */
    public function index()
    {
        $series = Serie::query()->orderBy('nome', 'asc')->get();

        return view('series.index')->with('series', $series);
    }

    /**
     * Exibe o formulário para criar uma nova série.
     *
     * @return \Illuminate\View\View A view para criar uma nova série.
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Armazena uma nova série no banco de dados.
     *
     * Este método recebe uma requisição HTTP contendo o nome da série,
     * cria uma nova instância do modelo Serie, define o nome da série
     * e salva a instância no banco de dados. Após salvar, redireciona
     * o usuário para a lista de séries.
     *
     * @param \Illuminate\Http\Request $request A requisição HTTP contendo os dados da nova série.
     * @return \Illuminate\Http\RedirectResponse Redireciona para a rota '/series'.
     */
    public function store(Request $request)
    {
        Serie::create($request->all());
        return to_route('series.index');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->serie);

        return to_route('series.index');
    }
}
