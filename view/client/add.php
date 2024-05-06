<h1 class="text-center mt-5">AJOUTER UNE NOUVELLE CLIENT</h1>
<div class="d-flex align-items-center justify-content-center">
    <form class="needs-validation w-50" action="/projet-transport/ajouter/client" method="POST">
        <div class="mb-3">
            <label for="nom">Nom du client</label>
            <input type="text" class="form-control" style="height: 50px;"
            id="nom" name="nom" placeholder="Entrer le nom du client">
            <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
            </div>
        </div>
        <div class="mb-3">
            <label for="numtel">Numéro de telephone</label>
            <div class="input-group" >
                <input type="text" class="form-control"  style="height: 50px;"
                id="numtel" name="numtel" value="+261" pattern="^\+261(33|34|32|38)\d{7}$" placeholder="Entrer le numéro de telephone" maxlength="13" minlength="13" required>
                <div class="invalid-feedback">
                    Your username is required.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a class="btn btn-danger btn-lg btn-block w-100" href="/projet-transport/client">Annuler</a>
            </div>
            <div class="col-md-6 mb-3">
                <button class="btn btn-success btn-lg btn-block w-100" type="submit">Enregistrer</button>
            </div>
        </div>
    </form>
</div>