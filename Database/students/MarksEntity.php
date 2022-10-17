<?php

namespace students;

require_once "Entity.php";
require_once "models/MarksDetails.php";

use students\models\MarksDetails;

class MarksEntity extends Entity
{
    protected const TABLE = 'marks';
    protected const TYPE = 'students\models\MarksDetails';

    public function insert(MarksDetails $details): bool|int
    {
        $query = 'INSERT INTO marks(mark1, mark2, mark3, mark4, mark5, user_id) 
        VALUES (:mark1, :mark2, :mark3, :mark4, :mark5, :user_id)';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("mark1" , $details->mark1);
        $stmt->bindParam("mark2" , $details->mark2);
        $stmt->bindParam("mark3" , $details->mark3);
        $stmt->bindParam("mark4" , $details->mark4);
        $stmt->bindParam("mark5" , $details->mark5);
        $stmt->bindParam("user_id" , $details->user_id);

        if ($stmt->execute()) {
            $details->id = $this->conn->lastInsertId();
            return $details->id;
        } else return false;
    }
}