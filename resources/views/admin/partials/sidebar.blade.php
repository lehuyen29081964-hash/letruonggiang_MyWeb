<div class="sidebar bg-dark p-3">
    <h5 class="text-white mb-3">Menu</h5>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link text-white">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="nav-link text-white">Danh mục</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.brands.index') }}" class="nav-link text-white">Thương hiệu</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.products.index') }}" class="nav-link text-white">Sản phẩm</a>
        </li>
    </ul>
</div>
