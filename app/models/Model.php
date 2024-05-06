<?php

namespace App\Models;

use Database\DBConnexion;
use PDO;

abstract class Model
{
    protected $db;
    protected $table;
    protected $id;
    protected $fillable;

    public function __construct()
    {
        $this->db = new DBConnexion(DB_NAME, DB_HOST, DB_USER, DB_PASSWORD);
    }

    public function all(): array
    {
        $pdo = $this->db->getPDO();
        $stmt = $pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById(int $id)
    {
        $pdo = $this->db->getPDO();
        $sql = "SELECT * FROM {$this->table} WHERE {$this->id} = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data)
    {
        $pdo = $this->db->getPDO();
        $column = implode(', ', $this->fillable);
        $value = ':' . implode(',:', $this->fillable);
        $sql = "INSERT INTO {$this->table} ({$column}) VALUES ({$value})";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(int $id, array $data)
    {
        $pdo = $this->db->getPDO();
        foreach ($this->fillable as $colone) {
            $valueColumn[] = "$colone = :$colone";
        }
        $valueColumn = implode(', ', $valueColumn);
        $data['id'] = $id;
        $sql = "UPDATE {$this->table} SET {$valueColumn} WHERE {$this->id} = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete(int $id)
    {
        $pdo = $this->db->getPDO();
        $sql = "DELETE FROM {$this->table} WHERE {$this->id}=?";
        $stmt = $pdo->prepare($sql);
        return  $stmt->execute([$id]);
    }
}
