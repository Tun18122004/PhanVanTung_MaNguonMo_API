<!-- Thẻ style chứa giao diện footer phong cách công nghệ -->
<style>
    /* Tổng thể chân trang mang phong cách Hi-Tech Dark Mode */
    .tech-footer {
        background-color: #1e293b !important; /* Slate 800 đồng bộ với Header */
        color: #94a3b8 !important; /* Chữ xám nhẹ dễ đọc */
        border-top: 2px solid #334155;
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    /* Các tiêu đề trong footer (Quản lý sản phẩm, Liên kết nhanh...) */
    .tech-footer h5 {
        color: #00f2fe !important; /* Màu xanh neon công nghệ */
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 1px;
        margin-bottom: 20px;
        text-shadow: 0 0 10px rgba(0, 242, 254, 0.3);
    }

    /* Định dạng văn bản mô tả */
    .tech-footer p {
        font-size: 0.9rem;
        line-height: 1.6;
    }

    /* Các đường link trong phần Liên kết nhanh */
    .tech-footer .tech-link {
        color: #cbd5e1 !important;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        display: inline-block;
        padding: 4px 0;
    }
    .tech-footer .tech-link:hover {
        color: #38bdf8 !important; /* Đổi sang màu Cyan sáng */
        transform: translateX(5px); /* Hiệu ứng nhích nhẹ sang phải khi di chuột */
    }

    /* Các icon Mạng xã hội */
    .tech-footer .tech-social-icon {
        color: #cbd5e1 !important;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        display: inline-block;
    }
    .tech-footer .tech-social-icon:hover {
        color: #00f2fe !important;
        transform: scale(1.2); /* Phóng to nhẹ icon khi hover */
        text-shadow: 0 0 10px rgba(0, 242, 254, 0.6);
    }

    /* Dòng bản quyền (Copyright) sát đáy */
    .tech-copyright {
        background-color: #0f172a !important; /* Slate 900 */
        color: #64748b !important;
        font-size: 0.85rem;
        border-top: 1px solid #334155;
        letter-spacing: 0.5px;
    }
</style>

</div> <!-- Đóng thẻ div class="container mt-4" mở từ file header.php -->

<footer class="tech-footer text-center text-lg-start mt-5">
    <div class="container p-4">
        <div class="row">
            
            <!-- Cột thông tin liên hệ -->
            <div class="col-lg-6 col-md-12 mb-4">
                <h5 class="text-uppercase">Quản lý sản phẩm</h5>
                <p>
                    Hệ thống quản lý sản phẩm giúp bạn theo dõi và cập nhật thông tin
                    sản phẩm dễ dàng.
                </p>
            </div>
            
            <!-- Cột liên kết nhanh -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase">Liên kết nhanh</h5>
                <ul class="list-unstyled mb-0">
                    <li>
                        <a href="/webbanhang/Product/" class="tech-link">Danh sách sản phẩm</a>
                    </li>
                    <li>
                        <a href="/webbanhang/Product/add" class="tech-link">Thêm sản phẩm</a>
                    </li>
                </ul>
            </div>
            
            <!-- Cột mạng xã hội -->
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="text-uppercase">Kết nối với chúng tôi</h5>
                <a href="#" class="tech-social-icon mr-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="tech-social-icon mr-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="tech-social-icon mr-3"><i class="fab fa-instagram"></i></a>
            </div>
            
        </div>
    </div>
    
    <!-- Dòng bản quyền -->
    <div class="text-center p-3 tech-copyright">
        © 2026 Quản lý sản phẩm. All rights reserved.
    </div>
</footer>

<!-- Font Awesome Icons và các Script Bootstrap bổ trợ nếu cần -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>