<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Depositos</h5>
                    <p class="card-text">Gerencie os seus Depósitos</p>
                    <a href="index.php?action=listDeposits" class="btn btn-success">Vá ao Depósitos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gastos</h5>
                    <p class="card-text">Gerencie os seus Gastos</p>
                    <a href="index.php?action=listExpenses" class="btn btn-danger">Vá ao Gastos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Perfil</h5>
                    <p class="card-text">Veja e edite o seu perfil</p>
                    <a href="profile.php" class="btn btn-warning">Vá ao Perfil</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    <?php
        if (isset($_GET["action"]) && $_GET["action"]  == "listDeposits" ){
            include_once('views/Deposit.php');
        }
        if (isset($_GET["action"]) && $_GET["action"]  == "listExpenses" ){
            include_once('views/Expense.php');
        }
    ?>

    </div>
</div>


</body>
</html>
