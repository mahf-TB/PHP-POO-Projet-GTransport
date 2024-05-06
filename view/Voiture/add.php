<h1 class="text-center mt-5">AJOUTER UN NOUVEAU CAR</h1>
<div class="d-flex align-items-center justify-content-center">
    <form class="needs-validation w-50" action="/projet-transport/add/voiture" method="POST">
        <div class="mb-3">
            <label for="Numero">Numéro du Voiture </label>
            <input type="text" class="form-control" style="height: 50px;" id="Numero" name="Numero" placeholder="Entrer le numéro du voiture" required>
        </div>
        <div class="mb-3">
            <label for="design">Désignation </label>
            <input type="text" class="form-control" style="height: 50px;" id="design" name="design" placeholder="Désignation du voiture (sprinter rouge, ...)" required>
        </div>
        <div class="mb-3">
            <div class="input-group">
                <label for="type">Type de voiture</label>
                <select class="custom-select w-100 form-select" aria-label="Default select example" style="height: 50px;" id="type" name="type" required>
                    <option selected>Open this select menu</option>
                    <option value="simple">SIMPLE</option>
                    <option value="premium">PREMIUM</option>
                    <option value="VIP">VIP </option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="nbplace">Nombre de place</label>
            <div class="input-group">
                <input type="number" class="form-control" style="height: 50px;" id="nbplace" name="nbplace" placeholder="Entrer le nombre de place" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="frais">Frais</label>
            <div class="input-group">
                <input type="text" class="form-control" style="height: 50px;" id="frais" name="frais" placeholder="Entrer le frais" required>
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