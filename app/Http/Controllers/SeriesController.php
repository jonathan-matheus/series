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
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome', 'asc')->get();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
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
        $serie = Serie::create($request->all());
        $request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' cadastrada com sucesso!");

        return to_route('series.index');
    }

    public function destroy(Serie $serie, Request $request)
    {
        Serie::destroy($serie->id);
        $request->session()->flash('mensagem.sucesso', "Série '{$serie->nome}' removida com sucesso!");

        return to_route('series.index');
    }
}
