<?php

require_once '../models/ExpenseModel.php';

class ExpenseController {
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar se todos os campos do formulário foram recebidos
            if (isset($_POST["amount"]) && isset($_POST["expense_date"]) && isset($_POST["description"]) && isset($_POST["payment_method"]) && isset($_FILES["receipt_image"])) {
                $amount = $_POST["amount"];
                $expenseDate = $_POST["expense_date"];
                $description = $_POST["description"];
                $paymentMethod = $_POST["payment_method"];
                
                // Lidar com o upload da imagem do comprovante de despesa
                $receiptImage = $this->uploadReceiptImage($_FILES["receipt_image"]);
                if (!$receiptImage) {
                    echo "Erro ao fazer upload da imagem do comprovante.";
                    return;
                }

                $expenseModel = new ExpenseModel();
                $result = $expenseModel->createExpense($amount, $expenseDate, $description, $paymentMethod, $receiptImage);
                if ($result) {
                    echo "Despesa registrada com sucesso.";
                } else {
                    echo "Erro ao registrar a despesa.";
                }
            } else {
                echo "Todos os campos do formulário são obrigatórios.";
            }
        } else {
            // Exibir formulário para registrar uma nova despesa
            include '../views/expense/register.php';
        }
    }

    public function list() {
        $expenseModel = new ExpenseModel();
        $expenses = $expenseModel->getAllExpenses();
        include '../views/expense/list.php';
    }

    // Método para lidar com o upload da imagem do comprovante de despesa
    private function uploadReceiptImage($image) {
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($image["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        
        // Verificar se o arquivo de imagem é real ou falso
        $check = getimagesize($image["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Verificar se o arquivo já existe
        if (file_exists($targetFile)) {
            $uploadOk = 0;
        }

        // Verificar o tamanho máximo do arquivo
        if ($image["size"] > 500000) {
            $uploadOk = 0;
        }

        // Permitir apenas determinados formatos de arquivo
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
        }

        // Se tudo estiver correto, tentar fazer upload do arquivo
        if ($uploadOk == 1) {
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                return basename($image["name"]);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>
