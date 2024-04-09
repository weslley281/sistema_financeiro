<?php
//echo "Eu estou aqui<br>";
require_once './models/DepositModel.php';

class DepositController {
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar se todos os campos do formulário foram recebidos
            if (isset($_POST["amount"]) && isset($_POST["deposit_date"]) && isset($_POST["manager_id"]) && isset($_FILES["receipt_image"])) {
                $amount = $_POST["amount"];
                $depositDate = $_POST["deposit_date"];
                $managerId = $_POST["manager_id"];
                $descriptiom = $_POST['descriptiom'];
                
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

                    $depositModel = new DepositModel();
                    $result = $depositModel->createDeposit($descriptiom, $amount, $depositDate, $managerId, $pathImage);
                    if ($result) {
                        echo "Depósito registrado com sucesso.";
                    } else {
                        echo "Erro ao registrar o depósito.";
                    }
                }else{
                    echo "Erro ao salvar imagem";
                }
                
            } else {
                echo "Todos os campos do formulário são obrigatórios.";
            }
        } else {
            // Exibir formulário para registrar um novo depósito
            //include '../views/deposit/register.php';
            echo "algo não está certo";
        }
    }

    public static function list() {
        $depositModel = new DepositModel();
        $deposits = $depositModel->getAllDeposits();
        return $deposits;
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
