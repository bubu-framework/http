<?php

use Bubu\Http\Reponse\Reponse;
use Bubu\Http\Session\Session;

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->load();

(new Reponse)->setHttpCode(999)->setHttpMessage('Ouiiiiiii')->setup()->send();