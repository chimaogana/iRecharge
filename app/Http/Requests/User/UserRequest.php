<?php

namespace App\Http\Requests\User;

class UserRequest
{
   
    public $name;
    public $email;
    public $password;

    public function __construct($name, $email, $password)
    {
       
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function fromArray(array $data): self
    {
        return new self(
           
            $data['name'] ?? null,
            $data['email'] ?? null,
            $data['password'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
    }
}
