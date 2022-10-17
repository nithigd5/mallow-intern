<?php

require_once 'Database/students/Database.php';
require_once 'Database/students/UserEntity.php';
require_once 'Database/students/MarksEntity.php';

use students\Database;
use students\MarksEntity;
use students\UserEntity;

class DatabaseFormHelper
{
    public static ?Exception $error;

    public static function uploadForm(UserDetails $userDetails , MarksDetails $marksDetails): bool
    {
        try {
            $userEntity = new UserEntity(Database::getINSTANCE());
            $marksEntity = new MarksEntity(Database::getINSTANCE());

            $userId = $userEntity->insert($userDetails->asDatabaseModel());

            if (!$userId) {
                static::$error = new Exception("Unable to Insert  user");
                return false;
            }
            $userDetails->id = $userId;
            $marksDetails->userId = $userId;

            $markId = $marksEntity->insert($marksDetails->asDatabaseModel());

            if (!$markId) {
                DatabaseFormHelper::$error = new Exception("Unable To Insert Students Marks Details");
                return false;
            }
            $marksDetails->id = $markId;

            return true;
        } catch (Exception $e) {
            static::$error = $e;
            return false;
        }
    }
}