<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\todo;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function printPreview(){
        return view("welcome");
    }
}
