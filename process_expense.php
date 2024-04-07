<?php
// Inclui o arquivo do controlador
require_once './controllers/ExpenseController.php';

// Cria uma instância do controlador
$expenseController = new ExpenseController();

// Chama o método de registro do depósito do controlador
$expenseController->register();
?>
