<?php

namespace App\Models;

use PDO;

class Voiture extends Model{
    protected $table = 'VOITURE';
    protected $id = 'idvoit';

    protected $fillable = ['Numero','design', 'type', 'nbplace', 'frais'];


    public function findByNumCar(string $num)
    {
        $pdo = $this->db->getPDO();

        $sql = "SELECT * FROM {$this->table} WHERE  Numero = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$num]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}