<?php

use Bubu\Http\HttpRequire\HttpRequire;
use Bubu\Http\Reponse\Reponse;

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();
HttpRequire::https();
(new Reponse)->setHttpCode(200)->setHttpMessage('Ouiiiiiii')->setup()->send();