
<?php 
$data = $params['resVoiture']; 
function getValueType($type, $donne){
    if ($type == $donne) {
        echo 'selected';
    }
}

?>

<h1 class="text-center mt-5">MODIFIER LA VOITURE</h1>
<div class="d-flex align-items-center justify-content-center">
    <form class="needs-validation w-50" action="/projet-transport/voiture/<?=  $data['idvoit'] ?>" method="POST">
    <div class="mb-3">
            <label for="Numero">Numéro du Voiture </label>
            <input type="text" class="form-control" style="height: 50px;" id="Numero" name="Numero" value="<?= $data['Numero'] ?>" 
            placeholder="Entrer le numéro du voiture">
        </div>
    <div class="mb-3">
            <label for="design">Désignation </label>
            <input type="text" class="form-control" style="height: 50px;" id="design" name="design" value="<?= $data['design'] ?>" 
            placeholder="Désignation du voiture (sprinter rouge, ...)">
        </div>
        <div class="mb-3">
            <div class="input-group">
                <label for="type">Type de voiture</label>
                <select class="custom-select w-100 form-select" aria-label="Default select example" style="height: 50px;" id="type" name="type" required>
                    <option <?=  $data['type']=='simple'?'selected':''; ?> value="simple">SIMPLE</option>
                    <option  <?= $data['type']=='premium'? 'selected':''; ?> value="premium">PREMIUM</option>
                    <option  <?= $data['type']=='VIP'? 'selected':''; ?> value="VIP">VIP </option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="nbplace">Nombre de place</label>
            <div class="input-group">
                <input type="number" class="form-control" style="height: 50px;" id="nbplace" name="nbplace" value="<?= $data['nbplace'] ?>" 
                placeholder="Entrer le nombre de place" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="frais">Frais</label>
            <div class="input-group">
                <input type="text" class="form-control" style="height: 50px;" id="frais" name="frais" value="<?= $data['frais'] ?>" 
                 placeholder="Entrer le frais" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a class="btn btn-danger btn-lg btn-block w-100" href="/projet-transport/voiture">Annuler</a>
            </div>
            <div class="col-md-6 mb-3">
                <button class="btn btn-success btn-lg btn-block w-100" type="submit">Enregistrer</button>
            </div>
        </div>
    </form>
</div>