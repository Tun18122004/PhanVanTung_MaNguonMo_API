<?php
// Require SessionHelper and other necessary files
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // 1. Hiển thị danh sách danh mục
    // URL: /webbanhang/category hoặc /webbanhang/category/index
    public function index()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/categories/list.php';
    }

    // 2. Hiển thị form Thêm danh mục mới
    // URL: /webbanhang/category/add
    public function add()
    {
        include 'app/views/categories/add.php';
    }

    // 3. Hiển thị form Sửa danh mục (Nhận ID từ router, ví dụ: /category/edit/5)
    // URL: /webbanhang/category/edit/{id}
    public function edit($id)
    {
        if (!$id) {
            header('Location: /webbanhang/category');
            exit;
        }

        // Truy vấn dữ liệu danh mục hiện tại để đổ vào Form sửa (nếu cần thiết)
        // Lưu ý: Bạn có thể viết thêm hàm getCategoryById($id) trong CategoryModel nếu muốn dùng dữ liệu PHP render thẳng vào form.
        // Hoặc trong file view bạn dùng JS fetch dữ liệu từ API về điền vào cũng được.
        include 'app/views/categories/edit.php';
    }

    // 4. Xử lý xóa danh mục trực tiếp (Dành cho trường hợp không dùng fetch API xóa)
    // URL: /webbanhang/category/delete/{id}
    public function delete($id)
    {
        if ($id) {
            $this->categoryModel->deleteCategory($id);
        }
        // Sau khi xóa xong, điều hướng quay trở lại trang danh sách
        header('Location: /webbanhang/category');
        exit;
    }
}
?>