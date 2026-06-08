<?php include 'app/views/shares/header.php'; ?>
<h1>Sửa sản phẩm</h1>
<form id="edit-product-form">
    <input type="hidden" id="id" name="id">
    <div class="form-group">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id" class="form-control" required>
            </select>
    </div>
    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
</form>
<a href="/webbanhang/Product/list" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm</a>
<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Lấy productId từ URL (Ví dụ URL: /Product/edit/5 hoặc /Product/edit?id=5)
    // Cách này tự động tìm ID số ở cuối thanh URL hoặc trong query string
    const pathParts = window.location.pathname.split('/');
    let productId = pathParts[pathParts.length - 1]; // Lấy phần tử cuối cùng của URL
    
    // Dự phòng nếu URL dạng query string: ?id=5
    if (isNaN(productId) || !productId) {
        const urlParams = new URLSearchParams(window.location.search);
        productId = urlParams.get('id');
    }

    if (!productId) {
        alert("Không tìm thấy ID sản phẩm!");
        return;
    }

    // 2. Tải danh sách danh mục trước
    fetch('/webbanhang/api/category')
        .then(response => response.json())
        .then(categories => {
            const categorySelect = document.getElementById('category_id');
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.id;
                option.textContent = category.name;
                categorySelect.appendChild(option);
            });

            // 3. CHỈ fetch sản phẩm SAU KHI danh mục đã được load xong vào DOM
            return fetch(`/webbanhang/api/product/${productId}`);
        })
        .then(response => response.json())
        .then(product => {
            // Đẩy dữ liệu vào form
            document.getElementById('id').value = product.id;
            document.getElementById('name').value = product.name;
            document.getElementById('description').value = product.description;
            document.getElementById('price').value = product.price;
            document.getElementById('category_id').value = product.category_id; // Chạy ở đây sẽ không bị lỗi hiển thị
        })
        .catch(error => console.error('Lỗi khi tải dữ liệu:', error));

    // 4. Xử lý sự kiện Submit Form (Giữ nguyên logic của bạn nhưng tối ưu hóa)
    document.getElementById('edit-product-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const jsonData = Object.fromEntries(formData.entries()); // Cách viết ngắn gọn để chuyển FormData thành Object

        fetch(`/webbanhang/api/product/${jsonData.id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Product updated successfully' || data.status === true) {
                alert('Cập nhật sản phẩm thành công!');
                location.href = '/webbanhang/Product';
            } else {
                alert('Cập nhật sản phẩm thất bại');
            }
        })
        .catch(error => alert('Có lỗi xảy ra khi cập nhật'));
    });
});
</script>