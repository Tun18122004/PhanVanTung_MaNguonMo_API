<?php include 'app/views/shares/header.php'; ?>

<style>
/* Tổng thể khu vực Giỏ hàng mang phong cách Hi-Tech Dark Mode */
.tech-cart-container {
    background-color: #0f172a;
    /* Nền tối chuẩn công nghệ (Slate 900) */
    color: #e2e8f0;
    padding: 40px;
    border-radius: 16px;
    margin-top: 20px;
    margin-bottom: 30px;
    max-width: 800px;
    /* Tăng nhẹ độ rộng để hiển thị danh sách giỏ hàng đẹp hơn */
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

/* Khối danh sách sản phẩm */
.cart-list {
    list-style: none;
    padding: 0;
    margin: 0 0 30px 0;
}

/* Từng item trong giỏ hàng biến thành một khối vi mạch */
.cart-item {
    background-color: #1e293b;
    /* Nền ô tối */
    border: 1px solid #334155;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 20px;
    transition: all 0.3s ease;
}

.cart-item:hover {
    border-color: #00f2fe;
    box-shadow: 0 0 15px rgba(0, 242, 254, 0.15);
}

/* Thẻ hình ảnh sản phẩm số hóa */
.cart-img-wrapper {
    border: 2px solid #334155;
    border-radius: 8px;
    overflow: hidden;
    background: #0f172a;
    width: 100px;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.cart-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

/* Thông tin chi tiết của sản phẩm bên trong item */
.cart-details {
    flex-grow: 1;
}

.cart-item-title {
    color: #38bdf8;
    /* Màu xanh Cyan năng lượng */
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0 0 8px 0;
}

.cart-item-info {
    font-size: 0.95rem;
    margin: 4px 0;
    color: #cbd5e1;
}

.cart-item-info strong {
    color: #ffffff;
}

/* Bộ tăng giảm số lượng Hi-tech */
.quantity-control {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 10px;
}

.btn-qty {
    background: #334155;
    border: 1px solid #475569;
    color: #ffffff;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
}

.btn-qty:hover {
    background: #00f2fe;
    color: #0f172a;
    border-color: #00f2fe;
    box-shadow: 0 0 8px rgba(0, 242, 254, 0.5);
}

.input-qty {
    background: #0f172a;
    border: 1px solid #334155;
    color: #00f2fe;
    width: 50px;
    text-align: center;
    height: 32px;
    border-radius: 6px;
    font-weight: 600;
    outline: none;
}

/* Ẩn mũi tên tăng giảm mặc định của input type number */
.input-qty::-webkit-outer-spin-button,
.input-qty::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Khối hiển thị tổng tiền của giỏ hàng */
.cart-total-panel {
    background: padding-box rgba(30, 41, 59, 0.5);
    border: 1px solid #334155;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.total-title {
    font-size: 1.1rem;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.total-value {
    font-size: 1.5rem;
    color: #00f2fe;
    font-weight: 700;
    text-shadow: 0 0 10px rgba(0, 242, 254, 0.3);
}

/* Trạng thái giỏ hàng trống */
.cart-empty {
    text-align: center;
    padding: 40px 20px;
    color: #94a3b8;
    font-size: 1.1rem;
    border: 1px dashed #334155;
    border-radius: 12px;
    margin-bottom: 30px;
}

/* Nhóm nút bấm hành động */
.cart-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

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
    text-align: center;
    text-decoration: none;
}

/* Nút Thanh toán (Primary) */
.btn-checkout-tech {
    background: linear-gradient(135deg, #00b4db, #0083b0) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: 0 4px 15px rgba(0, 180, 219, 0.3);
    cursor: pointer;
}

.btn-checkout-tech:hover {
    box-shadow: 0 6px 20px rgba(0, 180, 219, 0.5);
    transform: translateY(-2px);
}

/* Nút Tiếp tục mua sắm (Secondary) */
.btn-shop-tech {
    background: transparent !important;
    color: #94a3b8 !important;
    border: 1px solid #475569 !important;
}

.btn-shop-tech:hover {
    background: #475569 !important;
    color: #ffffff !important;
}
</style>

<?php
// ==========================================
// 1. XỬ LÝ BACKEND (Cập nhật Session qua AJAX)
// ==========================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra xem có phải là request AJAX gửi lên để cập nhật giỏ hàng không
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_cart') {
    header('Content-Type: application/json');
    
    $productId = $_POST['id'] ?? '';
    $quantity = (int)($_POST['quantity'] ?? 1);

    if ($quantity < 1 || empty($productId)) {
        echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
        exit;
    }

    // Giả lập hoặc cập nhật trực tiếp vào mảng $cart trong Session của bạn
    // Thay 'cart' bằng tên biến Session chứa giỏ hàng thực tế của bạn nếu nó khác
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]['quantity'] = $quantity;
    }

    // Tính toán lại tổng tiền tổng dựa trên session mới
    $newGrandTotal = 0;
    // Lưu ý: Đoạn này tính dựa trên mảng giỏ hàng lưu ở SESSION toàn cục
    $cartData = $_SESSION['cart'] ?? []; 
    foreach ($cartData as $item) {
        $newGrandTotal += (float)$item['price'] * (int)$item['quantity'];
    }

    // Lưu lại tổng tiền mới vào Session để dùng ở các file khác (Thanh toán, v.v.)
    $_SESSION['checkout_total'] = $newGrandTotal;

    // Trả kết quả về cho JavaScript
    echo json_encode([
        'success' => true,
        'new_grand_total' => $newGrandTotal
    ]);
    exit; // Dừng chương trình tại đây, không cho chạy xuống phần HTML bên dưới
}

