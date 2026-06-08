<?php include 'app/views/shares/header.php'; ?>

<h1>Danh sách danh mục</h1>
<a href="/webbanhang/Category/add" class="btn btn-success mb-2">Thêm danh mục mới</a>
<a href="/webbanhang/Product" class="btn btn-secondary mb-2">Quản lý sản phẩm</a>

<ul class="list-group" id="category-list">
    </ul>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Gọi API lấy danh sách danh mục
    fetch('/webbanhang/api/category')
        .then(response => response.json())
        .then(data => {
            const categoryList = document.getElementById('category-list');
            categoryList.innerHTML = ''; // Xóa sạch nội dung cũ nếu có

            if(data.length === 0) {
                categoryList.innerHTML = '<li class="list-group-item text-muted">Chưa có danh mục nào.</li>';
                return;
            }

            data.forEach(category => {
                const categoryItem = document.createElement('li');
                categoryItem.className = 'list-group-item';
                categoryItem.innerHTML = `
                    <h2>${category.name}</h2>
                    <p>${category.description ? category.description : '<em class="text-muted">Không có mô tả</em>'}</p>
                    
                    <a href="/webbanhang/Category/edit/${category.id}" class="btn btn-warning">Sửa</a>
                    <button class="btn btn-danger" onclick="deleteCategory(${category.id})">Xóa</button>
                `;
                categoryList.appendChild(categoryItem);
            });
        })
        .catch(error => {
            console.error('Lỗi khi tải danh mục:', error);
        });
});

// Hàm xử lý xóa danh mục
function deleteCategory(id) {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này?')) {
        // Gọi đến API xóa của CategoryApiController
        fetch(`/webbanhang/api/category/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            // Kiểm tra kết quả phản hồi dựa theo chuỗi thông báo từ Controller của bạn
            if (data.message === 'Xóa danh mục thành công.') {
                location.reload(); // Tải lại trang để cập nhật giao diện
            } else {
                alert(data.message || 'Xóa danh mục thất bại');
            }
        })
        .catch(error => {
            console.error('Lỗi khi xóa:', error);
            alert('Có lỗi xảy ra trong quá trình xóa!');
        });
    }
}
</script>