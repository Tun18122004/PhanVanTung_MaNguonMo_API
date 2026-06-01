<?php include 'app/views/shares/header.php'; ?>

<style>
    /* Tổng thể mang phong cách Hi-Tech */
    .tech-register-section {
        background-color: #0f172a; /* Nền tối chuẩn công nghệ (Slate 900) */
        min-height: 100vh;
        display: flex;
        align-items: center;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        padding: 40px 0;
    }

    /* Biến đổi khung đăng ký thành khối bo mạch Cyberpunk */
    .tech-register-card {
        background: #1e293b !important; /* Nền card tối (Slate 800) */
        border: 1px solid #334155 !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
    }

    /* Hiệu ứng phát sáng nhẹ khi hover vào card dữ liệu */
    .tech-register-card:hover {
        border-color: #00f2fe !important;
        box-shadow: 0 0 25px rgba(0, 242, 254, 0.15);
    }

    /* Tiêu đề chữ Neon nghệ thuật */
    .tech-register-title {
        color: #00f2fe; /* Màu xanh neon công nghệ */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-shadow: 0 0 15px rgba(0, 242, 254, 0.4);
    }

    .tech-subtitle {
        color: #94a3b8 !important; /* Màu chữ xám nhẹ dịu mắt */
    }

    /* Custom lại các ô nhập liệu thành phong cách số hóa */
    .tech-form-control {
        background-color: #0f172a !important;
        border: 1px solid #475569 !important;
        color: #ffffff !important;
        border-radius: 8px !important;
        padding: 12px 15px !important;
        transition: all 0.3s ease;
        width: 100%;
    }

    /* Khi click vào ô nhập liệu sẽ phát sáng viền */
    .tech-form-control:focus {
        border-color: #00f2fe !important;
        box-shadow: 0 0 10px rgba(0, 242, 254, 0.3) !important;
        outline: none;
    }

    /* Nút Đăng ký Neon */
    .btn-register-tech {
        background: transparent !important;
        color: #00f2fe !important;
        border: 1px solid #00f2fe !important;
        padding: 12px 40px !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 8px !important;
        transition: all 0.2s ease !important;
    }

    .btn-register-tech:hover {
        background: #00f2fe !important;
        color: #0f172a !important;
        box-shadow: 0 0 15px rgba(0, 242, 254, 0.5);
        transform: scale(1.02);
    }

    /* Đường dẫn chuyển đổi đăng nhập */
    .tech-link {
        color: #38bdf8 !important; /* Xanh Cyan sáng */
        text-decoration: none;
        transition: color 0.2s;
    }

    .tech-link:hover {
        color: #00f2fe !important;
        text-decoration: underline !important;
    }

    /* Hộp thông báo lỗi được tinh chỉnh */
    .tech-alert-danger {
        background-color: rgba(244, 63, 94, 0.1) !important;
        border: 1px solid #f43f5e !important;
        color: #f43f5e !important;
        border-radius: 8px;
        font-size: 0.9rem;
    }
</style>

<section class="tech-register-section">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                <div class="card tech-register-card text-white">
                    <div class="card-body p-5 text-center">
                        
                        <h2 class="tech-register-title mb-2">REGISTER</h2>
                        <p class="tech-subtitle mb-4">Tạo tài khoản mới để truy cập hệ thống công nghệ</p>

                        <?php if (isset($errors) && count($errors) > 0): ?>
                            <div class="alert tech-alert-danger text-start p-3 mb-4">
                                <ul class="mb-0 ps-3">
                                    <?php foreach ($errors as $err): ?>
                                        <li><?php echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8'); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <form class="user" action="/webbanhang/account/save" method="post">
                            <div class="form-group row mb-4">
                                <div class="col-sm-6 mb-3 mb-sm-0 text-start">
                                    <input type="text" class="form-control tech-form-control" id="username" name="username" placeholder="Nhập username...">
                                </div>
                                <div class="col-sm-6 text-start">
                                    <input type="text" class="form-control tech-form-control" id="fullname" name="fullname" placeholder="Nhập họ và tên...">
                                </div>
                            </div>
                            
                            <div class="form-group row mb-4">
                                <div class="col-sm-6 mb-3 mb-sm-0 text-start">
                                    <input type="password" class="form-control tech-form-control" id="password" name="password" placeholder="Nhập mật khẩu...">
                                </div>
                                <div class="col-sm-6 text-start">
                                    <input type="password" class="form-control tech-form-control" id="confirmpassword" name="confirmpassword" placeholder="Xác nhận mật khẩu...">
                                </div>
                            </div>
                            
                            <div class="form-group text-center mt-4 mb-3">
                                <button type="submit" class="btn btn-register-tech">
                                    Register
                                </button>
                            </div>

                            <div class="mt-3">
                                <p class="mb-0 tech-subtitle">Đã có tài khoản hệ thống? 
                                    <a href="/webbanhang/account/login" class="tech-link fw-bold">Đăng nhập tại đây</a>
                                </p>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'app/views/shares/footer.php'; ?>