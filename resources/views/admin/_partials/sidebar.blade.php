<div class="p-3">
    <h4>
        <i class="bi bi-speedometer2"></i>
        Admin
    </h4>

    <ul class="nav flex-column mt-3">
        <li class="nav-item">
            <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house-door"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white" data-bs-toggle="collapse" href="#manageMenu">
                <i class="bi bi-gear"></i>
                Quản lý
            </a>

            <div class="collapse show" id="manageMenu">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.categories.index') }}">
                            Loại sản phẩm
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.brands.index') }}">
                            Thương hiệu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin.products.index') }}">
                            Sản phẩm
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>