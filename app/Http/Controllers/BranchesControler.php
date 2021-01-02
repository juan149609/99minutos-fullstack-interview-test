<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;


class BranchesControler extends Controller
{
    /*
        Metodo encargado de obtenemos todas las branches del repcitorio donde esta 
        alojado el proyecto del la prueba.
    */
    public function index()
    {
        $response = Http::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))
            ->get('https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/branches');
        $branches = $response->json();
        return view('branches', ['data' => $branches]);
    }
    
    /*
       Metodo encargado de obtener la informacion de una branch en especifico. 
    */
    public function show($sha){
        $response = Http::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))
            ->get('https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/commits?sha=' . $sha);
        $branch = $response->json();
        return view('branch', ['data' => $branch]);
    }

}
