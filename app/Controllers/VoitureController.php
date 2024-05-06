<?php

namespace App\Controllers;

use App\Models\Place;
use App\Models\Voiture;

class VoitureController extends Controller
{
    public function afficherVoitures()
    {
        $voiture = new Voiture();
        $result = $voiture->all();
        return $this->view('Voiture.affiche', compact('result'));
    }


    public function goToAdd()
    {
        return $this->view('Voiture.add');
    }
    public function ajouter()
    {

        $voiture = new Voiture();
        $cardata = $voiture->create($_POST);
        $car = $voiture->findByNumCar($_POST['Numero']);

        $idVoiture = $car['idvoit'];
        $nbPlace = intval($_POST['nbplace']);
        $value = 1;

        while ($value <= $nbPlace) {
            $dataPlace = array(
                "idvoit" => $idVoiture,
                "place" => $value,
                "occupation" => "libre",
            );
            $value++;
            $place = new Place();
            $res = $place->create($dataPlace);
        }
        if ($cardata && $res) {
            return header('Location: /projet-transport/voiture');
        }
    }

    public function show(int $id)
    {
        $voiture = new Voiture();
        $resVoiture = $voiture->findById($id);
        return $this->view('Voiture.update', compact('resVoiture'));
    }
    public function update(int $id)
    {
        $voiture = new Voiture();
        $oldPlace = $voiture->findById($id);
        $oldPlace = $oldPlace['nbplace'];
        $newPlace = (int)$_POST['nbplace'];
        $voiture_res = $voiture->update($id, $_POST);
        if ($voiture_res) {
            $diff = $newPlace - $oldPlace;
            $place = new Place();
            if ($diff < 0) {
                $data1 = array('idvoit' => $id, 'place' => $newPlace);

                $placeBool = $place->deletePlace($data1);
            } elseif ($diff > 0) {
                $i = 1;
                while ($i <= $diff) {
                    $dataPlace = array(
                        "idvoit" => $id,
                        "place" => $oldPlace + $i,
                        "occupation" => "libre",
                    );
                    $placeBool = $place->create($dataPlace);
                    $i++;
                }
            } else {
                $placeBool = true;
            }
            if ($placeBool) {
                return header('Location: /projet-transport/voiture');
            }
        }
    }

    public function delete(int $id)
    {
        $client = new Voiture();
        $client = $client->delete($id);
        if ($client) {
            return header('Location: /projet-transport/voiture');
        }
    }
    public function placeLibre(int $id)
    {
        $place = new Place();
        $voiture = new Voiture();
        $resVoiture = $voiture->findById($id);
        $dataPlace = $place->getPlaceDispo($id);
        return $this->view('Voiture.placeLibre', compact('dataPlace', 'resVoiture'));
    }
}
