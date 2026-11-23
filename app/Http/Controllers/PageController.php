<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function task($id)
    {
        $data = [
            'id' => $id,
            'title' => 'IT0049 - Section TW31',
        ];

        return view('task', $data);
    }
}