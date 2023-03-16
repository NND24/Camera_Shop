<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý danh mục</title>
    <?php include('../link.php'); ?>
</head>

<body>

    <div class="app-container">
        <div class="main" id="main">
            <?php include('menu.php') ?>
            <div class="app-content">
                <div class="app-content-header">
                    <h1 class="app-content-headerText">Danh mục</h1>
                    <button class="mode-switch" title="Switch Theme">
                        <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                            <defs></defs>
                            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                        </svg>
                    </button>
                    <button class="app-content-headerButton add-new-category-btn">
                        Thêm danh mục
                    </button>

                </div>

                <div class="app-content-actions">
                    <div class="app-content-actions-wrapper" style="margin:0;">
                        <input class="search-bar" placeholder="Search..." type="text">
                    </div>
                    <div class="app-content-actions-wrapper">
                        <div class="filter-button-wrapper">
                            <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg></button>
                            <div class="filter-menu">
                                <label>Trạng thái</label>
                                <select class="filter_status">
                                    <option value="3">Tất cả trạng thái</option>
                                    <option value="1">Kích hoạt</option>
                                    <option value="0">Ẩn</option>
                                </select>
                                <label>Thời gian</label>
                                <select class="filter_status">
                                    <input type="date">
                                    <input type="date">
                                </select>
                                <div class="filter-menu-buttons">
                                    <button type="reset" class="filter-button reset">
                                        Reset
                                    </button>
                                    <button class="filter-button apply">
                                        Apply
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="filter-button-wrapper">
                            <button class="action-button delete-all-category">Xóa tất cả danh mục</button>
                        </div>
                    </div>
                </div>

                <div class="products-area-wrapper tableView">
                    <div class="products-header">
                        <div class="product-cell col-1-5 image">Thứ tự</div>
                        <div class="product-cell col-2 category">Tên danh mục</div>
                        <div class="product-cell col status-cell">Trạng thái</div>
                        <div class="product-cell col sales">Ngày tạo</div>
                        <div class="product-cell col stock">Ngày cập nhật</div>
                        <div class="product-cell col-1-8 price">Chi tiết</div>
                        <div class="product-cell col-1 price">Xóa</div>
                        <div class="product-cell col-1 price">Sửa</div>
                    </div>
                    <div id="load_category_data">
                        <div class="products-row">
                            <button class="cell-more-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical">
                                    <circle cx="12" cy="12" r="1" />
                                    <circle cx="12" cy="5" r="1" />
                                    <circle cx="12" cy="19" r="1" />
                                </svg>
                            </button>
                            <div class="product-cell col-1-5 thutu-danhmuc ">
                                <p>1</p>
                            </div>
                            <div class="product-cell col-2 category ">
                                <p>Camera Yoosee</p>
                            </div>
                            <div class="product-cell col status-cell">
                                <span class="status">Ẩn</span>
                            </div>
                            <div class="product-cell col sales">16/03/2023 15:46</div>
                            <div class="product-cell col stock">16/03/2023 15:46</div>
                            <div class="product-cell col-1-8 detail">
                                <button title="Xem chi tiết" class="detail-category" value=""><span>Xem
                                        chi tiết</span></button>
                            </div>
                            <div class="product-cell col-1 btn">
                                <button title="Xóa" class="remove-category" value=""><i class="fa-solid fa-trash"></i></button>
                            </div>
                            <div class="product-cell col-1 btn">
                                <button title="Sửa" class="edit-category" value=""><i class="fa-regular fa-pen-to-square"></i></button>
                            </div>
                        </div>

                        <div class="pagination__wrapper ">
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>