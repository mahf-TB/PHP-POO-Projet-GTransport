<?php
use Router\Router;

$router = new Router($_GET['url']);

/// route pour les table Reservation et ses crud 
$router->get('/', 'App\Controllers\ReservationController@dashboard');

$router->get('/reservation', 'App\Controllers\ReservationController@affiche');

//modifier reservation
$router->get('/modifie_reservation/:id', 'App\Controllers\ReservationController@showModif');
$router->post('/modifie_reservation/:id', 'App\Controllers\ReservationController@updateReservation');

//supprimer reservation
$router->post('/delete_reservation/:id', 'App\Controllers\ReservationController@delete');

//ajouter reservation
$router->get('/reserver_place', 'App\Controllers\ReservationController@reserver');
$router->post('/reserver_place', 'App\Controllers\ReservationController@enregister');

$router->get('/place_dispo/:id', 'App\Controllers\ReservationController@showPlace');
//generer pdp dans le reservation 
$router->get('/recu_pdf/:id', 'App\Controllers\ReservationController@genererPdf');
//recherche passager
$router->post('/searche_Passager', 'App\Controllers\ReservationController@searchePassager');


/// route pour les table Cleint et ses crud 
$router->get('/client', 'App\Controllers\ClientController@index');

$router->get('/client/:id', 'App\Controllers\ClientController@show');
$router->post('/client/:id', 'App\Controllers\ClientController@update');

$router->get('/ajouter/client', 'App\Controllers\ClientController@gotoAdd');
$router->post('/ajouter/client', 'App\Controllers\ClientController@ajouter');

$router->post('/client/delete/:id', 'App\Controllers\ClientController@delete');

//search for nom et contact 
$router->post('/search', 'App\Controllers\ClientController@searchQuery');


/// route pour les table voiture  et ses crud
$router->get('/voiture', 'App\Controllers\VoitureController@afficherVoitures');

$router->get('/add/voiture', 'App\Controllers\VoitureController@goToAdd');
$router->post('/add/voiture', 'App\Controllers\VoitureController@ajouter');

$router->get('/voiture/:id', 'App\Controllers\VoitureController@show');
$router->post('/voiture/:id', 'App\Controllers\VoitureController@update');

$router->get('/place_libre/:id', 'App\Controllers\VoitureController@placeLibre');

$router->post('/voiture/delete/:id', 'App\Controllers\VoitureController@delete');


$router->run();
