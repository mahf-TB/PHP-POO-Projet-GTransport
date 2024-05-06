<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Client;
use App\Models\Place;
use App\Models\Reserver;
use App\Models\Voiture;
use DateTime;
use Dompdf\Dompdf;

class ReservationController extends Controller
{

    public function dashboard()
    {
        return $this->view('Dashboard.dashboard');
    }

    public function affiche()
    {
        $reserver = new Reserver();
        $resultat = $reserver->getReservations();
        return $this->view('Reservation.affiche', compact('resultat'));
    }

    public function reserver()
    {
        $voiture = new Voiture();
        $client = new Client();
        $datacli = $client->all();
        $dataVoi = $voiture->all();
        return $this->view('Reservation.reserver', compact('datacli', 'dataVoi'));
    }
    public function enregister()
    {
        $dataNow = new DateTime();
        $dataNow = $dataNow->format("Y-m-d H:i:s");

        $data = [
            "idcli" => $_POST['nom'],
            "idvoit" => $_POST['voiture'],
            "place_reserver" => $_POST['place'],
            "datereserv" => $dataNow,
            "datevoyage" => $_POST['datevoyage'],
            "payement" => $_POST['payment'],
            "montant_avance" => $_POST['montant'] == "" ? 0 : $_POST['montant'],
        ];

        $dataPlace = [
            "idvoit" => (int)$data['idvoit'],
            "place" => (int)$data['place_reserver'],
            "dispo" => 'occuper',
        ];

        if ($_POST['voiture'] != '' &&  $_POST['place'] != '' && $_POST['nom'] != '' && $_POST['datevoyage'] != '') {
            $place = new Place();
            $resPlace = $place->updateDispo($dataPlace);
            if ($resPlace) {
                $reserve = new Reserver();
                $res = $reserve->create($data);
                if ($res) {
                    return header('Location: /projet-transport/reservation');
                }
            }
        }
    }


    public function showModif(int $id)
    {
        $reserver = new Reserver();
        $dataRes = $reserver->findById($id);

        $idCar = $dataRes['idvoit'];
        $idCli = $dataRes['idcli'];

        //select Client avoir l'idCli dans le reservation 
        $client = new Client();
        $datacli = $client->findById($idCli);

        $place = new Place();
        $dataPlace = $place->getPlaceDispo($idCar);

        //select Voiture avoir l'idCar dans le reservation 
        $voiture = new Voiture();
        $dataVoi = $voiture->findById($idCar);

        return $this->view('Reservation.update', compact('datacli', 'dataVoi', 'dataRes', 'dataPlace'));
    }

    public function updateReservation(int $id)
    {
        $reserver = new Reserver();
        $dataRes = $reserver->findById($id);

        $dataUp = [
            "idvoit" => $dataRes["idvoit"],
            "idcli" => $dataRes["idcli"],
            "place_reserver" => (int)$_POST["place"],
            "datereserv" => $dataRes["datereserv"],
            "datevoyage" => $_POST["datevoyage"],
            "payement" => $_POST["payment"],
            "montant_avance" => $_POST["montant"],
        ];

        $dataOldPlace = [
            "idvoit" => (int)$dataRes['idvoit'],
            "place" => (int)$dataRes['place_reserver'],
            "dispo" => 'libre',
        ];
        $dataNewPlace = [
            "idvoit" => (int)$dataUp['idvoit'],
            "place" => (int)$dataUp['place_reserver'],
            "dispo" => 'occuper',
        ];
        $result = $reserver->update($id, $dataUp);
        if ($result) {
            if ($dataUp['place_reserver'] != $dataRes["place_reserver"]) {
                $place = new Place();
                $resPlace = $place->updateDispo($dataOldPlace);
                $resNewPlace = $place->updateDispo($dataNewPlace);
                if ($resPlace && $resNewPlace) {
                    return header('Location: /projet-transport/reservation');
                }
            }

            return header('Location: /projet-transport/reservation');
        }
    }

    public function delete(int $id)
    {
        $reserver = new Reserver();
        $dataRes = $reserver->findById($id);
        $dataPlace = [
            "idvoit" => (int)$dataRes['idvoit'],
            "place" => (int)$dataRes['place_reserver'],
            "dispo" => 'libre',
        ];
        var_dump($dataPlace);
        $deleteRes = $reserver->delete($id);
        if ($deleteRes) {
            $place = new Place();
            $resPlace = $place->updateDispo($dataPlace);
            if ($resPlace) {
                return header('Location: /projet-transport/reservation');
            }
        }
    }

    public function showPlace(int $id)
    {
        $place = new Place();
        $data = $place->getPlaceDispo($id);

        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function genererPdf(int $id)
    {
         ob_start();
        $reserver = new Reserver();
        $dataRes = $reserver->findById($id);
        $idCli = $dataRes['idcli'];
        $idVoit = $dataRes['idvoit'];
        $client = new Client();
        $voiture = new Voiture();
        $dataVoit = $voiture->findById($idVoit);
        $dataCli = $client->findById($idCli);
       
        $data = compact('dataRes', 'dataCli','dataVoit');
        $this->view('Reservation.recuPdf', $data);

        $html = ob_get_clean();

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $dompdf->stream();
       
    }
    public function removeHeader($html){
        $pattern = '/<nav>.*?<\/nav>/s';
        $html = preg_replace($pattern, '', $html);
        return $html;
    }
    public function searchePassager()
    {
        if (isset($_POST['query'])) {
            $query = $_POST['query'];
            $reserve = new Reserver();
            $data = $reserve->searchPayement($query);

            if ($data) {

                $html = '';
                foreach ($data as $row) {
                    $html .= '
            <tr>
                <td class="text-center">' . $row->datereserv . '</td>
                <td class="text-center">' . $row->datevoyage . '</td>
                <td class="text-center">' . $row->nom . '</td>
                <td class="text-center"> ' . $row->Numero . '</td>
                <td class="text-center">' . $row->place_reserver . '</td>
                <td class="text-center"> ' . $row->payement . '</td>
                <td class="text-center"> ' . $row->montant_avance . '</td>
                <td class="text-center"> ' . $row->frais - $row->montant_avance . '</td>
                <td class="text-right flex">
                    <a href="/projet-transport/clientu/' . $row->idreserv . '" class="btn btn-warning">Modifier</a>
                    <form method="POST" action="vfvdfvdfv/' . $row->idreserv . '" style="margin-: 5px;">
                        <button type="submit" class="btn btn-danger">Annuler</button>
                    </form>
                    <a href="/projet-transport/clientu/' . $row->idreserv . '" class="btn btn-success">Imprimer</a>
                </td>
            </tr> ';
                }
                echo $html;
            } else {
                echo '<td  colspan="9" class="text-center"> Aucun resultat à trouver </td>';
            }
        }
    }
}
