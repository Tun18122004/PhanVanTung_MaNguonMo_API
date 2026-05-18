<?php include 'app/views/shares/header.php'; ?>

<!-- Thẻ style chứa giao diện chi tiết sản phẩm phong cách công nghệ -->
<style>
    /* Tổng thể khu vực chi tiết mang phong cách Hi-Tech Dark Mode */
    .tech-container {
        background-color: #0f172a; /* Nền tối chuẩn công nghệ (Slate 900) */
        color: #e2e8f0;
        padding: 40px;
        border-radius: 16px;
        margin-top: 30px;
        margin-bottom: 40px;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        border: 1px solid #1e293b;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    /* Tiêu đề trang */
    .tech-title {
        color: #00f2fe; /* Màu xanh neon công nghệ */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 35px;
        text-shadow: 0 0 15px rgba(0, 242, 254, 0.4);
        text-align: center;
        border-bottom: 2px solid #1e293b;
        padding-bottom: 15px;
    }

    /* Khung hiển thị hình ảnh sản phẩm lớn */
    .tech-img-box {
        border: 2px solid #334155;
        border-radius: 12px;
        padding: 10px;
        background-color: #1e293b;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        transition: border-color 0.3s ease;
    }
    .tech-img-box:hover {
        border-color: #00f2fe;
    }
    .tech-img-box img {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Tên sản phẩm chính */
    .tech-prod-name {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 2rem;
        margin-top: 0;
        margin-bottom: 20px;
    }

    /* Đoạn văn mô tả sản phẩm */
    .tech-prod-desc {
        color: #94a3b8;
        font-size: 1.05rem;
        line-height: 1.7;
        margin-bottom: 25px;
        background: #1e293b;
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid #00f2fe;
    }

    /* Giá tiền hiển thị rực rỡ */
    .tech-prod-price {
        color: #38bdf8 !important; /* Xanh Cyan năng lượng thay thế màu đỏ thô sơ */
        font-weight: 700 !important;
        font-size: 1.6rem !important;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Thông tin Danh mục */
    .tech-prod-meta {
        font-size: 1rem;
        margin-bottom: 30px;
        color: #cbd5e1;
    }
    /* Tùy biến lại Badge danh mục số hóa */
    .tech-badge {
        background-color: #0f172a !important;
        color: #00f2fe !important;
        border: 1px solid #00f2fe !important;
        padding: 6px 14px !important;
        border-radius: 6px !important;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        margin-left: 5px;
    }

    /* Khu vực chứa các nút bấm */
    .tech-btn-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    /* Hệ thống nút bấm công nghệ */
    .btn {
        border-radius: 8px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.9rem !important;
        letter-spacing: 0.5px;
        padding: 12px 28px !important;
        transition: all 0.2s ease !important;
    }

    /* Nút "Thêm vào giỏ hàng" cực ngầu */
    .btn-success-tech {
        background: linear-gradient(135deg, #00b4db, #0083b0) !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 180, 219, 0.4);
    }
    .btn-success-tech:hover {
        box-shadow: 0 6px 20px rgba(0, 180, 219, 0.6);
        transform: translateY(-2px);
    }

    /* Nút "Quay lại danh sách" */
    .btn-secondary-tech {
        background: transparent !important;
        color: #94a3b8 !important;
        border: 1px solid #475569 !important;
    }
    .btn-secondary-tech:hover {
        background: #475569 !important;
        color: #ffffff !important;
    }

    /* Thông báo không tìm thấy sản phẩm */
    .alert-danger-tech {
        background-color: rgba(244, 63, 94, 0.1) !important;
        border: 1px solid #f43f5e !important;
        color: #fda4af !important;
        border-radius: 12px !important;
        padding: 30px !important;
    }
</style>

<div class="container">
    <div class="tech-container">
        
        <h2 class="tech-title">Chi tiết sản phẩm</h2>
        
        <!-- Kiểm tra sự tồn tại của sản phẩm (Giữ nguyên logic của bạn) -->
        <?php if ($product): ?>
            <div class="row">
                
                <!-- Cột trái: Hình ảnh sản phẩm -->
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="tech-img-box">
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                        <?php else: ?>
                            <img src="/webbanhang/images/no-image.png" alt="Không có ảnh">
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Cột phải: Thông tin chi tiết -->
                <div class="col-md-6">
                    <!-- Tên sản phẩm -->
                    <h3 class="tech-prod-name">
                        <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                    </h3>
                    
                    <!-- Mô tả sản phẩm -->
                    <p class="tech-prod-desc">
                        <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                    </p>
                    
                    <!-- Giá tiền sản phẩm -->
                    <p class="tech-prod-price">
                        <span>💰</span> <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                    </p>
                    
                    <!-- Danh mục sản phẩm -->
                    <p class="tech-prod-meta">
                        <strong>Danh mục:</strong>
                        <span class="tech-badge">
                            <?php echo !empty($product->category_name) ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?>
                        </span>
                    </p>
                    
                    <!-- Khu vực các nút bấm hành động -->
                    <div class="tech-btn-group">
                        <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success-tech">➕ Thêm vào giỏ hàng</a>
                        <a href="/webbanhang/Product/list" class="btn btn-secondary-tech">Quay lại danh sách</a>
                    </div>
                </div>
                
            </div>
        <?php else: ?>
            <!-- Giao diện khi không tìm thấy sản phẩm -->
            <div class="alert alert-danger-tech text-center">
                <h4>Không tìm thấy sản phẩm!</h4>
            </div>
        <?php endif; ?>
        
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>