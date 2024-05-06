<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TsaraDia Coopérative</title>
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">
    <link rel="stylesheet" href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'dashj.css' ?>">

</head>

<body>
    <nav class="navbar navbar-expand-xl navbar-dark bg-secondary">
        <div class="flex">
            <div class="row align-items-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample06" aria-controls="navbarsExample06" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="col collapse navbar-collapse" id="navbarsExample06">
                    <ul class="navbar-nav mr-auto flex">
                        <li class="nav-item text-white">
                            <a class="nav-link" href="/projet-transport/">HOME</a>
                        </li>
                        <li class="nav-item text-white">
                            <a class="nav-link" href="/projet-transport/reservation">RESERVATION</a>
                        </li>
                        <li class="nav-item text-white">
                            <a class="nav-link" href="/projet-transport/client">PASSAGER</a>
                        </li>
                        <li class="nav-item text-white">
                            <a class="nav-link " href="/projet-transport/voiture">VOITURE</a>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </nav>
    <div class="">
        <?= $content; ?>
    </div>

    <script src="<?= SCRIPTS . 'js' . DIRECTORY_SEPARATOR . 'bootstrap.bundle.min.css' ?>"></script>
</body>

</html>