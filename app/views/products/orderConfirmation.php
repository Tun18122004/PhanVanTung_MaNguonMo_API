<?php include 'app/views/shares/header.php'; ?>

<style>
    /* Tổng thể khu vực thông báo mang phong cách Hi-Tech Dark Mode */
    .tech-success-container {
        background-color: #0f172a; /* Nền tối chuẩn công nghệ (Slate 900) */
        color: #e2e8f0;
        padding: 50px 40px;
        border-radius: 16px;
        margin-top: 40px;
        margin-bottom: 40px;
        max-width: 600px; /* Giới hạn độ rộng vừa phải cho thông báo */
        margin-left: auto;
        margin-right: auto;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        border: 1px solid #1e293b;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        text-align: center; /* Căn giữa toàn bộ nội dung */
    }

    /* Biểu tượng thành công kỹ thuật số (Vòng tròn định vị) */
    .tech-success-icon {
        width: 80px;
        height: 80px;
        line-height: 80px;
        background: rgba(0, 242, 254, 0.1);
        border: 2px solid #00f2fe;
        color: #00f2fe;
        border-radius: 50%;
        font-size: 2.5rem;
        margin: 0 auto 25px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        text-shadow: 0 0 10px rgba(0, 242, 254, 0.5);
        box-shadow: 0 0 20px rgba(0, 242, 254, 0.2);
    }

    .tech-title {
        color: #00f2fe; /* Màu xanh neon công nghệ */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 20px;
        text-shadow: 0 0 15px rgba(0, 242, 254, 0.4);
    }

    .tech-message {
        color: #94a3b8;
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 35px;
    }

    .tech-message strong {
        color: #38bdf8; /* Highlight màu xanh năng lượng */
    }

    /* Hệ thống nút bấm Tech */
    .btn-tech {
        border-radius: 8px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.9rem !important;
        letter-spacing: 0.5px;
        padding: 14px 24px !important;
        transition: all 0.2s ease !important;
        display: inline-block;
        width: 100%; /* Trải dài mạnh mẽ */
        text-align: center;
        text-decoration: none;
    }

    /* Nút "Tiếp tục mua sắm" kế thừa gradient của hệ thống */
    .btn-primary-tech {
        background: linear-gradient(135deg, #00b4db, #0083b0) !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 4px 15px rgba(0, 180, 219, 0.3);
        cursor: pointer;
    }
    
    .btn-primary-tech:hover {
        box-shadow: 0 6px 20px rgba(0, 180, 219, 0.5);
        transform: translateY(-2px);
    }
</style>

<div class="tech-success-container">

    <div class="tech-success-icon">
        ✓
    </div>

    <h1 class="tech-title">Xác nhận đơn hàng</h1>
    
    <p class="tech-message">
        Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được hệ thống <strong>xử lý thành công</strong> trên cơ sở dữ liệu.
    </p>

    <a href="/webbanhang/Product/list" class="btn-tech btn-primary-tech">Tiếp tục mua sắm</a>

</div>

<?php include 'app/views/shares/footer.php'; ?>