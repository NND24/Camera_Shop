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

Giải thích chi tiết

- ## Thẻ `<script></script>`

Dùng để chứa các câu lệnh javascript.

- ## `$(document).ready(() => {...}`

Là bộ quản lý sự kiện cơ bản của Jquery. Hiểu nôm na thì nó cũng là 1 sự kiện trong jquery, `$(document).ready(() => {...}` kích hoạt sự kiện ngay khi DOM Tree được load và trước khi toàn bộ nội dung của trang được load. Vì javascript sẽ chạy biên dịch từ trên xuống dưới và từ trái qua phải. Chính vì vậy khi bạn sử dụng một hàm mà phía trên nó không tồn tại hàm đó thì sẽ bị báo lỗi undefined.
Tức là sự kiện này có ý nghĩa rằng khi trình duyệt đã load xong mọi thứ (image, js, css) thì những đoạn code nằm bên trong `{...}` mới được chạy.

- ## `$(".list-gallery").click(() => {...}`:

`$` : dấu `$` là ký hiệu để ta khai báo sử dụng Jquery selector : chính là các thành phần mình chọn trên trang web. Mình có thể chọn theo id, class, hay tên thẻ. Dấu "." đại diện cho class, dấu "#" đại diện cho id

Ở đây `$(".list-gallery")` có nghĩa là chọn/tìm một phần tử có class tên là list-gallery để thực hiện thao tác.

`click(() => {...}` là một sự kiện trong javascript nó sẽ bắt lấy sự kiện click xuống chuột trái để thực thi những câu lệnh bên trong `{...}`

`() => {...}` là một arrow function ngoài ra còn một số cách viết function khác thì tự tìm hiểu đi

Toàn bộ `$(".list-gallery").click(() => {...}` có nghĩa là tìm một phần tử có class `list-gallery ` bằng sự kiện click chuột trái vào phần tử đó thì nó sẽ thực thi đoạn code bên trong `{...}`.

Để kiểm tra có click đúng vào phần tử mình cần hãy sử dụng `console.log()`.
VD: Muốn biết được mình đã click được vào phần tử có class `list-gallery ` chưa chỉ cần:

```
$(".list-gallery").click(() => {
    console.log('1')
}
```

- ## `const url = "category.php";`
  Dòng lệnh này sẽ khai báo 1 biến const (dùng var hay let cũng được) có tên là url chứa nội dung `category.php`. Ở đây url sẽ chứa tên file mà mình muốn truy cập
- ## `window.history.pushState("", "", url);`
  Phương thức `window.history.pushState()` sẽ cho phép adds an entry to the browser's session history stack.
  [Đọc thêm về history.pushState](https://www.javascripttutorial.net/web-apis/javascript-history-pushstate/#:~:text=The%20history.pushState%20%28%29%20method%20allows%20you%20to%20add,%28css%29%20The%20pushState%20%28%29%20method%20accepts%20three%20parameters%3A);

Đại khái là khi click vào phần tử có class `list-gallery ` thì thanh url của trình duyệt sẽ được chỉnh sửa thành `.../category.php`. Sau đó nếu khi load lại trang thì nội dung trang web cũng sẽ được tải lại đúng như những gì có trên thanh url. Tức sau khi click và load lại trang thì nội dung sẽ được thanh đổi thành nội dung của file `category.php`

- ## `$("#main").load("category.php");`
  Vì ở trên đã có thể thay đổi thanh url nhưng muốn hiện nội dung thì yêu cầu phải load lại trang. Để tránh việc đó chúng ta sử dụng phương thức `load()`

Phương phương thức `load()` là cách đơn giản nhất để lấy dữ liệu từ server. Nó gần tương đương với `$.get(url, data, success)` ngoại trừ việc nó là một phương thức chứ không phải hàm toàn cục và nó có chức năng gọi lại ngầm định. Khi phát hiện phản hồi thành công (tức là khi textStatus là "success" hoặc "notmodified"), .load() đặt nội dung HTML của các thành phần phù hợp thành dữ liệu được trả về.

Tức là khi click vào phần tử có class `list-gallery ` thì `$` sẽ đi tìm phần tử có `id` là `main` sau đó sẽ truyền dữ liệu dưới dạng HTML từ file `category.php` vào `main`. Hay biến đổi file đang hiện có trở thành file `category.php`
