<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <div>
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Tarif pour chaque voiture</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach ($params['dataVoi'] as $row) : ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?= $row->Numero ?></h6>
                                <small class="text-muted"><?= $row->design ?></small>
                            </div>
                            <span class="text-muted"><?= $row->frais ?> MGA</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Réservation d'un Client</h4>

            <form class="needs-validation" action="/projet-transport/reserver_place" method="POST">
                <div class="mb-3">
                    <label for="nom">Nom du client</label>
                    <select class="custom-select w-100 form-select" aria-label="Default select example" style="height: 50px;" id="nom" name="nom" required>
                        <option selected>Selectioner le nom du Passager</option>
                        <?php foreach ($params['datacli'] as $row) : ?>
                            <option value="<?= $row->idcli ?> "><?= $row->nom ?> => (<?= $row->numtel ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <hr class="mt-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <label for="voiture">Voiture</label>
                            <select class="custom-select w-100 form-select" aria-label="Default select example" style="height: 50px;" id="voiture" name="voiture" required>
                                <option selected>Selectionner le voiture</option>
                                <?php foreach ($params['dataVoi'] as $row) : ?>
                                    <option value="<?= $row->idvoit ?> "><?= $row->Numero ?> => (<?= $row->type ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="input-group">
                            <label for="place">Place Libre</label>
                            <select class="custom-select w-100 form-select" aria-label="Default select example" style="height: 50px;" id="place" name="place" required>
                                <option selected>Selectionner le Place parmis dispo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="datevoyage">Date du voyage</label>
                    <input type="date" class="form-control" style="height: 50px;" id="datevoyage" name="datevoyage" placeholder="Entrer votre nom" required>
                </div>
                <hr class="mt-4">
                <h4 class="mb-3">Payment</h4>
                <div class="mb-3">
                    <div class="input-group">
                        <label for="payment">Payment du client</label>
                        <select class="custom-select w-100 form-select" aria-label="Default select example" style="height: 50px;" id="payment" name="payment" required>
                            <option selected>Open this select menu</option>
                            <option value="tout payer">Tout Payé</option>
                            <option value="avec Avance">Avec Avance</option>
                            <option value="sans Avance">Sans Avance </option>
                        </select>
                    </div>
                </div>
                <div class="mb-3" id='montant'>
                    <label for="montant">Montant</label>
                    <input type="text" class="form-control" style="height: 50px;" id="montant" name="montant" placeholder="Entrer le montant" >
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
            xhr.open('GET', 'place_dispo/'+ selectedVoitureId, true);
            xhr.onload = function() {
                if (xhr.status == 200) {
                    var places = JSON.parse(xhr.responseText);
                    placeSelect.innerHTML = '';
                    places.forEach(function(place) {
                        var option = document.createElement('option');
                        option.value = place.place;
                        option.textContent = 'Place Numéro '+ place.place;
                        placeSelect.appendChild(option);
                    });
                }
            }
            xhr.send();
        });
    });
</script>