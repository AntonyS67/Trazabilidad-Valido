<?php

require_once "models/enlaces.php";
require_once "models/ingreso.php";
require_once "models/usuario.php";
require_once "models/tipotramite.php";
require_once "models/tramite.php";

require_once "controllers/template.php";
require_once "controllers/enlaces.php";
require_once "controllers/ingreso.php";
require_once "controllers/usuario.php";
require_once "controllers/tipotramite.php";
require_once "controllers/tramite.php";

$template = new TemplateController();
$template -> template();