<!DOCTYPE html>
<html lang="en">
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
                    <h5 class="card-title">Deposits</h5>
                    <p class="card-text">Manage deposits</p>
                    <a href="index.php?action=listDeposits" class="btn btn-primary">Go to Deposits</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Expenses</h5>
                    <p class="card-text">Manage expenses</p>
                    <a href="index.php?action=listExpenses" class="btn btn-primary">Go to Expenses</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Profile</h5>
                    <p class="card-text">View and edit your profile</p>
                    <a href="profile.php" class="btn btn-primary">Go to Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
