<?php 
require_once './controllers/ExpenseController.php';
 ?>


<div class="container mt-5">
    <h2 class="mb-4">Lista de Despesas</h2>

    <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addExpenseModal">Adicionar Despesa</a>

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
                        <img src="<?php echo $expense['receipt_image']; ?>" alt="Receipt" style="max-width: 100px;">
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

<!-- Modal -->
<div class="modal fade" id="addExpenseModal" tabindex="-1" role="dialog" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addExpenseModalLabel">Adicionar Depósito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addExpenseForm" method="post" action="process_expense.php" enctype="multipart/form-data">
            <input type="hidden" id="manager_id" name="manager_id" value="1">

          <div class="form-group">
            <label for="descriptiom">Descrição</label>
            <input type="text" class="form-control" id="descriptiom" name="descriptiom" required>
          </div>
          
          <div class="form-group">
            <label for="amount">Quantia</label>
            <input type="text" class="form-control" id="amount" name="amount" required>
          </div>
          
          <div class="form-group">
            <label for="payment_method">Metodo de Pagamento</label>
            <select class="form-control" name="payment_method" id="payment_method">
                <option value="cash">Dinheiro</option>
                <option value="deposit">Depósito</option>
                <option value="credit">Crédito</option>
                <option value="debit">Débito</option>
            </select>
          </div>

          <div class="form-group">
            <label for="expense_date">Data do Depósito</label>
            <input type="date" class="form-control" id="expense_date" name="expense_date" required>
          </div>

          <div class="form-group">
            <label for="receipt_image">Imagem de recibo</label>
            <input type="file" class="form-control" id="receipt_image" name="receipt_image" accept="image/*" required>
          </div>
          <button type="submit" class="btn btn-success">Enviar</button>
        </form>
      </div>
    </div>
  </div>
</div>