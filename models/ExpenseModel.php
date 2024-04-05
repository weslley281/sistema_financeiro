<?php

require_once './config.php';

class ExpenseModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
            die("Erro de conexão: " . $this->conn->connect_error);
        }
    }

    // Método para registrar uma nova despesa
    public function createExpense($amount, $expenseDate, $description, $paymentMethod, $receiptImage) {
        $stmt = $this->conn->prepare("INSERT INTO expenses (amount, expense_date, description, payment_method, receipt_image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("dssss", $amount, $expenseDate, $description, $paymentMethod, $receiptImage);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Método para listar todas as despesas
    public function getAllExpenses() {
        $result = $this->conn->query("SELECT * FROM expenses");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Método para obter detalhes de uma despesa específica pelo ID
    public function getExpenseById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM expenses WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

?>
