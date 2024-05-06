<?php

namespace App\Controllers;

use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $client = new Client();
        $res = $client->all();
        return $this->view('client.affiche', compact('res'));
    }

    public function ajouter() 
    {
        if ($_POST['numtel'] ) {
            
        }
        $client = new Client();
        $res = $client->create($_POST);
        if ($res) {
            return header('Location: /projet-transport/client');
        }
    }
    public function gotoAdd()
    {
        return $this->view('client.add');
    }


    public function show(int $id)
    {
        $client = new Client();
        $client = $client->findById($id);

        return $this->view('client.update', compact('client'));
    }
    public function update(int $id)
    {
        $client = new Client();
        $client = $client->update($id, $_POST);
        if ($client) {
            return header('Location: /projet-transport/client');
        }
    }

    public function delete(int $id)
    {
        $client = new Client();
        $client = $client->delete($id);
        if ($client) {
            return header('Location: /projet-transport/client');
        }
    }

    public function searchQuery()
    {
        if (isset($_POST['query'])) {
            $searchQuery = $_POST['query'];
            $client = new Client();
            $res = $client->searchNom($searchQuery);
            if ($res) {

                $html = '';
                foreach ($res as $client) {
                    $html .= '<tr>
                    <td class="text-center">' . $client->idcli . '</td>
                    <td class="text-center">' . $client->nom . '</td>
                    <td class="text-center">' . $client->numtel . '</td>
                    <td class="text-right flex">
                        <a href="/projet-transport/client/' . $client->idcli . '" class="btn btn-warning">Modifier</a>
                        <form method="POST" action="client/delete/' . $client->idcli . '" style="margin-left: 5px;">
                            <button type="submit" class="btn btn-danger">supprimer</button>
                        </form>
                    </td>
                </tr>';
                }
                echo $html;
            } else {
                echo '<td  colspan="4" class="text-center"> Aucun resultat à trouver </td>';
            }
        } else {
            echo '<td  colspan="4" class="text-center"> Aucun resultat à trouver </td>';
        }
    }
}
