<?php

class UserDetails
{
    public function __construct(
        public string   $name ,
        public DateTime $dateOfBirth ,
        public string   $phone ,
        public string   $email ,
        public string   $address ,
        public string   $gender,
        public ?string  $profile = null ,
        public ?string  $id = null
    )
    {
    }

    public function asDatabaseModel(): \students\models\UserDetails
    {
        $model = new students\models\UserDetails();
        $model->name = $this->name;
        $model->date_of_birth = $this->dateOfBirth->format('Y-m-d');
        $model->phone = $this->phone;
        $model->email = $this->email;
        $model->id = $this->id;
        $model->gender = $this->gender;
        $model->address = $this->address;
        $model->profile = $this->profile;

        return $model;
    }

    public static function fromForm(array $form): UserDetails
    {
        return new UserDetails(
            name: $form['name'] ,
            dateOfBirth: $form['dob'] ,
            phone: $form['mobile'] ,
            email: $form['email'] ,
            address: $form['address'] ,
            gender: $form['gender'] ,
            profile: $form['profile'] ,
            id: null
        );
    }

}