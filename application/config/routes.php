<?php

return [
    'GET' => [
        '/' => "home#index",
        '/home/exampleone' => "home#exampleone",
        '/home/exampletwo' => "home#exampletwo",

        '/songs' => "songs#index",
        '/songs/ajaxGetStats' => "songs#ajaxGetStats",
        '/songs/deletesong/{id}' => "songs#deleteSong",
        '/songs/editsong/{id}' => "songs#editSong",

        '/error' => "error#index"
    ],

    'POST' => [
        '/songs/addsong' => "songs#addSong",
        '/songs/updatesong' => "songs#updateSong"
    ]
];


