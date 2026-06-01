<?php
class AccountModel
{
    private $conn;
    private $table_name = "account";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // 1. Lấy thông tin tài khoản theo Username
    public function getAccountByUsername($username)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // 2. Thêm mới tài khoản (Đã sửa lỗi thiếu trường 'name')
    public function save($username, $name, $password, $role = "user")
    {
        $query = "INSERT INTO " . $this->table_name . " (username, name, password, role) 
                  VALUES (:username, :name, :password, :role)";
        
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $username = htmlspecialchars(strip_tags($username));
        $role = htmlspecialchars(strip_tags($role));
        // Lưu ý: Không nên làm sạch password bằng strip_tags nếu nó đã được hash (ví dụ: password_hash)

        // Gán dữ liệu vào câu lệnh
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

        // Thực thi câu lệnh
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 3. Hàm hiệu chỉnh / cập nhật thông tin tài khoản (EDIT)
    public function edit($username, $name, $role)
    {
        // Cập nhật tên và vai trò dựa theo Username (Khóa chính hoặc định danh duy nhất)
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, role = :role 
                  WHERE username = :username";
                  
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $name = htmlspecialchars(strip_tags($name));
        $username = htmlspecialchars(strip_tags($username));
        $role = htmlspecialchars(strip_tags($role));

        // Ràng buộc tham số
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 4. Hàm xóa tài khoản (DELETE)
    public function delete($username)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE username = :username";
        
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu
        $username = htmlspecialchars(strip_tags($username));

        // Ràng buộc tham số
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}