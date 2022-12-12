<?php
namespace App\ValueObjects\Clients;

class ClientValueObject
{
    private $firstName;
    private $lastName;
    private $email;
    private $phone;
    
    /**
     * 
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone
     */
    public function __construct(string $firstName, string $lastName, string $email, string $phone ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
    }
 
    public function getFirstName() : string {
        return $this->firstName;
    }
    
    public function getLastName() : string {
        return $this->lastName;
    }
    
    public function getEmail() : string {
        return $this->email;
    }
    
    public function getPhone() : string {
        return $this->phone;
    }
}
