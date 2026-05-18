<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Thẻ style chuyển đổi thanh điều hướng sang phong cách công nghệ -->
    <style>
        /* Đồng bộ nền tối toàn trang cho hệ thống */
        body {
            background-color: #0f172a; /* Slate 900 */
            color: #e2e8f0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        /* Tùy biến thanh Navbar thành bo mạch công nghệ phẳng */
        .navbar-tech {
            background-color: #1e293b !important; /* Slate 800 */
            border-bottom: 2px solid #334155;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            padding: 15px 20px;
        }

        /* Logo / Tên thương hiệu hiệu ứng phát sáng */
        .navbar-tech .navbar-brand {
            color: #00f2fe !important; /* Xanh neon */
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 12px rgba(0, 242, 254, 0.4);
            transition: all 0.3s ease;
        }
        .navbar-tech .navbar-brand:hover {
            color: #38bdf8 !important;
            text-shadow: 0 0 18px rgba(56, 189, 248, 0.6);
        }

        /* Các mục menu điều hướng (Nav Links) */
        .navbar-tech .nav-link {
            color: #94a3b8 !important; /* Màu xám nhẹ mặc định */
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 8px 16px !important;
            border-radius: 6px;
            transition: all 0.3s ease;
            margin-right: 5px;
        }

        /* Hiệu ứng khi di chuột qua các mục menu */
        .navbar-tech .nav-link:hover {
            color: #ffffff !important;
            background-color: #0f172a; /* Nền tối sâu hơn */
            border-bottom: 2px solid #00f2fe; /* Vạch neon dưới chân */
            box-shadow: 0 4px 10px rgba(0, 242, 254, 0.1);
        }

        /* Tùy biến nút Menu Thu Nhỏ khi xem trên Điện thoại (Toggle Button) */
        .navbar-tech .navbar-toggler {
            border-color: #334155 !important;
            background-color: #0f172a;
            padding: 6px 10px;
        }
        /* Thay đổi màu biểu tượng 3 dấu gạch thành màu Cyan số hóa */
        .navbar-tech .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(0, 242, 254, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E") !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-tech">
    <div class="container"> <!-- Thêm container để đẩy menu gọn vào giữa giống các view nội dung -->
        <a class="navbar-brand" href="#">Quản lý sản phẩm</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto"> <!-- Thêm ml-auto để đẩy menu sang bên phải nhìn thoáng và hiện đại hơn -->
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/">Danh sách sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/webbanhang/Product/add">Thêm sản phẩm</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <!-- Nội dung của các view (List, Add, Edit, Detail) sẽ được chèn vào đây -->