<?php

namespace students\models;

class MarksDetails
{
    public int $mark1;
    public int $mark2;
    public int $mark3;
    public int $mark4;
    public int $mark5;
    public ?int $user_id = null;
    public ?int $id;

    public function asModel(): \MarksDetails
    {
        return new \MarksDetails(
            mark1: $this->mark1 ,
            mark2: $this->mark2 ,
            mark3: $this->mark3 ,
            mark4: $this->mark4 ,
            mark5: $this->mark5 ,
            userId: $this->user_id ,
            id: $this->id
        );
    }

}