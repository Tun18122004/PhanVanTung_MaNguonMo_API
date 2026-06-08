<?php
class CategoryModel
{
    private $conn;
    private $table_name = "category";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // 1. Lấy danh sách danh mục (Read)
    public function getCategories()
    {
        $query = "SELECT id, name, description FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getCategoryById($id)
    {
        $query = "SELECT id, name, description FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu đầu vào
        $id = htmlspecialchars(strip_tags($id));

        // Bind tham số chống SQL Injection
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        // Sử dụng fetch() thay vì fetchAll() vì chỉ lấy 1 dòng dữ liệu
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        return $row; // Trả về object chứa (id, name, description) hoặc false
    }

    // 2. Thêm mới danh mục (Create)
    public function createCategory($name, $description)
    {
        $query = "INSERT INTO " . $this->table_name . " (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu đầu vào (Anti-XSS cơ bản)
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));

        // Bind tham số để chống SQL Injection
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        // Trả về true nếu thực thi thành công, ngược lại false
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 3. Cập nhật danh mục (Update)
    public function updateCategory($id, $name, $description)
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET name = :name, description = :description 
                  WHERE id = :id";
                  
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu đầu vào
        $id = htmlspecialchars(strip_tags($id));
        $name = htmlspecialchars(strip_tags($name));
        $description = htmlspecialchars(strip_tags($description));

        // Bind tham số
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // 4. Xóa danh mục (Delete)
    public function deleteCategory($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Làm sạch dữ liệu đầu vào
        $id = htmlspecialchars(strip_tags($id));

        // Bind tham số
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>