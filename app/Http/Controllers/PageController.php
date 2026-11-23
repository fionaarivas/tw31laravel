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
            'title' => 'Membership Management System',
        ];

        return view('task', $data);
    }
}