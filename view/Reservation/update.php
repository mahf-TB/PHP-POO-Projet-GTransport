<div class="container mt-4">
    <?php
    $place = $params['dataPlace'];
    $dataRes = $params['dataRes'];
    $idCli = (int)$dataRes['idcli'];
    $idVoit = (int)$dataRes['idvoit'];
    $payement = $dataRes['payement'];

    function Selected($rowId, $rowID)
    {
        if ($rowId == $rowID) {
            return 'selected';
        }
    }

    ?>
    <div class="d-flex align-items-center justify-content-center">
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Modification Réservation</h4>
            <form class="needs-validation" action="/projet-transport/modifie_reservation/<?= $dataRes['idreserv'] ?>" method="POST">
                <div class="mb-3" id='montant'>
                    <label for="nom">Nom du client</label>
                    <input type="text" class="form-control" readonly value="<?= $params['datacli']['nom'] ?>" style="height: 50px;" id="nom" name="nom" placeholder="Entrer le montant">
                </div>
                <hr class="mt-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <label for="voiture">Voiture</label>
                            <input type="text" class="custom-select w-100 form-control" readonly value="<?= $params['dataVoi']['Numero'] ?>" style="height: 50px;" id="voiture" name="voiture" placeholder="Entrer le montant">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <label for="place">Place Libre</label>
                            <select class="custom-select w-100 form-select" aria-label="Default select example" style="height: 50px;" id="place" name="place" required>
                                <option selected value="<?= $dataRes['place_reserver']?>" >Place Numéro <?= $dataRes['place_reserver'] ?></option>
                                <?php foreach ($place as $row) : ?>
                                    <option value="<?= $row->place ?> ">Place Numéro <?= $row->place ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="datevoyage">Date du voyage</label>
                    <input type="date" class="form-control" value="<?= $dataRes['datevoyage'] ?>" style="height: 50px;" id="datevoyage" name="datevoyage" placeholder="Entrer votre nom" required>
                </div>
                <hr class="mt-4">
                <h4 class="mb-3">Payment</h4>
                <div class="mb-3">
                    <div class="input-group">
                        <label for="payment">Payment du client</label>
                        <select class="custom-select w-100 form-select" aria-label="Default select example" style="height: 50px;" id="payment" name="payment" required>
                            <option selected>Open this select menu</option>
                            <option <?php echo Selected($payement, 'tout payer') ?> value="tout payer">Tout Payé</option>
                            <option <?php echo Selected($payement, 'avec Avance') ?> value="avec Avance">Avec Avance</option>
                            <option <?php echo Selected($payement, 'sans Avance') ?> value="sans Avance">Sans Avance </option>
                        </select>
                    </div>
                </div>
                <div class="mb-3" id='montant'>
                    <label for="montant">Montant</label>
                    <input type="text" class="form-control" value="<?= $dataRes['montant_avance'] ?>" style="height: 50px;" id="montant" name="montant" placeholder="Entrer le montant">
                </div>
                <hr class="mb-4">
                <div class="mb-3 d-flex align-content-end  text-center">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Enregistrer</button>
                    <a href="/projet-transport/reservation" class="btn btn-danger btn-lg btn-block" style="margin-left: 8px;">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        var placeSelect = document.getElementById('place');
        var voitureSelect = document.getElementById('voiture');

        voitureSelect.addEventListener('change', function() {
            let selectedVoitureId = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'place_dispo/' + selectedVoitureId, true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    var places = JSON.parse(xhr.responseText);
                    placeSelect.innerHTML = '';
                    places.forEach(function(place) {
                        var option = document.createElement('option');
                        option.value = place.place;
                        option.textContent = 'Place Numéro ' + place.place;
                        placeSelect.appendChild(option);
                    });
                }
            }
            xhr.send();
        });
    });
</script>