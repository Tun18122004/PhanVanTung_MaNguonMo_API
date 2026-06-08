<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fa-solid fa-pen-to-square"></i> Chỉnh Sửa Danh Mục</h4>
        </div>
        <div class="card-body">
            <form id="edit-category-form">
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Tên danh mục <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" placeholder="Đang tải dữ liệu..." required>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Mô tả danh mục</label>
                    <textarea id="description" class="form-control" rows="4" placeholder="Đang tải dữ liệu..."></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="/webbanhang/category" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary" id="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Tự động bóc tách ID danh mục từ URL (Ví dụ: /webbanhang/Category/edit/5)
    const urlParts = window.location.pathname.split('/');
    const categoryId = urlParts[urlParts.length - 1]; 

    if (!categoryId || isNaN(categoryId)) {
        alert('ID danh mục không hợp lệ!');
        window.location.href = '/webbanhang/category';
        return;
    }

    // 2. Lấy dữ liệu cũ của danh mục từ API đổ vào form
    // Lưu ý: Endpoint này sẽ gọi trúng hàm index() trong ApiController nếu truyền không đúng,
    // hãy đảm bảo CategoryApiController của bạn hỗ trợ lấy 1 item hoặc bạn dựa vào danh sách tổng để lọc.
    fetch('/webbanhang/api/category')
        .then(response => response.json())
        .then(categories => {
            // Tìm danh mục cụ thể có ID trùng khớp trong danh sách trả về
            const currentCategory = categories.find(cat => cat.id == categoryId);

            if (currentCategory) {
                document.getElementById('name').value = currentCategory.name;
                document.getElementById('description').value = currentCategory.description || '';
            } else {
                alert('Không tìm thấy dữ liệu danh mục cần sửa!');
                window.location.href = '/webbanhang/category';
            }
        })
        .catch(error => {
            console.error('Lỗi khi tải dữ liệu cũ:', error);
            alert('Không thể kết nối tới máy chủ để lấy dữ liệu!');
        });

    // 3. Xử lý sự kiện SUBMIT Form để cập nhật dữ liệu (Gửi request PUT)
    document.getElementById('edit-category-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Chặn reload trang mặc định

        const btnSave = document.getElementById('btn-save');
        btnSave.disabled = true; // Khóa nút tránh nhấn nhiều lần

        const updatedData = {
            name: document.getElementById('name').value.trim(),
            description: document.getElementById('description').value.trim()
        };

        // Gọi API PUT theo đúng cấu trúc Router quy định: /api/category/{id}
        fetch(`/webbanhang/api/category/${categoryId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(updatedData)
        })
        .then(response => response.json())
        .then(data => {
            // Kiểm tra phản hồi thành công từ CategoryApiController
            if (data.message === "Cập nhật danh mục thành công.") {
                alert(data.message);
                window.location.href = '/webbanhang/category'; // Chuyển hướng về trang danh sách
            } else {
                alert(data.message || 'Cập nhật thất bại hoặc dữ liệu không có thay đổi.');
                btnSave.disabled = false;
            }
        })
        .catch(error => {
            console.error('Lỗi khi cập nhật:', error);
            alert('Đã xảy ra lỗi hệ thống!');
            btnSave.disabled = false;
        });
    });
});
</script>