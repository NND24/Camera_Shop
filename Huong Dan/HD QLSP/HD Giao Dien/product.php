<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <?php include('link.php'); ?>
</head>

<body>

    <div class="app-container">
        <div class="main" id="main">
            <?php include('menu.php') ?>

            <div class="app-content">
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Sản phẩm</h1>
                    <button class="mode-switch" title="Switch Theme">
                        <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                            <defs></defs>
                            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                        </svg>
                    </button>
                    <button class="app-content-headerButton add-new-product-btn add-product">Thêm sản phẩm</button>
                </div>

                <div class="app-content-actions">
                    <input class="search-bar" placeholder="Search..." type="text">
                    <div class="app-content-actions-wrapper">
                        <div class="filter-button-wrapper">
                            <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu d-flex wrap" style="
    width: 400px;
    flex-wrap: wrap;">
                                <div class=" col-6 " style="padding-right: 10px;">
                                    <label>Trạng thái</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả trạng thái</option>
                                        <option value="1">Kích hoạt</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Tên </label>
                                    <select class="filter_name">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6" style="padding-right: 10px;">
                                    <label>Giá </label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Số lượng</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6" style="padding-right: 10px;">
                                    <label>Giảm giá</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label>Đã bán</label>
                                    <select class="filter_status">
                                        <option value="2">Tất cả</option>
                                        <option value="1">Tăng dần</option>
                                        <option value="0">Giảm dần</option>
                                    </select>
                                </div>

                                <div class="filter-menu-buttons">
                                    <button class="filter-button reset">
                                        Reset
                                    </button>
                                    <button class="filter-button apply">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-product">Xóa tất cả sản phẩm</button>
                        </div>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-2-4 image">
                            Sản phẩm
                            <button class="sort-button">
                            </button>
                        </div>
                        <div class="product-cell col-1-8 category">Danh mục<button class="sort-button">
                            </button></div>
                        <div class="product-cell col-1-5 status-cell">Trạng thái<button class="sort-button">
                            </button></div>
                        <div class="product-cell col-2 sales">Ngày tạo<button class="sort-button">
                            </button></div>
                        <div class="product-cell col-2 stock">Ngày cập nhật<button class="sort-button">
                            </button></div>
                        <div class="product-cell col-1-8 price">Chi tiết</div>
                        <div class="product-cell col price">Xóa</div>
                        <div class="product-cell col price">Sửa</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>