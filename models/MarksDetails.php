<?php

class MarksDetails
{
    public function __construct(
        public int  $mark1 ,
        public int  $mark2 ,
        public int  $mark3 ,
        public int  $mark4 ,
        public int  $mark5 ,
        public ?int $userId = null ,
        public ?int $id = null ,
    )
    {
    }

    public function asDatabaseModel(): \students\models\MarksDetails
    {
        $model = new students\models\MarksDetails();
        $model->mark1 = $this->mark1;
        $model->mark2 = $this->mark2;
        $model->mark3 = $this->mark3;
        $model->mark4 = $this->mark4;
        $model->mark5 = $this->mark5;
        $model->id = $this->id;
        $model->user_id = $this->userId;
        return $model;
    }

    public static function fromForm(array $form): MarksDetails
    {
        return new MarksDetails(
            $form['mark1'] ,
            $form['mark2'] ,
            $form['mark3'] ,
            $form['mark4'] ,
            $form['mark5'] ,
        );
    }
}