# CÁC THAO TÁC VỚI MENU

Hiện tại thì menu mới có 1 phần chính là các tab, để có thể điều hướng, thay đổi nội dung ở phía bên phải cả phần header và content

## Giải thích code

Đây là toàn bộ code của phần menu hiện tại

```
<div class="sidebar">
    <div class="sidebar-header">
        <a href="#">Đăng xuất
        </a>
    </div>

    <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <a class="list-gallery">Quản lý danh mục</a>
        </li>
        <li class="sidebar-list-item ">
            <a class="list-product">Quản lý sản phẩm</a>
        </li>
    </ul>
</div>

<script>
$(document).ready(() => {
    $(".list-gallery").click(() => {
        const url = "category.php";
        window.history.pushState("new", "title", url);
        $("#main").load("category.php");
    });

    $(".list-product").click(() => {
        const url = "product.php";
        window.history.pushState("new", "title", url);
        $("#main").load("product.php");
    });
})
</script>
```

Code gồm 2 phần HTML và Javascript

### 1. HTML

```
<div class="sidebar">
    <div class="sidebar-header">
        <a href="#">Đăng xuất
        </a>
    </div>

    <ul class="sidebar-list">
        <li class="sidebar-list-item">
            <a class="list-gallery">Quản lý danh mục</a>
        </li>
        <li class="sidebar-list-item ">
            <a class="list-product">Quản lý sản phẩm</a>
        </li>
    </ul>
</div>
```

Chả biết nói cái gì chắc nhìn là đủ hiểu rồi

### 2. Javascript

```
<script>
$(document).ready(() => {
    $(".list-gallery").click(() => {
        const url = "category.php";
        window.history.pushState("new", "title", url);
        $("#main").load("category.php");
    });

    $(".list-product").click(() => {
        const url = "product.php";
        window.history.pushState("new", "title", url);
        $("#main").load("product.php");
    });
})
</script>
```

- Ở đấy t dùng jQuery để viết javascript. jQuery là thư viện được viết từ JavaScript, jQuery giúp xây dựng các chức năng bằng Javascript dễ dàng, nhanh và giàu tính năng hơn.
  jQuery được tích hợp nhiều module khác nhau. Từ module hiệu ứng cho đến module truy vấn selector. jQuery được sử dụng đến 99% trên tổng số website trên thế giới. Vậy các module chính của jQuery là gì?

Các module phổ biến của jQuery bao gồm:

- Ajax – xử lý Ajax
- Atributes – Xử lý các thuộc tính của đối tượng HTML
- Effect – xử lý hiệu ứng
- Event – xử lý sự kiện
- Form – xử lý sự kiện liên quan tới form
- DOM – xử lý Data Object Model
- Selector – xử lý luồng lách giữa các đối tượng HTML

Giải thích chi tiết

- Thẻ `<script></script>` dùng để chứa các câu lệnh javascript.

- `$(document).ready(() => {...}` là bộ quản lý sự kiện cơ bản của Jquery. Hiểu nôm na thì nó cũng là 1 sự kiện trong jquery, `$(document).ready(() => {...}` kích hoạt sự kiện ngay khi DOM Tree được load và trước khi toàn bộ nội dung của trang được load. Vì javascript sẽ chạy biên dịch từ trên xuống dưới và từ trái qua phải. Chính vì vậy khi bạn sử dụng một hàm mà phía trên nó không tồn tại hàm đó thì sẽ bị báo lỗi undefined.
  Tức là sự kiện này có ý nghĩa rằng khi trình duyệt đã load xong mọi thứ (image, js, css) thì những đoạn code nằm bên trong `{...}` mới được chạy.

- `$(".list-gallery").click(() => {...}`:

`$` : dấu `$` là ký hiệu để ta khai báo sử dụng Jquery selector : chính là các thành phần mình chọn trên trang web. Mình có thể chọn theo id, class, hay tên thẻ. Dấu "." đại diện cho class, dấu "#" đại diện cho id

Ở đây `$(".list-gallery")` có nghĩa là chọn/tìm một phần tử có class tên là list-gallery để thực hiện thao tác.

`click(() => {...}` là một sự kiện trong javascript nó sẽ bắt lấy sự kiện click xuống chuột trái để thực thi những câu lệnh bên trong `{...}`

`() => {...}` là một arrow function ngoài ra còn một số cách viết function khác thì tự tìm hiểu đi

Toàn bộ `$(".list-gallery").click(() => {...}` có nghĩa là tìm một phần tử có class `list-gallery ` bằng sự kiện click chuột trái vào phần tử đó thì nó sẽ thực thi đoạn code bên trong `{...}`.
