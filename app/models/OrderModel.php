<?php
class OrderModel
{
private $conn;
private $table_name = "orders";
public function __construct($db)
{
$this->conn = $db;
}
public function getOrders()
{
$query = "SELECT id, name, phone, phone2,note, address, total, created_at FROM " . $this->table_name;
$stmt = $this->conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
return $result;
}
}
?>