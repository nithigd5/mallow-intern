<?php

namespace students;

use PDO;

class Database
{
    const URI = 'mysql:host=localhost;dbname=mallow_intern;charset=UTF8';
    const USER = 'root';
    const PASSWORD = '';

    public static ?PDO $INSTANCE = null;

    public static int $errorCode;

    /**
     * @return PDO|null
     */
    public static function getINSTANCE(): ?PDO
    {
        try {
            if (is_null(self::$INSTANCE)) {
                self::$INSTANCE = new PDO(Database::URI , Database::USER , Database::PASSWORD);
            }
            return self::$INSTANCE;
        } catch (\PDOException|\Exception $e) {
            self::$errorCode = $e->getCode();
            return null;
        }
    }

    /**
     * @throws \Exception
     */
    public static function beginTransaction(): bool
    {
        self::checkInstance();

        return Database::$INSTANCE->beginTransaction();
    }

    /**
     * @throws \Exception
     */
    public static function endTransaction(): bool
    {
        self::checkInstance();

        return Database::$INSTANCE->commit();
    }

    /**
     * @throws \Exception
     */
    public static function inTransaction(): bool
    {
        self::checkInstance();

        return Database::$INSTANCE->inTransaction();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public static function checkInstance(): void
    {
        if (is_null(Database::$INSTANCE))
            throw new \Exception('Unable to begin Transaction, Database connection not Established');
    }
}