<?php

namespace students\models;

class UserDetails
{
    public string $name;
    public string $date_of_birth;
    public string $phone;
    public string $email;
    public string $address;
    public string $gender;
    public ?string $profile = null;
    public ?string $id = null;


    public function asModel(): \UserDetails
    {
        return new \UserDetails(
            name: $this->name ,
            dateOfBirth: \DateTime::createFromFormat('Y-m-d' , $this->date_of_birth) ,
            phone: $this->phone ,
            email: $this->email ,
            address: $this->address ,
            gender: $this->gender ,
            profile: $this->profile ,
            id: $this->id
        );
    }
}