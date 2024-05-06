<?php
namespace App\Models;

use PDO;

class Place extends Model{
   
    protected $table = 'PLACE';
    protected $id = 'idplace';
    protected $fillable = ['idvoit', 'place', 'occupation'];
    
    public function getPlaceDispo(int $id){
        $pdo = $this->db->getPDO();
        $sql = "SELECT * FROM place WHERE idvoit = ? and occupation = 'libre' ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateDispo(array $data)
    {
        $pdo = $this->db->getPDO();
        $sql = "UPDATE {$this->table} SET occupation = :dispo WHERE place = :place AND idvoit = :idvoit";
        $stmt = $pdo->prepare($sql);
        return  $stmt->execute($data);
    }

    public function deletePlace(array $data)
    {
        $pdo = $this->db->getPDO();
        $sql = "DELETE FROM {$this->table} WHERE idvoit = :idvoit AND place > :place";
        $stmt = $pdo->prepare($sql);
        return  $stmt->execute($data);
    }
}