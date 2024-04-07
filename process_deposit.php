<?php
// Inclui o arquivo do controlador
require_once './controllers/DepositController.php';

// Cria uma instância do controlador
$depositController = new DepositController();

// Chama o método de registro do depósito do controlador

$depositController->register();
displayMessageRedirect("Depósito registrado com sucesso", "index.php?action=listDeposits");

function displayMessageRedirect($message, $destination)
{
    echo "<script language='javascript'>window.alert('$message'); </script>";
    echo "<script language='javascript'>window.location='$destination'; </script>";
    exit;
}
?>
