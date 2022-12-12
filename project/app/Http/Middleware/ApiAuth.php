<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class ApiAuth
{
    /**
     * Hard coded login
     * @var string 
     */
    private $user = 'test';
    
    /**
     * Hard coded password.
     * @var string 
     */
    private $password = 'password';
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $headerAuth = $request->header('authorization');
        if(empty($headerAuth)){
            return $this->errorResponse('No authorization in request', '101');
        }
        $authSplit = explode(' ', $headerAuth);

        if(empty($authSplit[0]) || $authSplit[0] !== 'Basic'){
            return $this->errorResponse('Is not "Basic" authorization', '102');
        }
        if(empty($authSplit[1]) || $authSplit[1] !== $this->getAuth64()){
            return $this->errorResponse('Wrong user or password', '103');
        }
        
        $response = $next($request);
        return $response;
    }
    
    /**
     * Get Auth in base64
     * @return string
     */
    private function getAuth64() : string {
        return base64_encode($this->user.":".$this->password);
    }
    
    /**
     * Make response with error.
     * @param string $message
     * @param int $code
     * @return type
     */
    private function errorResponse(string $message, int $code) {
        return response()->json([
            'error' => $code . ': ' . $message
        ]);
    }
}
