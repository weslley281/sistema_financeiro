<?php
echo "Também estou aqui<br>";
require_once './config.php';

class DepositModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }
    }

    // Método para registrar um novo depósito
    public function createDeposit($descriptiom, $amount, $depositDate, $managerId, $receiptImage) {
        $stmt = $this->conn->prepare("INSERT INTO deposits (descriptiom, amount, deposit_date, manager_id, receipt_image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $descriptiom, $amount, $depositDate, $managerId, $receiptImage);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Método para listar todos os depósitos
    public function getAllDeposits() {
        $result = $this->conn->query("SELECT * FROM deposits");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Método para obter detalhes de um depósito específico pelo ID
    public function getDepositById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM deposits WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

?>
