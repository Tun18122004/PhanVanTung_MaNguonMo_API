<?php include 'app/views/shares/header.php';
?>

<style>
/* Tổng thể khu vực Form mang phong cách Hi-Tech Dark Mode */
.tech-container {
    background-color: #0f172a;
    /* Nền tối chuẩn công nghệ (Slate 900) */
    color: #e2e8f0;
    padding: 40px;
    border-radius: 16px;
    margin-top: 20px;
    margin-bottom: 30px;
    max-width: 700px;
    /* Giới hạn độ rộng form cho cân đối */
    margin-left: auto;
    margin-right: auto;
    font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    border: 1px solid #1e293b;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
}

.tech-title {
    color: #00f2fe;
    /* Màu xanh neon công nghệ */
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
    color: #38bdf8;
    /* Màu xanh Cyan năng lượng */
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    font-size: 0.95rem;
    letter-spacing: 0.5px;
}

/* Tùy biến toàn bộ các ô Input, Textarea số hóa */
.form-control {
    background-color: #1e293b !important;
    /* Nền ô nhập tối */
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

/* Custom riêng cho ô Textarea Địa chỉ */
textarea.form-control {
    min-height: 100px;
    resize: vertical;
}

/* Hệ thống nút bấm Tech */
.btn-tech {
    border-radius: 8px !important;
    font-weight: 600 !important;
    text-transform: uppercase;
    font-size: 0.9rem !important;
    letter-spacing: 0.5px;
    padding: 12px 20px !important;
    transition: all 0.2s ease !important;
    display: inline-block;
    width: 100%;
    /* Trải dài mạnh mẽ */
    text-align: center;
    text-decoration: none;
}

/* Nút "Thanh toán" chính */
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

/* Nút "Quay lại giỏ hàng" */
.btn-secondary-tech {
    background: transparent !important;
    color: #94a3b8 !important;
    border: 1px solid #475569 !important;
    margin-top: 12px;
}

.btn-secondary-tech:hover {
    background: #475569 !important;
    color: #ffffff !important;
}
</style>

<div class="tech-container">
    <h1 class="tech-title">Xác thực thanh toán</h1>

    <form method="POST" action="/webbanhang/Product/processCheckout">
        <?php

            // LẤY DỮ LIỆU TỪ SESSION RA
            $total = isset($_SESSION['checkout_total']) ? $_SESSION['checkout_total'] : 0;
        ?>
        <div class="form-group">
            <label for="name">Họ tên người nhận:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại liên hệ:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone2">Số điện thoại thứ 2:</label>
            <input type="text" id="phone2" name="phone2" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ giao hàng:</label>
            <textarea id="address" name="address" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="note">Ghi chú:</label>
            <textarea id="note" name="note" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="total">Tổng tiền thanh toán:</label>
            <input type="text" id="total" name="total" value="<?php echo $total?>" class="form-control" required>
        </div>

        <button type="submit" class="btn-tech btn-primary-tech">Xác nhận thanh toán</button>
    </form>

    <a href="/webbanhang/Product/cart" class="btn-tech btn-secondary-tech">Quay lại giỏ hàng</a>

</div>

<?php include 'app/views/shares/footer.php'; ?>