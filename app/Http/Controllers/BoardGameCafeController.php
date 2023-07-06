<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BoardGameCafeController extends Controller
{
    public function index()
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
            'key' => env('GOOGLE_MAPS_API_KEY'),
            'query' => 'ボードゲームカフェ',
        ]);

        $results = $response->json()['results'] ?? [];

        return view('boardgamecafe.index', compact('results'));
    }
    
    public function map()
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/place/textsearch/json', [
        'key' => env('GOOGLE_MAPS_API_KEY'),
        'query' => 'ボードゲームカフェ',
    ]);

    $results = $response->json()['results'] ?? [];

    return view('boardgamecafe.map', compact('results'));
}
}