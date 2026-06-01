<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản - Hệ thống quản lý</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* 1. Đồng bộ nền tối toàn trang hệ thống */
        body {
            background-color: #0f172a; /* Slate 900 */
            color: #e2e8f0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* 2. Style khối bảng dữ liệu theo phong cách Bo mạch công nghệ */
        .card-tech {
            background-color: #1e293b !important; /* Slate 800 */
            border: 1px solid #334155;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border-radius: 12px;
            overflow: hidden;
        }

        .card-tech .card-header {
            background-color: #1e293b;
            border-bottom: 2px solid #334155;
            padding: 20px;
        }

        /* Tiêu đề phát sáng nhẹ */
        .tech-title {
            color: #00f2fe !important; /* Xanh neon */
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 10px rgba(0, 242, 254, 0.3);
            margin: 0;
        }

        /* Badge tổng số lượng */
        .tech-badge {
            background: linear-gradient(135deg, #00b4db, #0083b0);
            color: #ffffff;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 180, 219, 0.4);
        }

        /* Nút thêm mới tài khoản phong cách Neon Gradient */
        .btn-cyber-add {
            background: linear-gradient(135deg, #00b4db, #0083b0);
            color: #ffffff !important;
            font-weight: 600;
            border: none;
            border-radius: 20px;
            padding: 6px 18px;
            box-shadow: 0 0 10px rgba(0, 180, 219, 0.4);
            transition: all 0.2s ease;
        }
        .btn-cyber-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(0, 180, 219, 0.7);
        }

        /* 3. Tùy biến Table không gian mạng (Cyber Table) */
        .table-tech {
            color: #cbd5e1;
            margin-bottom: 0;
        }

        .table-tech thead th {
            background-color: #0f172a !important; /* Slate 900 */
            color: #38bdf8; /* Màu xanh bầu trời số hóa */
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #334155 !important;
            border-top: none;
            padding: 15px;
        }

        .table-tech tbody tr {
            border-bottom: 1px solid #334155;
            transition: all 0.2s ease;
        }

        /* Hiệu ứng sáng dòng khi di chuột qua */
        .table-tech tbody tr:hover {
            background-color: #24334d !important; 
            box-shadow: inset 4px 0 0 #00f2fe; /* Vạch neon bên trái dòng */
        }

        .table-tech tbody td {
            padding: 16px 15px;
            vertical-align: middle;
            border-top: none;
        }

        /* Mã định danh Username phát sáng */
        .account-username {
            color: #00f2fe;
            font-weight: 700;
            font-family: 'Courier New', Courier, monospace; /* Font dạng mã code */
        }

        /* Định dạng phân cấp phân quyền bằng màu sắc */
        .role-admin {
            color: #ff2a74;
            font-weight: 700;
            text-shadow: 0 0 8px rgba(255, 42, 116, 0.3);
        }
        .role-user {
            color: #10b981;
            font-weight: 700;
            text-shadow: 0 0 8px rgba(16, 185, 129, 0.3);
        }

        /* Text phụ mờ */
        .text-muted-tech {
            color: #64748b !important;
        }

        /* Trạng thái trống */
        .alert-tech {
            background-color: #1e293b;
            border: 1px dashed #ef4444;
            color: #f87171;
            border-radius: 8px;
        }

        /* 4. Nút bấm tương tác Thao tác */
        .btn-cyber-edit {
            background: linear-gradient(135deg, #00f2fe, #4facfe);
            color: #0f172a !important;
            font-weight: 600;
            font-size: 0.8rem;
            border: none;
            border-radius: 6px;
            padding: 6px 14px;
            transition: all 0.2s ease;
            box-shadow: 0 0 8px rgba(0, 242, 254, 0.3);
        }

        .btn-cyber-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 15px rgba(0, 242, 254, 0.6);
        }

        .btn-cyber-delete {
            background: transparent;
            color: #ff2a74 !important;
            font-weight: 600;
            font-size: 0.8rem;
            border: 1px solid #ff2a74;
            border-radius: 6px;
            padding: 5px 13px;
            transition: all 0.2s ease;
        }

        .btn-cyber-delete:hover {
            background: rgba(255, 42, 116, 0.1);
            box-shadow: 0 0 12px rgba(255, 42, 116, 0.4);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<?php include 'app/views/shares/header.php'; ?>

<div class="container my-5">
    <div class="card card-tech">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="tech-title">Hệ thống quản lý tài khoản</h4>
            <div class="d-flex align-items-center" style="gap: 12px;">
                <span class="tech-badge">Tổng số: <?php echo count($accounts); ?> thành viên</span>
            </div>
        </div>
        
        <div class="card-body p-0">
            <?php if (!empty($accounts)): ?>
                <div class="table-responsive">
                    <table class="table table-tech">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Tên đăng nhập (Username)</th>
                                <th style="width: 30%;">Họ và tên hiển thị</th>
                                <th style="width: 20%;">Vai trò hệ thống</th>
                                <th style="width: 25%;" class="text-center">Thao tác dữ liệu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($accounts as $userItem): ?>
                                <tr>
                                    <td>
                                        <span class="account-username"><?php echo htmlspecialchars($userItem->username); ?></span>
                                    </td>
                                    
                                    <td>
                                        <span class="font-weight-bold" style="color: #ffffff;">
                                            <?php echo htmlspecialchars($userItem->name); ?>
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <?php if (strtolower($userItem->role) === 'admin'): ?>
                                            <span class="role-admin">ADMIN</span>
                                        <?php else: ?>
                                            <span class="role-user">USER</span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center" style="gap: 10px;">
                                            <a href="/webbanhang/account/edit/<?php echo urlencode($userItem->username); ?>" 
                                               class="btn btn-cyber-edit btn-sm">
                                                Sửa
                                            </a>
                                            
                                            <a href="/webbanhang/account/delete/<?php echo urlencode($userItem->username); ?>" 
                                               class="btn btn-cyber-delete btn-sm"
                                               onclick="return confirm('CẢNH BÁO HỆ THỐNG: Bạn chắc chắn muốn xóa vĩnh viễn tài khoản [<?php echo htmlspecialchars($userItem->username); ?>] không?')">
                                                Xóa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-5 text-center">
                    <div class="alert alert-tech d-inline-block px-5" role="alert">
                        Cơ sở dữ liệu chưa ghi nhận tài khoản nào khả dụng!
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>