<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private $accountModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    public function index() {
    // Giả sử Model của bạn có hàm bổ sung để lấy tất cả tài khoản
    // $query = "SELECT * FROM account";
    $query = "SELECT username, name, role FROM account WHERE role like 'user'";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    $accounts = $stmt->fetchAll(PDO::FETCH_OBJ);

    // include giao diện này vào
    include_once 'app/views/account/index.php';
}

    function register(){
        include_once 'app/views/account/register.php';
    }

    public function login() {
        include_once 'app/views/account/login.php';
    }

    function save(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $errors =[];

            if(empty($username)){
                $errors['username'] = "Vui long nhap userName!";
            }
            if(empty($fullName)){
                $errors['fullname'] = "Vui long nhap fullName!";
            }
            if(empty($password)){
                $errors['password'] = "Vui long nhap password!";
            }
            if($password != $confirmPassword){
                $errors['confirmPass'] = "Mat khau va xac nhan chua dung";
            }

            //kiểm tra username đã được đăng ký chưa?
            $account = $this->accountModel->getAccountByUsername($username);
            if($account){
                $errors['account'] = "Tai khoan nay da co nguoi dang ky!";
            }

            if(count($errors) > 0){
                include_once 'app/views/account/register.php';
            }else{
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $password);
                if($result){
                    header('Location: /webbanhang/account/login');
                }
            }
        }
    }

    function logout(){
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /webbanhang/product');
    }

    public function checkLogin(){
        // Kiểm tra xem liệu form đã được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $account = $this->accountModel->getAccountByUserName($username);

            if ($account) {
                $pwd_hashed = $account->password;
                //check mat khau
                if (password_verify($password, $pwd_hashed)) {
                    session_start();
                    // $_SESSION['user_id'] = $account->id;
                    $_SESSION['user_role'] = $account->role;
                    $_SESSION['username'] = $account->username;
                    header('Location: /webbanhang/product');
                    exit;
                }
                else {
                    echo "<script>
                    alert('Mật khẩu không chính xác. Vui lòng kiểm tra lại mật khẩu!');
                    window.location.href = '/webbanhang/account/login'; // Chuyển hướng người dùng quay lại trang đăng nhập
                </script>";
                exit();
                }
            } else {
                echo "<script>
                    alert('Tài khoản này không tồn tại trong hệ thống. Vui lòng kiểm tra lại!');
                    window.location.href = '/webbanhang/account/login'; // Chuyển hướng người dùng quay lại trang đăng nhập
                </script>";
                exit();
            }
        }
    }

    // ==========================================
    // ĐOẠN THÊM MỚI: PHẦN SỬA VÀ XÓA TÀI KHOẢN
    // ==========================================

    // 1. Hiển thị form chỉnh sửa tài khoản dựa vào username trên URL
    public function edit($username) {
        // Lấy thông tin tài khoản hiện tại từ DB để đổ vào form
        $account = $this->accountModel->getAccountByUsername($username);
        
        if ($account) {
            include_once 'app/views/account/edit.php';
        } else {
            echo "Không tìm thấy tài khoản cần sửa!";
        }
    }

    // 2. Xử lý cập nhật thông tin khi submit form sửa (POST)
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $role = $_POST['role'] ?? 'admin';
            $errors = [];

            if (empty($fullName)) {
                $errors['fullname'] = "Vui lòng nhập tên hiển thị!";
            }

            if (count($errors) > 0) {
                // Nếu có lỗi, lấy lại dữ liệu cũ và ép quay lại trang edit kèm lỗi
                $account = $this->accountModel->getAccountByUsername($username);
                include_once 'app/views/account/edit.php';
            } else {
                // Gọi hàm edit từ Model để thực thi câu lệnh UPDATE
                $result = $this->accountModel->edit($username, $fullName, $role);
                if ($result) {
                    // Sửa thành công chuyển hướng về danh sách hoặc trang sản phẩm tùy bạn
                    header('Location: /webbanhang/product');
                    exit;
                } else {
                    echo "Có lỗi xảy ra khi cập nhật tài khoản!";
                }
            }
        }
    }

    // 3. Xử lý xóa tài khoản
    public function delete($username) {
        // Gọi hàm delete từ Model để thực thi câu lệnh DELETE
        $result = $this->accountModel->delete($username);
        if ($result) {
            // Sau khi xóa, chuyển hướng về trang danh sách sản phẩm hoặc trang quản lý
            header('Location: /webbanhang/product');
            exit;
        } else {
            echo "Có lỗi xảy ra khi xóa tài khoản!";
        }
    }
}