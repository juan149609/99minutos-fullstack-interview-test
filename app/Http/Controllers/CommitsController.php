<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class CommitsController extends Controller
{
    /*
        Metodo encarago de obtener la informacion de un commit en especifico.
    */
    public function show($sha)
    {
        return Http::withBasicAuth(env('GITHUB_USER'), env('GITHUB_TOKEN'))
            ->get('https://api.github.com/repos/juan149609/99minutos-fullstack-interview-test/commits/' . $sha)
            ->json();
    }
}
