<?php


namespace students;

require_once "models/UserDetails.php";
require_once "Entity.php";

use students\models\UserDetails;

class UserEntity extends Entity
{
    protected const TABLE = 'students';
    protected const TYPE = 'students\models\userDetails';

    public function insert(UserDetails $details): int|bool
    {
        $stmt = $this->conn->prepare(
            'INSERT INTO students (name, date_of_birth, phone, email, address, gender, profile) 
                    VALUES (:name, :date_of_birth, :phone, :email, :address, :gender, :profile)'
        );
        $stmt->bindParam("name" , $details->name);
        $stmt->bindParam("gender" , $details->gender);
        $stmt->bindParam("date_of_birth" , $details->date_of_birth);
        $stmt->bindParam("email" , $details->email);
        $stmt->bindParam("address" , $details->address);
        $stmt->bindParam("phone" , $details->phone);
        $stmt->bindParam("profile" , $details->profile);

        if ($stmt->execute()) {
            $details->id = $this->conn->lastInsertId();
            return $details->id;
        } else return false;
    }

}