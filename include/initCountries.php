<?php
require_once __DIR__ . '/errorHandler.proc.php';
require_once __DIR__ . '/../apiClient/countriesApi.php';
require_once __DIR__ . '/../controller/countriesController.php';

$countriesApi = new countriesApi();
$controller = new countriesController($countriesApi);

?>