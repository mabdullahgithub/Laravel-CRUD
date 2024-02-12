<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class TestingApi extends Controller
{
    public function View(Request $request)
    {
        $username = $request->input('username');

        return response()->json([
            'username' => $username,
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    }
}
