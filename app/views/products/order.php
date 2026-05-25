<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng - Hệ thống quản lý</title>
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

        /* Mã đơn hàng phát sáng */
        .order-id {
            color: #00f2fe;
            font-weight: 700;
            font-family: 'Courier New', Courier, monospace; /* Font dạng mã code */
        }

        /* Giá tiền Neon Đỏ/Hồng công nghệ */
        .text-neon-price {
            color: #ff2a74;
            font-weight: 700;
            text-shadow: 0 0 8px rgba(255, 42, 116, 0.3);
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
    </style>
</head>
<body>
<?php include 'app/views/shares/header.php'; ?>
<div class="container my-5">
    <div class="card card-tech">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="tech-title">Dữ liệu đơn hàng</h4>
            <span class="tech-badge">Tổng số: <?php echo count($order); ?> đơn</span>
        </div>
        
        <div class="card-body p-0">
            <?php if (!empty($order)): ?>
                <div class="table-responsive">
                    <table class="table table-tech">
                        <thead>
                            <tr>
                                <th style="width: 8%;">Mã Đơn</th>
                                <th style="width: 18%;">Khách hàng</th>
                                <th style="width: 15%;">Liên hệ</th>
                                <th style="width: 22%;">Địa chỉ giao hàng</th>
                                <th style="width: 15%;">Tổng thanh toán</th>
                                <th style="width: 12%;">Thời gian</th>
                                <th style="width: 10%;">Ghi chú</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order as $item): ?>
                                <tr>
                                    <td><span class="order-id"><?php echo $item->id; ?></span></td>
                                    
                                    <td>
                                        <span class="font-weight-bold" style="color: #ffffff;"><?php echo htmlspecialchars($item->name); ?></span>
                                    </td>
                                    
                                    <td>
                                        <div style="color: #38bdf8;"><?php echo htmlspecialchars($item->phone); ?></div>
                                        <?php if (!empty($item->phone2)): ?>
                                            <div class="small text-muted-tech"><?php echo htmlspecialchars($item->phone2); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td>
                                        <span class="small" style="line-height: 1.4; display: block;"><?php echo htmlspecialchars($item->address); ?></span>
                                    </td>
                                    
                                    <td>
                                        <span class="text-neon-price">
                                            <?php echo number_format($item->total, 0, ',', '.'); ?> đ
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <span class="small text-light">
                                            <?php echo date('d/m/Y', strtotime($item->created_at)); ?>
                                        </span>
                                        <div class="small text-muted-tech" style="font-size: 11px;">
                                            <?php echo date('H:i', strtotime($item->created_at)); ?>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <span class="small italic text-muted-tech">
                                            <?php echo !empty($item->note) ? htmlspecialchars($item->note) : '<em>Không có</em>'; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="p-5 text-center">
                    <div class="alert alert-tech d-inline-block px-5" role="alert">
                        Hệ thống chưa ghi nhận đơn hàng nào!
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