// ==========================================
// 2. CHUẨN BỊ DỮ LIỆU HIỂN THỊ
// ==========================================
// Lấy dữ liệu giỏ hàng (Ưu tiên lấy từ Session để đồng bộ)
$cart = $_SESSION['cart'] ?? []; 
$grandTotal = 0;
?>

<div class="tech-cart-container">
    <h1 class="tech-title">Giỏ hàng</h1>

    <?php if (!empty($cart)): ?>
    <ul class="cart-list">
        <?php
        foreach ($cart as $id => $item): 
            $itemPrice = (float)$item['price'];
            $itemQty = (int)$item['quantity'];
            $subTotal = $itemPrice * $itemQty;
            $grandTotal += $subTotal; // Cộng dồn tổng tiền
        ?>
        <li class="cart-item" data-id="<?= $id; ?>" data-price="<?= $itemPrice; ?>">
            <?php if (!empty($item['image'])): ?>
            <div class="cart-img-wrapper">
                <img src="/webbanhang/<?= $item['image']; ?>" alt="Product Image" class="cart-img">
            </div>
            <?php endif; ?>

            <div class="cart-details">
                <h2 class="cart-item-title"><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="cart-item-info">Giá: <strong><?= number_format($itemPrice, 0, ',', '.'); ?> VND</strong></p>

                <div class="quantity-control">
                    <span class="cart-item-info">Số lượng:</span>
                    <button type="button" class="btn-qty btn-minus">-</button>
                    <input type="number" class="input-qty" value="<?= $itemQty; ?>" min="1" readonly>
                    <button type="button" class="btn-qty btn-plus">+</button>
                </div>

                <p class="cart-item-info" style="margin-top: 10px;">
                    Thành tiền: <strong class="subtotal-text" style="color: #00f2fe;"><?= number_format($subTotal, 0, ',', '.'); ?> VND</strong>
                </p>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>

    <?php 
    // Đồng bộ lại tổng tiền vào Session ngay khi load trang lần đầu
    $_SESSION['checkout_total'] = $grandTotal; 
    ?>

    <div class="cart-total-panel" style="margin-top: 20px; font-size: 1.2rem;">
        <span class="total-title">Tổng tiền:</span>
        <span class="total-value"><strong id="grand-total" style="color: #ff5722;"><?= number_format($grandTotal, 0, ',', '.'); ?></strong> VND</span>
    </div>
    
    <?php else: ?>
    <div class="cart-empty">
        <p>Hệ thống trống. Chưa phát hiện dữ liệu sản phẩm trong giỏ hàng của bạn.</p>
    </div>
    <?php endif; ?>

    <div class="cart-actions">
        <?php if (!empty($cart)): ?>
        <a href="/webbanhang/Product/checkout" class="btn-tech btn-checkout-tech">Tiến hành thanh toán</a>
        <?php endif; ?>
        <a href="/webbanhang/Product" class="btn-tech btn-shop-tech">Tiếp tục mua sắm</a>
    </div>
</div>

<script>
document.querySelectorAll('.cart-item').forEach(item => {
    const btnMinus = item.querySelector('.btn-minus');
    const btnPlus = item.querySelector('.btn-plus');
    const inputQty = item.querySelector('.input-qty');
    const subtotalText = item.querySelector('.subtotal-text');
    const id = item.getAttribute('data-id');
    const price = parseFloat(item.getAttribute('data-price'));

    function updateItemSubtotal(qty) {
        // Cập nhật "Thành tiền" tạm thời của sản phẩm trên giao diện
        const newSubtotal = price * qty;
        subtotalText.innerText = newSubtotal.toLocaleString('vi-VN') + ' VND';
        
        // Gửi request lên CHÍNH file này để xử lý Session
        updateCartSession(id, qty);
    }

    btnMinus.addEventListener('click', () => {
        let currentQty = parseInt(inputQty.value);
        if (currentQty > 1) {
            currentQty--;
            inputQty.value = currentQty;
            updateItemSubtotal(currentQty);
        }
    });

    btnPlus.addEventListener('click', () => {
        let currentQty = parseInt(inputQty.value);
        currentQty++;
        inputQty.value = currentQty;
        updateItemSubtotal(currentQty);
    });
});

function updateCartSession(productId, quantity) {
    // window.location.href lấy chính đường dẫn của file hiện tại làm đích gửi dữ liệu
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=update_cart&id=${productId}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Nhận Grand Total chuẩn từ Server trả về sau khi tính toán để hiển thị
            document.getElementById('grand-total').innerText = data.new_grand_total.toLocaleString('vi-VN');
        } else {
            console.error('Lỗi từ hệ thống:', data.message);
        }
    })
    .catch(error => console.error('Lỗi kết nối:', error));
}
</script>

<?php include 'app/views/shares/footer.php'; ?>