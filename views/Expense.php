<?php 
require_once './controllers/ExpenseController.php';
 ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Despesas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Lista de Despesas</h2>

    <a href="index.php?action=registerExpense" class="btn btn-primary mb-4">Add Expense</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Quantia</th>
                <th>Data</th>
                <th>Descrição</th>
                <th>Manager ID</th>
                <th>Imagem do recibo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $expenses = ExpenseController::list();
            if (isset($expenses) && !empty($expenses)) {
                foreach ($expenses as $expense){
            ?>
            <tr>
                <td><?php echo $expense['id_expense']; ?></td>
                <td><?php echo $expense['amount']; ?></td>
                <td><?php echo $expense['expense_date']; ?></td>
                <td><?php echo $expense['description']; ?></td>
                <td><?php echo $expense['manager_id']; ?></td>
                <td>
                    <?php if (!empty($expense['receipt_image'])): ?>
                        <img src="<?php echo $deposit['receipt_image']; ?>" alt="Receipt" style="max-width: 100px;">
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
            </tr>
            <?php
                }
            }else {
                // Se não houver depósitos disponíveis, exibir uma mensagem alternativa
                echo "<tr><td colspan='5'>Nenhum depósito encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
