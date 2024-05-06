<div class="d-flex align-items-start justify-content-around pt-5">
    <div class="" style="height: 700px; width:700px ">
        <img src="<?= SCRIPTS . 'images' . DIRECTORY_SEPARATOR . 'Sprinter.jpg' ?>" style="width: 100%; height:100%" alt="" sizes="" srcset="">
    </div>
    <div class="block" style="width: 500px;">
        <?php
        $voiture = $params['resVoiture'];
        $dataPlace = $params['dataPlace'];
        
        function placeVoiture($pl){
            if ($pl >= 9) {
               echo 'four-columns';
            }else if($pl <=5){
                echo 'two-columns ';
            }
        }
        function mergeChauffeur($pl)  {
            if($pl > 5){
                echo 'merge';
            }
        }

        // var_dump($dataPlace);

        function placeLibre(array $dataPl, int $nb){
            foreach($dataPl as $pl){
                if($nb == $pl->place){
                    echo 'item-color';
                
                }    
            }
           
        }

               
        ?>

        <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
                <h6 class="my-0"><?= $voiture['Numero'] ?></h6>
                <small class="text-muted"><?= $voiture['design'] ?></small>
            </div>
            <span class="text-muted">Frais = <?= $voiture['frais'] ?> MGA</span>
        </li>
        <div class="voiture <?php placeVoiture($voiture['nbplace']) ?>">
            <div class="items <?php mergeChauffeur($voiture['nbplace'])?>">Chauffeur</div>
            <?php $nb = 1;
            while ($nb <= $voiture['nbplace']) { ?>
                <div class="items <?php placeLibre($dataPlace, $nb) ?> "><?= $nb ?></div>
            <?php $nb++; }; ?>
        </div>
        <div class="itcolor">Place libre </div>
        <div class="itcolor gg">Place prise </div>
    </div>
</div>

<style>
    .voiture {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        border: 1px solid #000;
        padding: 5px;
        margin-top: 20px;
        border-radius: 5px;
    }

    .three-columns {
        grid-template-columns: repeat(3, 1fr);
    }
    .two-columns {
        grid-template-columns: repeat(2, 1fr);
    }
    .four-columns {
        grid-template-columns: repeat(4, 1fr);
    }

    .items {
        background-color: #e4e4e4;
        padding: 5px;
        text-align: center;
    }
    .item-color{
        background-color: #64a19d;
       
    }
    .itcolor{
        width: 200px;
        font-size: 12px;
        margin-top: 15px;
        background-color: #64a19d;
        text-align: center;
        padding: 3px;
    }
    .gg{
        background-color: #e4e4e4;
    }
    .items h4 {
        font-size: 16px;
    }

    .merge {
        grid-column: 1/span 2;
    }
</style>