<?php

use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Anonyme::index');
$routes->get('/anonyme', 'Anonyme::index');
$routes->post('/anonyme/seConnecter', 'Anonyme::seConnecter');
$routes->get('/visiteur', 'Visiteur::index');
$routes->get('/visiteur/mesFiches', 'Visiteur::mesFiches');
$routes->get('/visiteur/    MaFiche/(:num)', 'Visiteur::voirMaFiche/$1'); 
$routes->get('/visiteur/modMaFiche/(:num)', 'Visiteur::modMaFiche/$1'); 
$routes->get('/visiteur/signeMaFiche/(:num)', 'Visiteur::signeMaFiche/$1'); 
$routes->get('/visiteur/seDeconnecter', 'Visiteur::SeDeconnecter');
$routes->post('/visiteur/updateForfait/(:num)', 'Visiteur::updateForfait/$1');
$routes->post('/visiteur/ajouteUneLigneDeFrais/(:num)', 'Visiteur::ajouteUneLigneDeFrais/$1');
$routes->get('/visiteur/deleteUneLigneDeFrais/(:num)/(:num)', 'Visiteur::deleteUneLigneDeFrais/$1/$2');

//route pour comptable
$routes->get('/comptable', 'Comptable::index');
$routes->get('/comptable/seDeconnecter', 'Comptable::SeDeconnecter');
$routes->get('/comptable/lesFiches', 'Comptable::lesFiches');
$routes->get('/comptable/validerMaFiche/(:num)', 'Comptable::validerMaFiche/$1');
$routes->post('/comptable/refuserFiche/(:num)', 'Comptable::refuserFiche/$1');
// $routes->get('/comptable/refuserFiche/(:num)', 'Comptable::refuserFiche/$1');
$routes->get('/comptable/suivieFiches', 'Comptable::suivieFiches');
$routes->get('/comptable/miseEnPaiement/(:num)', 'Comptable::miseEnPaiement/$1');
$routes->get('/comptable/estRembourser/(:num)', 'Comptable::estRembourser/$1');
// ajout de la route directe pour eviter erreur 404
$routes->get('/anonyme/login', 'Anonyme::login');