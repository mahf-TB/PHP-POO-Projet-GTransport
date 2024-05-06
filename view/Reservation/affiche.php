<?php 
$sum = 0;
    foreach ($params['resultat'] as $items ){
            $sum += $items->montant_avance;
    }
?>

<div class="flex pt-5">
    <div class="mx-2 ">
        <h1>Liste des Réservation</h1>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <a href="/projet-transport/reserver_place" class="btn btn-primary mb-2">RESERVER </a>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control search" oninput="searchFunctionRV()" id="query" name="query" style="height: 45px; width:400px; border-radius: 25px;" placeholder="Recherche..." required>
            </div>
        </div>
        <div class="scrollable">
            <table class="table" style="position: relative;">
                <thead>
                    <tr class="text-sm leading-normal bg-secondary text-white" style="position:sticky;">
                        <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Date du réservation
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Date du voyage
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Nom
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Numéro du Voiture
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Place
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Payement
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Montant
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            Reste
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            ACTIONS
                        </th>
                    </tr>
                </thead>

                <tbody id="contenu">
                    <?php foreach ($params['resultat'] as $row) : ?>
                        <tr>
                            <td class="text-center"><?= $row->datereserv ?></td>
                            <td class="text-center"><?= $row->datevoyage ?></td>
                            <td class="text-center"><?= $row->nom ?></td>
                            <!-- <td class="text-center"> <?= $row->numtel ?></td> --> 
                            <td class="text-center"><?= $row->Numero ?></td>
                            <td class="text-center"><?= $row->place_reserver ?></td>
                            <td class="text-center"><?= $row->payement ?></td>
                            <td class="text-center"><?= $row->montant_avance ?></td>
                            <td class="text-center"><?= $row->frais - $row->montant_avance ?></td>
                            <td class="text-right flex">
                                <a href="/projet-transport/modifie_reservation/<?= $row->idreserv ?>" class="btn btn-warning">Modifier</a>
                                <form method="POST" action="delete_reservation/<?= $row->idreserv ?>" style="margin: 0 5px;">
                                    <button type="submit" class="btn btn-danger">Annuler</button>
                                </form>
                                <a href="/projet-transport/recu_pdf/<?= $row->idreserv ?>" class="btn btn-success">Imprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex align-items-center justify-content-between mt-3 text-secondary">
                        <h4>Somme total du montant payé : <span class="text-black"> <?= $sum ?> Ar</span></h4>
        </div>
    </div>
</div>

<style>
    .scrollable {
        max-height: 800px;
        overflow-y: auto;
    }
</style>


<script>
    function searchFunctionRV() {

        var query = document.getElementById('query').value;
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '/projet-transport/searche_Passager', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {

                document.getElementById('contenu').innerHTML = xhr.responseText;
            }
        };
        xhr.send("query=" + query);
    }
</script>