<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Deposit List</h2>

    <a href="index.php?action=registerDeposit" class="btn btn-primary mb-4">Add Deposit</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Deposit Date</th>
                <th>Manager ID</th>
                <th>Receipt Image</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($deposits as $deposit): ?>
            <tr>
                <td><?php echo $deposit['id']; ?></td>
                <td><?php echo $deposit['amount']; ?></td>
                <td><?php echo $deposit['deposit_date']; ?></td>
                <td><?php echo $deposit['manager_id']; ?></td>
                <td>
                    <?php if (!empty($deposit['receipt_image'])): ?>
                        <img src="../uploads/<?php echo $deposit['receipt_image']; ?>" alt="Receipt" style="max-width: 100px;">
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
