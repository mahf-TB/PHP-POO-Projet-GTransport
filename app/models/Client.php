<?php
namespace App\Models;

use PDO;

class Client extends Model{
   
    protected $table = 'CLIENT';
    protected $id = 'idcli';
    protected $fillable = ['nom', 'numtel'];

    public function searchNom(string $query)
    {
        $pdo = $this->db->getPDO();
        $sql = "SELECT * FROM {$this->table} WHERE nom LIKE '%{$query}%' OR numtel LIKE '%{$query}%' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
}