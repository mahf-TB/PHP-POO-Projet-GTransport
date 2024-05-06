<div class="d-flex align-items-start justify-content-around pt-5">
    <div class="" style="height: 700px; width:700px ">
        <img src="<?= SCRIPTS . 'images' . DIRECTORY_SEPARATOR . 'globe.jpg' ?>" style="width: 100%;" alt="" sizes="" srcset="">
    </div>
    <div class="block" style="width: 700px;">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <a href="/projet-transport/ajouter/client" class="btn btn-primary mb-2">Nouveaux Client </a>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control search" oninput="searchFunction()" id="query" name="query" placeholder="Recherche..." style="height: 45px; width:300px; border-radius: 25px;" required>
            </div>
        </div>
        <div >

            <table class="table">
                <thead>
                    <tr class="text-sm leading-normal bg-secondary text-white">
                        <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            ID
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            NOM
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            TELEPHONE
                        </th>
                        <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                            ACTIONS
                        </th>
                    </tr>
                </thead>
                <tbody id="contenu">
                    <?php foreach ($params['res'] as $client) : ?>
                        <tr>
                            <td class="text-center"><?= $client->idcli ?></td>
                            <td class="text-center"><?= $client->nom ?></td>
                            <td class="text-center"><?= $client->numtel ?></td>
                            <td class="text-right flex">
                                <a href="/projet-transport/client/<?= $client->idcli ?>" class="btn btn-warning">Modifier</a>
                                <form method="POST" action="client/delete/<?= $client->idcli ?>" style="margin-left: 5px;">
                                    <button type="submit" class="btn btn-danger">supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
    function searchFunction() {

        var query = document.getElementById('query').value;
        console.log(query);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", '/projet-transport/search', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                document.getElementById('contenu').innerHTML = xhr.responseText;
            }
        };
        xhr.send("query=" + query);
    }
</script>