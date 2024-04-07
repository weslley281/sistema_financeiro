<?php

require_once './models/ExpenseModel.php';

class ExpenseController {
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar se todos os campos do formulário foram recebidos
            if (isset($_POST["amount"]) && isset($_POST["expense_date"]) && isset($_POST["description"]) && isset($_POST["payment_method"]) && isset($_FILES["receipt_image"])) {
                $amount = $_POST["amount"];
                $expenseDate = $_POST["expense_date"];
                $description = $_POST["description"];
                $paymentMethod = $_POST["payment_method"];
                
                // Lidar com o upload da imagem do comprovante de depósito
                $directoryUpload = "img/";
                $imageName = uniqid() . $_FILES["receipt_image"]["name"];
                $pathImage = $directoryUpload . $imageName;
                $extentionImage = strtolower(pathinfo($pathImage, PATHINFO_EXTENSION));

                if (!in_array($extentionImage, ["jpg", "jpeg", "gif", "png"])) {
                    echo "<script language='javascript'>window.alert('Tipo de imagem invalida'); </script>";
                    echo "<script language='javascript'>window.location='index.php?action=listDeposits'; </script>";
                    exit();
                }

                if (move_uploaded_file($_FILES["receipt_image"]["tmp_name"], $pathImage)) {
                    if (!$pathImage) {
                        echo "Erro ao fazer upload da imagem do comprovante.";
                        return;
                    }
                    $expenseModel = new ExpenseModel();
                    $result = $expenseModel->createExpense($amount, $expenseDate, $description, $paymentMethod, $pathImage);
                    if ($result) {
                        echo "Despesa registrada com sucesso.";
                    } else {
                        echo "Erro ao registrar a despesa.";
                    }
                }else{
                    echo "Erro ao salvar imagem";
                }
            } else {
                echo "Todos os campos do formulário são obrigatórios.";
            }
        }
    }

    public static function list() {
        $expenseModel = new ExpenseModel();
        $expenses = $expenseModel->getAllExpenses();
        return $expenses;
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
