<?php include 'app/views/shares/header.php'; ?>
<h1>Thêm danh mục mới</h1>
<form id="add-category-form">
    <div class="mb-3">
        <label>Tên danh mục:</label>
        <input type="text" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Mô tả:</label>
        <textarea id="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="/webbanhang/category" class="btn btn-secondary">Hủy</a>
</form>

<script>
document.getElementById('add-category-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const data = {
        name: document.getElementById('name').value,
        description: document.getElementById('description').value
    };

    // Gọi lên API bạn đã viết trước đó
    fetch('/webbanhang/api/category', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(resData => {
        alert(resData.message);
        window.location.href = '/webbanhang/category'; // Chuyển về trang danh sách
    });
});
</script>
<?php include 'app/views/shares/footer.php'; ?>