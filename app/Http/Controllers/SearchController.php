<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Logika pencarian Anda di sini
        $query = $request->input('query');
        // Misalnya, mencari dalam model `Post`
        $results = \App\Models\Post::where('title', 'LIKE', "%{$query}%")->get();

        return view('search.results', compact('results'));
    }
}

