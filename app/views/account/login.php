<?php include 'app/views/shares/header.php'; ?>

<style>
    /* Tổng thể mang phong cách Hi-Tech */
    .tech-login-section {
        background-color: #0f172a; /* Nền tối chuẩn công nghệ (Slate 900) */
        min-height: 100vh;
        display: flex;
        align-items: center;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* Biến đổi card đăng nhập thành khối bo mạch Cyberpunk */
    .tech-login-card {
        background: #1e293b !important; /* Nền card tối (Slate 800) */
        border: 1px solid #334155 !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hiệu ứng phát sáng nhẹ cho toàn bộ hộp đăng nhập */
    .tech-login-card:hover {
        border-color: #00f2fe !important;
        box-shadow: 0 0 25px rgba(0, 242, 254, 0.15);
    }

    /* Tiêu đề chữ Neon nghệ thuật */
    .tech-login-title {
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
    }

    /* Khi click vào ô nhập liệu sẽ phát sáng viền */
    .tech-form-control:focus {
        border-color: #00f2fe !important;
        box-shadow: 0 0 10px rgba(0, 242, 254, 0.3) !important;
        outline: none;
    }

    .tech-label {
        color: #cbd5e1 !important;
        font-size: 0.9rem;
        font-weight: 500;
        margin-top: 5px;
        display: block;
        text-align: left;
    }

    /* Nút đăng nhập Neon */
    .btn-login-tech {
        width: 100%;
        background: transparent !important;
        color: #00f2fe !important;
        border: 1px solid #00f2fe !important;
        padding: 12px 0 !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 8px !important;
        transition: all 0.2s ease !important;
    }

    .btn-login-tech:hover {
        background: #00f2fe !important;
        color: #0f172a !important;
        box-shadow: 0 0 15px rgba(0, 242, 254, 0.5);
        transform: scale(1.02);
    }

    /* Các liên kết chữ */
    .tech-link {
        color: #38bdf8 !important; /* Xanh Cyan sáng */
        text-decoration: none;
        transition: color 0.2s;
    }

    .tech-link:hover {
        color: #00f2fe !important;
        text-decoration: underline !important;
    }

    /* Icon mạng xã hội */
    .tech-social-icon {
        color: #cbd5e1;
        font-size: 1.2rem;
        transition: all 0.2s ease;
    }

    .tech-social-icon:hover {
        color: #00f2fe;
        transform: translateY(-3px);
    }

    /* Hộp thông báo lỗi hệ thống */
    .tech-alert-danger {
        background-color: rgba(244, 63, 94, 0.1) !important;
        border: 1px solid #f43f5e !important;
        color: #f43f5e !important;
        border-radius: 8px;
        font-size: 0.9rem;
    }
</style>

<section class="tech-login-section">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card tech-login-card text-white">
                    <div class="card-body p-5 text-center">
                        <form action="/webbanhang/account/checklogin" method="post">
                            <div class="mb-md-4">
                                <h2 class="tech-login-title mb-2">LOGIN</h2>
                                <p class="tech-subtitle mb-4">Vui lòng nhập tài khoản và mật khẩu hệ thống!</p>

                                <?php if (isset($errors) && count($errors) > 0): ?>
                                    <div class="alert tech-alert-danger text-start p-3 mb-4">
                                        <ul class="mb-0 ps-3">
                                            <?php foreach ($errors as $error): ?>
                                                <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <div class="form-outline mb-4 text-start">
                                    <input type="text" name="username" class="form-control tech-form-control" placeholder="Nhập username..." value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES, 'UTF-8'); ?>" />
                                    <label class="tech-label">Tài khoản</label>
                                </div>

                                <div class="form-outline mb-4 text-start">
                                    <input type="password" name="password" class="form-control tech-form-control" placeholder="Nhập mật khẩu..." />
                                    <label class="tech-label">Mật khẩu</label>
                                </div>

                                <p class="small mb-4 text-end">
                                    <a class="tech-link" href="#!">Quên mật khẩu?</a>
                                </p>

                                <button class="btn btn-login-tech" type="submit">Đăng Nhập</button>

                                <div class="d-flex justify-content-center text-center mt-4">
                                    <a href="#!" class="tech-social-icon"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#!" class="tech-social-icon mx-4"><i class="fab fa-twitter"></i></a>
                                    <a href="#!" class="tech-social-icon"><i class="fab fa-google"></i></a>
                                </div>
                            </div>

                            <div class="mt-2">
                                <p class="mb-0 tech-subtitle">Chưa có tài khoản? 
                                    <a href="/webbanhang/account/register" class="tech-link fw-bold">Đăng ký ngay</a>
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