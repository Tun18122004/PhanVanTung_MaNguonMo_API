<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
    /* Đồng bộ nền tối toàn trang cho hệ thống */
    body {
        background-color: #0f172a;
        /* Slate 900 */
        color: #e2e8f0;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* Tùy biến thanh Navbar thành bo mạch công nghệ phẳng */
    .navbar-tech {
        background-color: #1e293b !important;
        /* Slate 800 */
        border-bottom: 2px solid #334155;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        padding: 15px 20px;
    }

    /* Logo / Tên thương hiệu hiệu ứng phát sáng */
    .navbar-tech .navbar-brand {
        color: #00f2fe !important;
        /* Xanh neon */
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
        color: #94a3b8 !important;
        /* Màu xám nhẹ mặc định */
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 8px 16px !important;
        border-radius: 6px;
        transition: all 0.3s ease;
        margin-right: 5px;
        display: flex;
        align-items: center;
    }

    /* Hiệu ứng khi di chuột qua các mục menu */
    .navbar-tech .nav-link:hover {
        color: #ffffff !important;
        background-color: #0f172a;
        /* Nền tối sâu hơn */
        box-shadow: 0 4px 10px rgba(0, 242, 254, 0.1);
    }

    /* Riêng các link thường không phải giỏ hàng khi hover sẽ có border chân */
    .navbar-tech .nav-item:not(.nav-cart) .nav-link:hover {
        border-bottom: 2px solid #00f2fe;
        /* Vạch neon dưới chân */
    }

    /* 🛒 KHỐI GIỎ HÀNG CÔNG NGHỆ (Không dùng icon) */
    .navbar-tech .nav-cart .nav-link {
        border: 1px solid #334155;
        background-color: #0f172a;
        border-radius: 8px;
        padding: 8px 14px !important;
    }

    .navbar-tech .nav-cart .nav-link:hover {
        border-color: #00f2fe;
        box-shadow: 0 0 12px rgba(0, 242, 254, 0.3);
    }

    /* Label chữ "Giỏ hàng" */
    .cart-text {
        margin-right: 8px;
    }

    /* Badge hiển thị số lượng linh kiện/sản phẩm */
    .cart-badge {
        background: linear-gradient(135deg, #00b4db, #0083b0);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
        min-width: 22px;
        text-align: center;
        box-shadow: 0 0 8px rgba(0, 180, 219, 0.5);
        display: inline-block;
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

    <?php
// Giả lập tính tổng số lượng sản phẩm trong giỏ hàng để hiển thị
$cartCount = 0;
if (!empty($cart)) {
    foreach ($cart as $item) {
        $cartCount += $item['quantity'];
    }
} else if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
}
?>

    <nav class="navbar navbar-expand-lg navbar-tech">
        <div class="container">
            <a class="navbar-brand" href="#">Quản lý sản phẩm</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/">Danh sách sản phẩm</a>
                    </li>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/account/">Quản lý tài khoản</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/add">Thêm sản phẩm</a>
                    </li>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product/listOrder">Đơn mua</a>
                    </li>
                    <li class="nav-item nav-cart">
                        <a class="nav-link" href="/webbanhang/Product/cart">
                            <span class="cart-text">Giỏ hàng</span>
                            <span class="cart-badge"><?php echo $cartCount; ?></span>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <?php
                            if(SessionHelper::isLoggedIn()){
                            echo "<a class='nav-link'>".$_SESSION['username']."</a>";
                            }
                            else{
                            echo "<a class='nav-link'
                            href='/webbanhang/account/login'>Login</a>";
                            }
                            ?>
                                                </li>
                                                <li class="nav-item">
                                                    </a>
                                                    <?php
                            if(SessionHelper::isLoggedIn()){
                            echo "<a class='nav-link'
                            href='/webbanhang/account/logout'>Logout</a>";
                            }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>