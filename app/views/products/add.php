<?php include 'app/views/shares/header.php'; ?>

<!-- Thẻ style chứa giao diện form nhập liệu công nghệ -->
<style>
    /* Tổng thể khu vực Form mang phong cách Hi-Tech Dark Mode */
    .tech-container {
        background-color: #0f172a; /* Nền tối chuẩn công nghệ (Slate 900) */
        color: #e2e8f0;
        padding: 40px;
        border-radius: 16px;
        margin-top: 20px;
        margin-bottom: 30px;
        max-width: 700px; /* Giới hạn độ rộng form cho cân đối */
        margin-left: auto;
        margin-right: auto;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        border: 1px solid #1e293b;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
    }

    .tech-title {
        color: #00f2fe; /* Màu xanh neon công nghệ */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 30px;
        text-shadow: 0 0 15px rgba(0, 242, 254, 0.4);
        text-align: center;
    }

    /* Định dạng lại các cụm form-group */
    .form-group {
        margin-bottom: 22px !important;
    }

    /* Nhãn chữ (Label) */
    .form-group label {
        color: #38bdf8; /* Màu xanh Cyan năng lượng */
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    /* Tùy biến toàn bộ các ô Input, Textarea, Select số hóa */
    .form-control {
        background-color: #1e293b !important; /* Nền ô nhập tối */
        border: 1px solid #334155 !important;
        color: #ffffff !important;
        border-radius: 8px !important;
        padding: 12px 16px !important;
        font-size: 0.95rem !important;
        transition: all 0.3s ease !important;
    }

    /* Hiệu ứng khi click vào ô nhập liệu (Focus) */
    .form-control:focus {
        border-color: #00f2fe !important;
        box-shadow: 0 0 10px rgba(0, 242, 254, 0.25) !important;
        background-color: #1e293b !important;
    }

    /* Custom riêng cho ô Textarea (Mô tả) */
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* Thẻ select hiển thị danh mục */
    select.form-control {
        cursor: pointer;
    }
    select.form-control option {
        background-color: #1e293b; /* Giữ màu tối cho dropdown options */
        color: #ffffff;
    }

    /* Ô chọn file hình ảnh */
    input[type="file"].form-control {
        padding: 8px 12px !important;
        cursor: pointer;
    }

    /* Tùy chỉnh thông báo lỗi bảo mật/validate của PHP */
    .alert-danger-tech {
        background-color: rgba(244, 63, 94, 0.1) !important;
        border: 1px solid #f43f5e !important;
        color: #fda4af !important;
        border-radius: 8px !important;
        padding: 15px 20px !important;
        margin-bottom: 25px;
    }
    .alert-danger-tech ul {
        margin: 0;
        padding-left: 20px;
    }

    /* Hệ thống nút bấm Tech */
    .btn {
        border-radius: 8px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.9rem !important;
        letter-spacing: 0.5px;
        padding: 12px 20px !important;
        transition: all 0.2s ease !important;
        display: inline-block;
        width: 100%; /* Cho các nút trải dài nhìn mạnh mẽ hơn */
        text-align: center;
    }

    /* Nút "Thêm sản phẩm" chính */
    .btn-primary-tech {
        background: linear-gradient(135deg, #00b4db, #0083b0) !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 180, 219, 0.3);
        margin-top: 10px;
        cursor: pointer;
    }
    .btn-primary-tech:hover {
        box-shadow: 0 6px 20px rgba(0, 180, 219, 0.5);
        transform: translateY(-2px);
    }

    /* Nút "Quay lại danh sách" */
    .btn-secondary-tech {
        background: transparent !important;
        color: #94a3b8 !important;
        border: 1px solid #475569 !important;
        margin-top: 12px;
        text-decoration: none;
    }
    .btn-secondary-tech:hover {
        background: #475569 !important;
        color: #ffffff !important;
    }
</style>

<div class="tech-container">

    <h1 class="tech-title">Thêm sản phẩm mới</h1>

    <!-- Khối hiển thị thông báo lỗi (Giữ nguyên logic của bạn) -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger-tech">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form gửi dữ liệu (Giữ nguyên các thuộc tính logic ban đầu) -->
    <form method="POST" action="/webbanhang/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
        
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>
        
        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->id; ?>">
                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="image">Hình ảnh sản phẩm:</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary-tech">Thêm sản phẩm</button>
    </form>

    <!-- Nút quay lại điều hướng -->
    <a href="/webbanhang/Product/list" class="btn btn-secondary-tech">Quay lại danh sách sản phẩm</a>

</div>

<?php include 'app/views/shares/footer.php'; ?>