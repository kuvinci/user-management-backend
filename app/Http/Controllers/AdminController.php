<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function index(): JsonResponse
    {
        $data = [
            'stats' => [
                'users' => 100,
            ],
        ];

        return response()->json($data);
    }
}
