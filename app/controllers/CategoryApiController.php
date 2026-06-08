<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryApiController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // 1. Lấy danh sách danh mục (Read)
    public function index()
    {
        header('Content-Type: application/json');
        $categories = $this->categoryModel->getCategories();
        echo json_encode($categories);
    }

    public function show($id)
    {
        header('Content-Type: application/json');
        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
        echo json_encode($category);
        } else {
        http_response_code(404);
        echo json_encode(['message' => 'Product not found']);
        }
    }

    // 2. Thêm mới danh mục (Create)
    public function store()
    {
        header('Content-Type: application/json');
        
        // Đọc dữ liệu JSON gửi lên từ Client
        $data = json_decode(file_get_contents("php://input"), true);

        // Kiểm tra dữ liệu bắt buộc
        if (!empty($data['name'])) {
            $name = $data['name'];
            $description = isset($data['description']) ? $data['description'] : '';

            // Gọi model để lưu vào database (Bạn cần định nghĩa hàm createCategory trong Model)
            $result = $this->categoryModel->createCategory($name, $description);

            if ($result) {
                http_response_code(201); // Created
                echo json_encode(["message" => "Thêm danh mục thành công."]);
            } else {
                http_response_code(500); // Internal Server Error
                echo json_encode(["message" => "Không thể thêm danh mục."]);
            }
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(["message" => "Dữ liệu không hợp lệ. 'name' là bắt buộc."]);
        }
    }

    // 3. Cập nhật danh mục (Update)
    // Truyền $id của danh mục cần sửa vào hàm
    public function update($id)
    {
        header('Content-Type: application/json');
        
        // Đọc dữ liệu JSON từ client
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$id || empty($data['name'])) {
            http_response_code(400);
            echo json_encode(["message" => "Dữ liệu không đầy đủ (Thiếu ID hoặc Name)."]);
            return;
        }

        $name = $data['name'];
        $description = isset($data['description']) ? $data['description'] : '';

        // Gọi model để cập nhật (Bạn cần định nghĩa hàm updateCategory trong Model)
        $result = $this->categoryModel->updateCategory($id, $name, $description);

        if ($result) {
            http_response_code(200); // OK
            echo json_encode(["message" => "Cập nhật danh mục thành công."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Không thể cập nhật danh mục hoặc không có thay đổi nào."]);
        }
    }

    // 4. Xóa danh mục (Delete)
    // Truyền $id của danh mục cần xóa vào hàm
    public function destroy($id)
    {
        header('Content-Type: application/json');

        if (!$id) {
            http_response_code(400);
            echo json_encode(["message" => "Thiếu ID danh mục cần xóa."]);
            return;
        }

        // Gọi model để xóa (Bạn cần định nghĩa hàm deleteCategory trong Model)
        $result = $this->categoryModel->deleteCategory($id);

        if ($result) {
            http_response_code(200);
            echo json_encode(["message" => "Xóa danh mục thành công."]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Không thể xóa danh mục."]);
        }
    }
}
?>