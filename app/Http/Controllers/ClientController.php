<?php

namespace App\Http\Controllers;


use App\Models\Client;
use App\Models\Fonction;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::all();
        $functions = Fonction::all();
        return view("clients.index",compact("clients","functions"));
    }
}
