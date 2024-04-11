<?php 
require_once './controllers/DepositController.php';

 ?>

<div class="container mt-5">
    <h2 class="mb-4">Lista de Depósitos</h2>

    <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addDepositModal">Adicionar Depósito</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Data do Depósito</th>
                <th>Receipt Image</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $deposits = DepositController::list();
            if (isset($deposits) && !empty($deposits)) {
                foreach ($deposits as $deposit){
                ?>
                <tr>
                    <td><?php echo $deposit['id_deposit']; ?></td>
                    <td><?php echo $deposit['descriptiom']; ?></td>
                    <td><?php echo $deposit['amount']; ?></td>
                    <td><?php echo $deposit['deposit_date']; ?></td>
                    <td>
                        <?php if (!empty($deposit['receipt_image'])): ?>
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

<!-- Modal -->
<div class="modal fade" id="addDepositModal" tabindex="-1" role="dialog" aria-labelledby="addDepositModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDepositModalLabel">Adicionar Depósito</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addDepositForm" method="post" action="process_deposit.php" enctype="multipart/form-data">
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
            <label for="deposit_date">Data do Depósito</label>
            <input type="date" class="form-control" id="deposit_date" name="deposit_date" required>
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

<script>
    $(document).ready(function() {
        // Intercepta o envio do formulário
        $('#addDepositForm').submit(function(e) {
            // Previne o comportamento padrão do formulário (recarregar a página)
            e.preventDefault();

            // Serializa os dados do formulário
            var formData = $(this).serialize();

            // Envia os dados via AJAX
            $.ajax({
                type: 'POST',
                url: 'process_deposit.php',
                data: formData,
                success: function(response) {
                    // Manipula a resposta do servidor
                    console.log(response);
                    // Aqui você pode adicionar lógica para exibir uma mensagem de sucesso, recarregar a lista de depósitos, etc.
                },
                error: function(xhr, status, error) {
                    // Manipula erros de requisição AJAX
                    console.error(error);
                    // Aqui você pode adicionar lógica para exibir uma mensagem de erro ao usuário
                }
            });
        });
    });
</script>
