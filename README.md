# Rating Comment and Star Module for Joomla

## Giới thiệu
**Rating Comment and Star Module for Joomla** là một module mạnh mẽ giúp người dùng có thể cho khách hàng đánh giá và bình luận về các sản phẩm trên trang web Joomla của mình. Module này cho phép bạn:
- Cho khách hàng đánh giá sản phẩm khi đã đăng nhập vào web mà chưa cần phải mua hàng.
- Đánh giá nhanh chóng , tiện lợi.

## Tính năng chính
- **Lưu đánh giá khách hàng**: Một cú nhấp chuột để khách hàng có thể đánh giá và module sẽ tổng hợp vào một table trong database.
- **Hiển thị số lượt đánh giá và bình luận**: Cho biết số lượt khách hàng đã đánh giá sản phẩm.
- **Hiển thị số điểm đánh giá trung bình và các bình luận**: Module tự động cập nhật các lượt đánh giá và hiển thị giá trị sao trung bình của chúng, hiển thị các lượt bình luận liên quan đến sản phẩm.

## Yêu cầu hệ thống
- **Joomla phiên bản**: 4.0 trở lên.
- **PHP phiên bản**: Tương thích với phiên bản PHP được hỗ trợ bởi Joomla 4.0.

## Hướng dẫn cài đặt
1. Tải module từ kho lưu trữ hoặc nguồn cung cấp.
2. Giải nén file .zip đã tải, di chuyển thư mục ajax có trong file đến thư mục plugin trong project Joomla của bạn.
3. Đăng nhập vào trang quản trị Joomla của bạn.
4. Truy cập **System** > **Extensions** > **Upload Package File**.
5. Tải tệp `rating_comment.zip` trong thư mục ajax và nhấp **Upload & Install**.
6. Sau khi cài đặt thành công, plugin sẽ xuất hiện trong danh sách plugin của bạn, giờ bạn hãy enable plugin vừa load lên.
7. Truy cập **Extensions** > **Manage** > **Install**.
8. Tải tệp `.zip` của module và nhấp **Upload & Install**.
9. Sau khi cài đặt thành công, module sẽ xuất hiện trong danh sách module của bạn.
10. Truy cập vào trang phpMyAdmin của bạn.
11. Chọn database bạn đang liên kết mới trang Joomla.
12. Chọn SQL, tạo lần lượt hai bảng dựa trên đoạn mã của hai file .txt trong thư mục DB, lưu ý thay #_ bằng prefix của bạn.

## Hướng dẫn sử dụng
1. Truy cập **System** > **Manage** > **Site Modules**.
2. Tìm kiếm module "mod_rating_comment" và nhấp vào để cấu hình.
3. **Cấu hình các thông tin cần thiết**:
   - **Vị trí hiển thị**: Chọn vị trí hiển thị module trên trang web.
4. Lưu lại cấu hình và kiểm tra giao diện người dùng trên trang chính.

## Đóng góp
Chúng tôi hoan nghênh mọi đóng góp từ cộng đồng để cải thiện module:
- Báo cáo lỗi hoặc đề xuất tính năng mới bằng cách tạo [Issue](https://github.com/lenhan1122/mod_rating_comment/issues).
- Gửi yêu cầu kéo (Pull Request) nếu bạn muốn đóng góp mã nguồn.
- Tham gia thảo luận và góp ý tại mục [Discussions](https://github.com/lenhan1122/mod_rating_comment/discussions).

## Liên hệ
Nếu bạn có bất kỳ câu hỏi hoặc cần hỗ trợ, vui lòng liên hệ qua:
- **Email**: nhath6298@gmail.com hoặc lenhan21112004@gmail.com

---

Cảm ơn bạn đã sử dụng **Rating Comment and Star Module for Joomla**!