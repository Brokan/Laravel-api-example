<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    /**
     * Hard coded login
     * @var string 
     */
    private $apiAuthUser = 'test';
    
    /**
     * Hard coded password.
     * @var string 
     */
    private $apiAuthPassword = 'password';
    
    /**
     * Get header with authentication for API auth.
     * @return array
     */
    public function getAuthenticationHeader() : array {
        $basicAuth = base64_encode($this->apiAuthUser.":".$this->apiAuthPassword);
        return ['Authorization' => 'Basic '. $basicAuth];
    }
}
