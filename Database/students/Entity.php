<?php

namespace students;

use Exception;
use PDO;

abstract class Entity
{
    protected const TABLE = '';
    protected const TYPE = '';
    public Exception $error;


    /**
     * @throws Exception
     */
    public function __construct(protected readonly ?PDO $conn)
    {
        if (is_null($conn)) {
            throw new Exception("No Database Connection");
        }
    }

    function getAll(): bool|array
    {
        $TABLE = static::TABLE;

        try {
            $stmt = $this->conn->query("SELECT *FROM {$TABLE}");
        } catch (Exception $e) {
            $this->error = $e;
            return false;
        }

        $stmt->setFetchMode(PDO::FETCH_CLASS , static::TYPE);
        return $stmt->fetchAll();
    }

    function getById(mixed $id): bool|array
    {
        $TABLE = static::TABLE;

        try {
            $stmt = $this->conn->query("SELECT * FROM $TABLE WHERE id=$id");
        } catch (Exception $e) {
            $this->error = $e;
            return false;
        }

        $stmt->setFetchMode(PDO::FETCH_CLASS , static::TYPE);
        return $stmt->fetchAll();
    }
}