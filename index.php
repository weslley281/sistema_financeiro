<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    -->
    <link rel="stylesheet" href="./libs/bootstrap/bootstrap.css">
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
                    <a href="index.php?action=listDeposits" class="btn btn-success">Vá aos Depósitos</a>
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
<!--
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../libs/DataTables/datatables.js"></script>
    -->
    <script src="./libs/bootstrap/jquery.js"></script>
    <script src="./libs/bootstrap/popper.js"></script>
    <script src="./libs/bootstrap/bootstrap.js"></script>
</body>
</html>
