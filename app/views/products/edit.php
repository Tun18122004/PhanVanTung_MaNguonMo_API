<?php include 'app/views/shares/header.php'; ?>

<!-- Thẻ style chứa giao diện form chỉnh sửa sản phẩm phong cách công nghệ -->
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

    /* Định dạng các cụm form-group */
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
        background-color: #1e293b;
        color: #ffffff;
    }

    /* Ô chọn file hình ảnh */
    input[type="file"].form-control {
        padding: 8px 12px !important;
        cursor: pointer;
        margin-bottom: 12px;
    }

    /* Định dạng lại khu vực hiển thị ảnh cũ của sản phẩm */
    .tech-current-img {
        display: block;
        max-width: 120px;
        height: auto;
        border-radius: 8px;
        border: 2px solid #334155;
        background-color: #0f172a;
        padding: 4px;
        margin-top: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    /* Tùy chỉnh thông báo lỗi validate của PHP */
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
        width: 100%; /* Trải dài nút bấm */
        text-align: center;
    }

    /* Nút "Lưu thay đổi" chính */
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

    <h1 class="tech-title">Sửa sản phẩm</h1>

    <!-- Khối hiển thị thông báo lỗi (Giữ nguyên logic gốc) -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger-tech">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form gửi dữ liệu cập nhật (Giữ nguyên action và onsubmit) -->
    <form method="POST" action="/webbanhang/Product/update" enctype="multipart/form-data" onsubmit="return validateForm();">
        
        <!-- Các trường dữ liệu ẩn phục vụ cho logic controller -->
        <input type="hidden" name="id" value="<?php echo $product->id; ?>">
        
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category->id; ?>" <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="image">Hình ảnh:</label>
            <input type="file" id="image" name="image" class="form-control">
            
            <!-- Giữ nguyên thẻ hidden lưu tên ảnh cũ -->
            <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
            
            <!-- Hiển thị ảnh hiện tại nếu có kèm css tech -->
            <?php if ($product->image): ?>
                <img src="/<?php echo $product->image; ?>" alt="Product Image" class="tech-current-img">
            <?php endif; ?>
        </div>
        
        <button type="submit" class="btn btn-primary-tech">Lưu thay đổi</button>
    </form>

    <!-- Điều hướng quay lại trang danh sách -->
    <a href="/webbanhang/Product/list" class="btn btn-secondary-tech">Quay lại danh sách sản phẩm</a>

</div>

<?php include 'app/views/shares/footer.php'; ?>