<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use App\Http\Requests;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
        
    /**
     * Make response with error.
     * @param string $message
     * @param int $code
     * @return type
     */
    public function error(string $message, int $code) {
        return response()->json([
            'error' => $code . ': ' . $message
        ]);
    }
}
