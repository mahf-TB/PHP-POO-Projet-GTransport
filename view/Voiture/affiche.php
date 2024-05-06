<div class="d-flex align-items-start justify-content-around pt-5">
    <div class="" style="height: 700px; width:700px ">
        <img src="<?= SCRIPTS . 'images' . DIRECTORY_SEPARATOR . 'Sprinter.jpg' ?>" style="width: 100%; height:100%" alt="" sizes="" srcset="">
    </div>
    <div class="block" style="width: 800px;">
        <a href="/projet-transport/add/voiture" class="btn btn-primary mb-2">AJOUTER</a>
        <table class="table">
            <thead>
                <tr class="text-sm leading-normal bg-secondary text-white">
                    <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                        NUMÉRO
                    </th>
                    <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                        DESIGN
                    </th>
                    <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                        TYPE
                    </th>
                    <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                        PLACE
                    </th>
                    <th class="py-2 px-4 bg-grey-lightest uppercase text-sm text-grey-light border-b border-grey-light text-center">
                        FRAIS
                    </th>
                    <th class="py-2 px-4 bg-grey-lightest  uppercase text-sm text-grey-light border-b border-grey-light text-center">
                        ACTIONS
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($params['result'] as $client) : ?>
                    <tr>
                        <td class="text-center"><?= $client->Numero ?></td>
                        <td class="text-center"><?= $client->design ?></td>
                        <td class="text-center"><?= $client->type ?></td>
                        <td class="text-center"><?= $client->nbplace ?></td>
                        <td class="text-center"><?= $client->frais ?></td>
                        <td class="text-right flex">
                            <a href="/projet-transport/voiture/<?= $client->idvoit ?>" class="btn btn-warning">Modifier</a>
                            <form method="POST" action="voiture/delete/<?= $client->idvoit ?>" style="margin: 0 5px;">
                                <button type="submit" class="btn btn-danger">supprimer</button>
                            </form>
                            <a href="/projet-transport/place_libre/<?= $client->idvoit ?>" class="btn btn-success">Place</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>

</style>