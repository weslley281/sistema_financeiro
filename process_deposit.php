<?php
// Inclui o arquivo do controlador
require_once './controllers/DepositController.php';

// Cria uma instância do controlador
$depositController = new DepositController();

// Chama o método de registro do depósito do controlador
$depositController->register();
?>
