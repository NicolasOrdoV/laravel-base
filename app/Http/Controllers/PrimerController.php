<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimerController extends Controller
{
    function index()
    {
        $post = ['post1','post2'];
        return view('contact', compact('post'));
    }

    function otro($post, $otro)
    {
        echo $post . "/" . $otro;
    }
}
