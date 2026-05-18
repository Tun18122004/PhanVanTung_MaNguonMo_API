<?php include 'app/views/shares/header.php'; ?>

<style>
    /* Tổng thể mang phong cách Hi-Tech */
    .tech-container {
        background-color: #0f172a; /* Nền tối chuẩn công nghệ (Slate 900) */
        color: #e2e8f0;
        padding: 30px;
        border-radius: 16px;
        margin-top: 20px;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    .tech-title {
        color: #00f2fe; /* Màu xanh neon công nghệ */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 25px;
        text-shadow: 0 0 15px rgba(0, 242, 254, 0.4);
    }

    /* Định dạng lại danh sách từ hàng dọc thô sơ sang dạng Lưới (Grid) hiện đại */
    .tech-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        padding: 0;
        margin-top: 25px;
        list-style: none; /* Khử dấu chấm tròn của thẻ ul */
    }

    /* Biến đổi các item thành các "Card" bo mạch */
    .tech-card {
        background: #1e293b !important; /* Nền card tối (Slate 800) */
        border: 1px solid #334155 !important;
        border-radius: 14px !important;
        padding: 20px !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2);
    }

    /* Hiệu ứng Hover phát sáng viền Cyberpunk */
    .tech-card:hover {
        transform: translateY(-6px);
        border-color: #00f2fe !important;
        box-shadow: 0 12px 20px -5px rgba(0, 242, 254, 0.25);
    }

    /* Tiêu đề sản phẩm trong Card */
    .tech-card h2 {
        font-size: 1.25rem;
        margin-top: 0;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .tech-card h2 a {
        color: #ffffff !important;
        text-decoration: none;
        transition: color 0.2s;
    }

    .tech-card h2 a:hover {
        color: #00f2fe !important;
    }

    /* Hình ảnh sản phẩm công nghệ */
    .tech-image {
        width: 100%;
        max-width: 100% !important; /* Tối ưu kích thước linh hoạt theo khung card */
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1px solid #475569;
        background-color: #0f172a;
    }

    /* Đoạn văn mô tả */
    .tech-desc {
        color: #94a3b8; /* Chữ xám nhẹ dịu mắt */
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 12px;
        /* Giới hạn mô tả trong 2 dòng để các card đều nhau không bị lệch */
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Giá tiền hiển thị nổi bật */
    .tech-price {
        color: #38bdf8 !important; /* Xanh Cyan sáng đại diện cho năng lượng công nghệ */
        font-weight: 700;
        font-size: 1.15rem;
        margin-bottom: 10px;
    }

    /* Nhãn Danh mục sản phẩm */
    .tech-category {
        font-size: 0.8rem;
        background: #0f172a;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-block;
        width: fit-content;
        color: #cbd5e1;
        border: 1px solid #334155;
        margin-bottom: 20px;
    }

    /* Khu vực chứa các nút bấm hành động */
    .tech-actions {
        display: flex;
        gap: 10px;
        margin-top: auto; /* Đẩy các nút bấm luôn nằm sát đáy card */
    }

    /* Custom lại hệ thống nút bấm Bootstrap thành phong cách số hóa */
    .btn {
        border-radius: 8px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.8rem !important;
        letter-spacing: 0.5px;
        transition: all 0.2s ease !important;
    }

    /* Nút "Thêm sản phẩm mới" hoành tráng */
    .btn-success-tech {
        background: linear-gradient(135deg, #00b4db, #0083b0) !important;
        color: #fff !important;
        border: none !important;
        padding: 12px 24px !important;
        box-shadow: 0 4px 15px rgba(0, 180, 219, 0.3);
    }
    .btn-success-tech:hover {
        box-shadow: 0 6px 20px rgba(0, 180, 219, 0.5);
        transform: scale(1.02);
    }

    /* Nút Sửa outline tinh tế */
    .btn-warning-tech {
        flex: 1;
        background: transparent !important;
        color: #ffb03a !important;
        border: 1px solid #ffb03a !important;
        text-align: center;
        padding: 8px 0 !important;
    }
    .btn-warning-tech:hover {
        background: #ffb03a !important;
        color: #0f172a !important;
    }

    /* Nút Xóa mang tín hiệu cảnh báo */
    .btn-danger-tech {
        flex: 1;
        background: transparent !important;
        color: #f43f5e !important;
        border: 1px solid #f43f5e !important;
        text-align: center;
        padding: 8px 0 !important;
    }
    .btn-danger-tech:hover {
        background: #f43f5e !important;
        color: #ffffff !important;
        box-shadow: 0 0 12px rgba(244, 63, 94, 0.5);
    }
</style>

<div class="tech-container">

    <h1 class="tech-title">Danh sách sản phẩm</h1>
    
    <a href="/webbanhang/Product/add" class="btn btn-success-tech mb-2">Thêm sản phẩm mới</a>
    
    <ul class="tech-grid">
    <?php foreach ($products as $product): ?>
        <li class="tech-card">
            
            <h2>
                <a href="/webbanhang/Product/show/<?php echo $product->id; ?>">
                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </h2>
            
            <?php if ($product->image): ?>
                <img src="/webbanhang/<?php echo $product->image; ?>" alt="Product Image" class="tech-image">
            <?php endif; ?>
            
            <p class="tech-desc"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="tech-price">Giá: <?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?> VND</p>
            <p class="tech-category">Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>
            
            <div class="tech-actions">
                <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning-tech">Sửa</a>
                <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger-tech" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
            </div>
            
        </li>
    <?php endforeach; ?>
    </ul>

</div>

<?php include 'app/views/shares/footer.php'; ?>