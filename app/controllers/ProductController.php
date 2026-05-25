<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');
require_once('app/models/OrderModel.php');
class ProductController {
private $productModel;
private $db;
public function __construct() {
$this->db = (new Database())->getConnection();
$this->productModel = new ProductModel($this->db);
}
public function index() {
$products = $this->productModel->getProducts();
include 'app/views/products/list.php';
}
public function show($id) {
$product = $this->productModel->getProductById($id);
if ($product) {
include 'app/views/products/show.php';
} else {
echo "Không thấy sản phẩm.";
}
}
public function add() {
$categories = (new CategoryModel($this->db))->getCategories();
include_once 'app/views/products/add.php';
}
public function save() {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? '';
$category_id = $_POST['category_id'] ?? null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$image = $this->uploadImage($_FILES['image']);
} else {
$image = "";
}
$result = $this->productModel->addProduct($name, $description, $price,
$category_id, $image);
if (is_array($result)) {
$errors = $result;
$categories = (new CategoryModel($this->db))->getCategories();
include 'app/views/products/add.php';
} else {
header('Location: /webbanhang/Product');
}
}
}
public function edit($id) {
$product = $this->productModel->getProductById($id);
$categories = (new CategoryModel($this->db))->getCategories();
if ($product) {
include 'app/views/products/edit.php';
} else {
echo "Không thấy sản phẩm.";
}
}
public function update() {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category_id = $_POST['category_id'];
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
$image = $this->uploadImage($_FILES['image']);
} else {
$image = $_POST['existing_image'];
}
$edit = $this->productModel->updateProduct($id, $name, $description,
$price, $category_id, $image);
if ($edit) {
header('Location: /webbanhang/Product');
} else {
echo "Đã xảy ra lỗi khi lưu sản phẩm.";
}
}
}
public function delete($id) {
if ($this->productModel->deleteProduct($id)) {
header('Location: /webbanhang/Product');
} else {
echo "Đã xảy ra lỗi khi xóa sản phẩm.";
}
}
private function uploadImage($file) {
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . basename($file["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$check = getimagesize($file["tmp_name"]);
if ($check === false) {
throw new Exception("File không phải là hình ảnh.");
}
if ($file["size"] > 10 * 1024 * 1024) {
throw new Exception("Hình ảnh có kích thước quá lớn.");
}
if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
throw new Exception("Chỉ cho phép các định dạng JPG, JPEG, PNG và GIF.");
}
if (!move_uploaded_file($file["tmp_name"], $target_file)) {
throw new Exception("Có lỗi xảy ra khi tải lên hình ảnh.");
}
return $target_file;
}


public function addToCart($id) {
$product = $this->productModel->getProductById($id);
if (!$product) {
echo "Không tìm thấy sản phẩm.";
return;
}
if (!isset($_SESSION['cart'])) {
$_SESSION['cart'] = [];
}
if (isset($_SESSION['cart'][$id])) {
$_SESSION['cart'][$id]['quantity']++;
} else {
$_SESSION['cart'][$id] = [
'name' => $product->name,
'price' => $product->price,
'quantity' => 1,
'image' => $product->image
];
}
header('Location: /webbanhang/Product/cart');
}
public function list() {
$products = $this->productModel->getProducts();
require_once 'app/views/products/list.php';
}

public function listOrder() {
$order = (new OrderModel($this->db))->getOrders();
include_once 'app/views/products/order.php';
}


public function cart()
{
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
include 'app/views/products/cart.php';
}
public function checkout()
{
include 'app/views/products/checkout.php';
}
public function processCheckout()
{
    // Đảm bảo session đã được kích hoạt
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Tiếp nhận dữ liệu an toàn từ Form
        $name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
        $phone = htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES, 'UTF-8');
        $phone2 = htmlspecialchars($_POST['phone2'] ?? '', ENT_QUOTES, 'UTF-8');
        $note = htmlspecialchars($_POST['note'] ?? '', ENT_QUOTES, 'UTF-8');
        $address = htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8');
        
        // TUYỆT ĐỐI KHÔNG lấy tổng tiền từ $_POST['total'] để tránh bị hack sửa giá.
        // Hãy lấy từ Session được tính toán ngầm bảo mật mà chúng ta đã làm ở bước trước.
        $total = $_SESSION['checkout_total'] ?? 0;

        // Kiểm tra giỏ hàng hợp lệ
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart']) || $total <= 0) {
            echo "Giỏ hàng trống hoặc số tiền không hợp lệ.";
            return;
        }

        // Bắt đầu giao dịch (Transaction)
        $this->db->beginTransaction();
        try {
            // 1. Lưu thông tin đơn hàng vào bảng orders (Đã bổ sung đủ các cột thiếu)
            $queryOrder = "INSERT INTO orders (name, phone, phone2, note, address, total, created_at) 
                           VALUES (:name, :phone, :phone2, :note, :address, :total, NOW())";
            
            $stmtOrder = $this->db->prepare($queryOrder);
            $stmtOrder->bindParam(':name', $name);
            $stmtOrder->bindParam(':phone', $phone);
            $stmtOrder->bindParam(':phone2', $phone2);
            $stmtOrder->bindParam(':note', $note);
            $stmtOrder->bindParam(':address', $address);
            $stmtOrder->bindParam(':total', $total);
            $stmtOrder->execute();
            
            // Lấy ID đơn hàng vừa tạo
            $order_id = $this->db->lastInsertId();

            // 2. Lưu chi tiết đơn hàng vào bảng order_details
            $cart = $_SESSION['cart'];
            
            // TỐI ƯU: Chuẩn bị (prepare) câu lệnh SQL ngoài vòng lặp để hệ thống chạy nhanh hơn
            $queryDetail = "INSERT INTO order_details (order_id, product_id, quantity, price) 
                            VALUES (:order_id, :product_id, :quantity, :price)";
            $stmtDetail = $this->db->prepare($queryDetail);

            foreach ($cart as $product_id => $item) {
                $itemPrice = (float)$item['price'];
                $itemQty = (int)$item['quantity'];

                $stmtDetail->bindParam(':order_id', $order_id, PDO::PARAM_INT);
                $stmtDetail->bindParam(':product_id', $product_id);
                $stmtDetail->bindParam(':quantity', $itemQty, PDO::PARAM_INT);
                $stmtDetail->bindParam(':price', $itemPrice);
                $stmtDetail->execute();
            }

            // 3. Xóa giỏ hàng và tổng tiền đã thanh toán thành công khỏi Session
            unset($_SESSION['cart']);
            unset($_SESSION['checkout_total']);

            // Xác nhận giao dịch hoàn tất thành công
            $this->db->commit();

            // Chuyển hướng đến trang xác nhận đơn hàng
            header('Location: /webbanhang/Product/orderConfirmation');
            exit; // Luôn dùng exit sau lệnh điều hướng header
            
        } catch (Exception $e) {
            // Hủy bỏ toàn bộ các lệnh Insert bên trên nếu bất kỳ dòng nào bị lỗi
            $this->db->rollBack();
            echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
        }
    }
}
public function orderConfirmation()
{
include 'app/views/products/orderConfirmation.php';
}
}
?>