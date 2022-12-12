<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ApiPublicController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

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
