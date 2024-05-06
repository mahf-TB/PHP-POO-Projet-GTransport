<?php

namespace App\Models;

use PDO;

class Reserver extends Model
{

    protected $table = 'RESERVER';
    protected $id = 'idreserv';
    protected $fillable = ['idvoit', 'idcli', 'place_reserver', 'datereserv', 'datevoyage', 'payement', 'montant_avance'];


    public function getReservations()
    {
        $pdo = $this->db->getPDO();
        $stmt = $pdo->query("
        SELECT DISTINCT CLI.* , VOI.*, RS.* FROM reserver RS 
        INNER JOIN client CLI ON CLI.idcli = RS.idcli 
        INNER JOIN voiture VOI ON VOI.idvoit = RS.idvoit
        INNER JOIN place PL ON PL.idvoit = VOI.idvoit 
        WHERE PL.occupation = 'occuper'
        ");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function searchPayement(string $search)
    {
        $pdo = $this->db->getPDO();
        $sql = "
        SELECT DISTINCT CLI.* , VOI.*, RS.* FROM reserver RS 
        INNER JOIN client CLI ON CLI.idcli = RS.idcli 
        INNER JOIN voiture VOI ON VOI.idvoit = RS.idvoit
        INNER JOIN place PL ON PL.idvoit = VOI.idvoit 
        WHERE PL.occupation = 'occuper' AND ( payement LIKE '%{$search}%' OR CLI.nom LIKE '%{$search}%' );
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
