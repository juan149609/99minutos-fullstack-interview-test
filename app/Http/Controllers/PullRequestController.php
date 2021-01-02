<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PullRequestController extends Controller
{
    
    /*
        Metodo encargado de obtener todos los puull request del repocitorio de la prueba.
    */
    public function index()
    {
        $response = Http::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))->
            get('https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/pulls?state=all');
        return view('pull-request', ['data' => $response->json()]);
    }

    /*
        Metodo encarago de obtener la informacion de un pull request en especifico a partir de su numero.
    */
    public function show($number)
    {
        return Http::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))->
            get('https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/pulls/' . $number);
    }

    /*
        Metodo encargado de cerrar un pull request a partir de su numero.
    */
    public function closePullReq($number)
    {
        HTTP::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))->
            patch('https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/pulls/' . $number,
            [
            'state' => 'closed'
        ]);
        return redirect('/pull-request');
    }

    /*
        Metodo encargado de mostrar la vista donde se crea un pull request con las branches del repositorio.
    */
    public function create(){
        $response = Http::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))->
            get('https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/branches');
        return view('create-pull-req', ['data' => $response->json()]);
    }

    /*
        Metodo encargado de crear un pull request, en caso de existir error se
        muestra redirecionando a la vista de error.
    */
    public function store(Request $request)
    {
        // Se crea el pull request
        $response = Http::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))
            ->post('https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/pulls', [
            'title' => $request->input('title') ?? '',
            'body' => $request->input('comment') ?? '',
            'head' => $request->input('head') ?? '',
            'base' => $request->input('base') ?? '',
        ]);

        if ($response->failed()) {
            return redirect('/error')->with('code', $response->status())->with('message', $response->json()['errors'][0]['message']);
        }

        // En caso que se necesite hacer merge, primero se crea y despues se acualisa.
        if($request->input('merge')){
            $url = 'https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/pulls/' . 
            $response->json()['number'] . '/merge';
            $response = Http::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))
                ->put($url, [
                'commit_title' => $request->input('title') ?? '',
                'commit_message' => $request->input('comment') ?? ''
            ]);
        }

        if ($response->failed()) {
            return redirect('/error')->with('code', $response->status())->with('message', $response->body());
        }
        return redirect('/pull-request');
    }
}
