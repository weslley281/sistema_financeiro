<?php
echo "Eu estou aqui<br>";
require_once './models/DepositModel.php';

class DepositController {
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar se todos os campos do formulário foram recebidos
            if (isset($_POST["amount"]) && isset($_POST["deposit_date"]) && isset($_POST["manager_id"]) && isset($_FILES["receipt_image"])) {
                $amount = $_POST["amount"];
                $depositDate = $_POST["deposit_date"];
                $managerId = $_POST["manager_id"];
                
                // Lidar com o upload da imagem do comprovante de depósito
                $receiptImage = $this->uploadReceiptImage($_FILES["receipt_image"]);
                if (!$receiptImage) {
                    echo "Erro ao fazer upload da imagem do comprovante.";
                    return;
                }

                $depositModel = new DepositModel();
                $result = $depositModel->createDeposit($amount, $depositDate, $managerId, $receiptImage);
                if ($result) {
                    echo "Depósito registrado com sucesso.";
                } else {
                    echo "Erro ao registrar o depósito.";
                }
            } else {
                echo "Todos os campos do formulário são obrigatórios.";
            }
        } else {
            // Exibir formulário para registrar um novo depósito
            include '../views/deposit/register.php';
        }
    }

    public function list() {
        $depositModel = new DepositModel();
        $deposits = $depositModel->getAllDeposits();
        include '../views/deposit/list.php';
    }

    // Método para lidar com o upload da imagem do comprovante de depósito
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
