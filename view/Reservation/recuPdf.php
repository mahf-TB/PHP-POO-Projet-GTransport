<div class=" pdf" >
    <?php
    $dataRes = $params['dataRes'];
    $dataCli = $params['dataCli'];
    $dataVoit = $params['dataVoit'];

    // var_dump($dataCli, $dataVoit);
    // var_dump($params['dataRes']);
    ?>
    <div class="d-flex align-items-center justify-content-center mt-2" >
        <h1>Reçu N° <?= $dataRes['idreserv'] ?></h1>
    </div>
    <div class="text-left p-4">
        <h4 class="mb-3 mt-3">Date du réservation : <?= $dataRes['datereserv'] ?></h4>
        <h4>Date du voyage : <?= $dataRes['datevoyage'] ?></h4>
        <div class="mb-3">
            <h5>Nom du Client : <?= $dataCli['nom'] ?>/ Contact : <?= $dataCli['numtel'] ?> </h5>
        </div>
        <div class="mb-3">
            <h5>Numéro du Voiture : <?= $dataVoit['Numero'] ?> / Type de Voiture : <?= $dataVoit['type'] ?> / Place reserver : <?= $dataRes['place_reserver'] ?></h5>
       </div>
        <div class="mb-2">
            <h5>Frais : <?= $dataVoit['frais'] ?></h5>
        </div>
        <div class="mb-2">
            <h5>Payement : <?= $dataRes['payement'] ?></h5>
        </div>
        <div class="mb-2">
            <h5>Montant Avance : <?= $dataRes['montant_avance'] ?> / Reste :<?= $dataVoit['frais'] - $dataRes['montant_avance'] ?> </h5>
        </div>
    </div>
</div>

<style>
    .pdf {
        background-color: white;
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        width: 100%;
    }
</style>