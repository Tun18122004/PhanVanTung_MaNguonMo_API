<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiệu chỉnh tài khoản - Hệ thống quản lý</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* 1. Đồng bộ nền tối toàn trang */
        body {
            background-color: #0f172a; /* Slate 900 */
            color: #e2e8f0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* 2. Khung Form Bo mạch công nghệ */
        .card-tech {
            background-color: #1e293b !important; /* Slate 800 */
            border: 1px solid #334155;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border-radius: 12px;
        }

        .card-tech .card-header {
            background-color: #1e293b;
            border-bottom: 2px solid #334155;
            padding: 20px;
        }

        .tech-title {
            color: #00f2fe !important; /* Xanh neon */
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 10px rgba(0, 242, 254, 0.3);
            margin: 0;
        }

        /* 3. Tùy biến các ô điền dữ liệu (Cyber Inputs) */
        .form-group label {
            color: #38bdf8; /* Xanh số hóa */
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control-tech {
            background-color: #0f172a !important; /* Slate 900 */
            border: 1px solid #334155 !important;
            color: #ffffff !important;
            border-radius: 6px;
            padding: 12px;
            transition: all 0.2s ease;
        }

        .form-control-tech:focus {
            border-color: #00f2fe !important; /* Sáng neon khi click */
            box-shadow: 0 0 10px rgba(0, 242, 254, 0.4) !important;
            outline: none;
        }

        /* Input dạng Readonly (Khóa không cho sửa) */
        .form-control-tech:disabled, .form-control-tech[readonly] {
            background-color: #1e293b !important;
            color: #64748b !important;
            border-color: #1e293b !important;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
        }

        /* 4. Nút bấm tương tác */
        .btn-cyber-update {
            background: linear-gradient(135deg, #00f2fe, #4facfe);
            color: #0f172a !important;
            font-weight: 700;
            text-transform: uppercase;
            border: none;
            border-radius: 6px;
            padding: 12px 25px;
            transition: all 0.2s ease;
            box-shadow: 0 0 10px rgba(0, 242, 254, 0.3);
        }

        .btn-cyber-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 18px rgba(0, 242, 254, 0.6);
        }

        .btn-cyber-cancel {
            background: transparent;
            color: #64748b !important;
            border: 1px solid #334155;
            border-radius: 6px;
            padding: 12px 25px;
            transition: all 0.2s ease;
        }

        .btn-cyber-cancel:hover {
            background: rgba(100, 116, 139, 0.1);
            color: #cbd5e1 !important;
        }

        /* Thông báo lỗi */
        .error-neon {
            color: #ff2a74;
            font-size: 0.85rem;
            margin-top: 5px;
            text-shadow: 0 0 5px rgba(255, 42, 116, 0.2);
        }
    </style>
</head>
<body>
<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-tech">
                <div class="card-header">
                    <h4 class="tech-title">Cập nhật tài khoản</h4>
                </div>
                <div class="card-body p-4">
                    
                    <form action="/webbanhang/account/update" method="POST">
                        
                        <div class="form-group">
                            <label>Tên đăng nhập (Username)</label>
                            <input type="text" class="form-control form-control-tech" 
                                   value="<?php echo htmlspecialchars($account->username); ?>" readonly>
                            <input type="hidden" name="username" value="<?php echo htmlspecialchars($account->username); ?>">
                        </div>

                        <div class="form-group">
                            <label>Họ và tên hiển thị</label>
                            <input type="text" name="fullname" class="form-control form-control-tech" 
                                   value="<?php echo htmlspecialchars($account->name); ?>" placeholder="Nhập tên đầy đủ...">
                            <?php if (isset($errors['fullname'])): ?>
                                <div class="error-neon"><?php echo $errors['fullname']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Vai trò hệ thống (Role)</label>
                            <select name="role" class="form-control form-control-tech">
                                <option value="admin" <?php echo (strtolower($account->role) === 'admin') ? 'selected' : ''; ?>>ADMIN</option>
                                <option value="user" <?php echo (strtolower($account->role) === 'user') ? 'selected' : ''; ?>>USER</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-end style-gap mt-4" style="gap: 12px;">
                            <a href="/webbanhang/product" class="btn btn-cyber-cancel">Hủy bỏ</a>
                            <button type="submit" class="btn btn-cyber-update">Lưu thay đổi</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
</body>
</html>