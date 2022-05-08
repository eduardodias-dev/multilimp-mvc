<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{
    //
    public function list(){
        return view('ordens.list');
    }
}
