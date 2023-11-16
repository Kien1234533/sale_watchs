-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 19, 2022 lúc 03:50 PM
-- Phiên bản máy phục vụ: 5.7.31
-- Phiên bản PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `salewatchs`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id_user` int(10) NOT NULL,
  `id_product` int(10) NOT NULL,
  PRIMARY KEY (`id_user`,`id_product`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Đồng hồ đeo tay'),
(2, 'Đồng hồ Decor'),
(3, 'Đồng hồ treo tường');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_view` int(11) NOT NULL DEFAULT '0',
  `product_like` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_price`, `product_photo`, `product_view`, `product_like`) VALUES
(1, 'Đồng hồ pin Thạch Anh', 'Đồng hồ pin Thạch Anh,\r\nhay còn được biết đến phổ biến hơn với cái tên là đồng hồ Quartz, \r\nchủ yếu chạy bằng pin, là loại đồng hồ hoạt động với cơ chế điều động\r\n“tinh thể thạch anh”. Năng lượng của chiếc đồng hồ đến từ các tinh thể \r\ntrong bộ máy dao động nhờ được đặt trong một điện trường. Hiện nay, có hai\r\nloại đồng hồ Thạch Anh phổ biến nhất:\r\n- Chạy bằng pin thông thường: Đây là dòng máy chiếm đa số, hiển thị thời gian bằng kim quay và các dấu giờ.\r\n- Chạy bằng pin sạc năng lượng ánh sáng/bánh đà: Hiển thị thời gian bằng kim quay và các dấu giờ.                                                                                                                                                                                                                                                ', 1000, 'thachanh.jpg', 4, 0),
(2, 'Đồng hồ cơ', 'Đồng hồ cơ hay còn được biết đến\r\nlà đồng hồ automatic, là dòng đồng hồ tự động lên dây cót, sử\r\ndụng bộ máy cơ khí tự động lên dây cót khi đeo trên tay và hoàn toàn\r\nkhông cần dùng tay vặn dây cót hay phải thay pin cho đồng hồ chạy. Đồng\r\nhồ cơ được nhiều người yêu thích sử dụng bởi tuổi thọ đồng hồ cao, ít hư hỏng,\r\nít gặp lỗi và khả năng chịu nước cao.                                        ', 150, 'co.jpg', 1, 0),
(3, 'Đồng hồ vừa cơ vừa pin', 'Đồng hồ vừa cơ, vừa pin (đồng hồ cơ lai pin) là dòng đồng hồ có cả hai linh kiện cơ khí và điện tử nằm trong bộ máy. Trong đó, phần cơ khí sẽ có nhiệm vụ sản sinh năng lượng hoạt động cho chiếc đồng hồ còn phần điện tử sẽ có nhiệm vụ chuyển đổi, tích trữ năng lượng đồng thời vận hành đồng hồ với độ chính xác cao.\r\nDòng đồng hồ vừa cơ, vừa pin dù không thật sự phổ biến, nhưng nó vẫn là dòng sản phẩm thú vị khi giải quyết mọi nhược điểm của 2 bộ máy phổ biến trên. Các loại đồng hồ cơ lai pin nổi tiếng nhất hiện nay đó là: Kinetic, Autoquartz, Automatic Digital, Quartz Twist.', 200, 'copin.jpg', 1, 0),
(4, 'Đồng hồ điện tử', 'Đồng hồ điện tử có tên tiếng anh là digital watch, sử dụng máy pin hoặc năng lượng ánh sáng, nhưng thay vì sử dụng kim chỉ giờ và mặt số như các loại đồng hồ thông thường khác, mặt đồng hồ được hiển thị bằng số điện tử và hiển thị được nhiều nội dung khác nhau. Bên cạnh đó, \r\nđồng hồ điện tử thường đi kèm khả năng chống nước cùng nhiều tính năng khác.\r\nĐồng hồ điện tử thường mang phong cách mạnh mẽ, bền bỉ, chắc chắn và thường\r\nkèm theo nhiều tính năng vì vậy được những người dùng năng động, chơi thể thao\r\nhay vận động viên lựa chọn.', 170, 'dientu.jpg', 0, 0),
(5, 'Đồng hồ dạ quang', 'Đồng hồ dạ quang là một loại đồng hồ có khả năng phát quang trong môi trường thiếu sáng hay trời tối. Dạ quang trên đồng hồ phát sáng nhờ khả năng hấp thụ ánh sáng và sau đó tự phát sáng trong điều kiện cần thiết. Ánh sáng sẽ giảm dần sau thời gian hoạt động và cần hấp thụ thêm để có thể tiếp tục phát ra ánh sáng.\r\nĐồng hồ dạ quang thường được các vận động viên bơi\r\nhay thợ lặn lựa chọn sử dụng bởi khả năng phát quang\r\nmà không cần bấm nút như đồng hồ điện tử, nhờ đó không\r\ngây ảnh hưởng đến bộ máy bên trong.', 190, 'daquang.jpg', 0, 0),
(6, 'Đồng hồ quân đội', 'Đồng hồ quân đội là loại đồng hồ được thiết kế chuyên biệt để sử dụng trong môi trường quân đội khắc nghiệt với sự bền bỉ cùng nhiều tính năng phức tạp, đòi hỏi độ chính xác cao. Bên cạnh tính năng xem giờ, đồng hồ quân đội còn trang bị thêm tính năng như chỉ phương hướng, xác định độ cao để phục vụ cho mục đích quân sự.\r\nĐặc điểm của mẫu đồng hồ quân đội là chất liệu vỏ cứng cáp, dây đeo chắc chắn, kích thước mặt đồng hồ lớn, khả năng chống nước cao và đặc biệt là sở hữu bộ máy bền bỉ.', 300, 'quandoi.jpg', 0, 0),
(7, 'Đồng hồ cơ lộ máy', 'Đồng hồ cơ lộ máy hay được biết đến là đồng hồ Open Heart, là những mẫu đồng hồ cơ với một cửa sổ để lộ ra phần bộ máy nằm ngay trên mặt số. Phần trái tim thường là bánh lắc và lò xo, là bộ phận quan trọng nhất, quyết định độ chính xác của đồng hồ.\r\nĐồng hồ cơ lộ máy dành cho nam luôn được các nhà sản xuất ưu ái với thiết kế sang trọng, tinh xảo. Chiếc đồng hồ giúp người đeo tôn lên sự lịch lãm, quý phái và cổ điển đồng thời cũng tôn lên vẻ mạnh mẽ, nam tính. Đồng hồ thích hợp để diện trong nhiều dịp như hẹn hò, tiệc tùng, gặp gỡ đối tác,...', 320, 'colomay.jpg', 0, 0),
(8, 'Đồng hồ siêu mỏng', 'Đồng hồ siêu mỏng (Ultra thin) là đồng hồ có độ dày vỏ chỉ vài mm. Tuy nhiên, còn rất nhiều thứ chi phối đến độ dày của nó như bộ máy, chức năng, kiểu dáng mặt số, các hiển thị… Thông thường độ dày của vỏ đồng hồ pin Thạch Anh là 7mm, máy cơ dao động từ 9-10mm.\r\nTrái ngược với các mẫu đồng hồ nam to bản, mạnh mẽ và chắc chắn, đồng hồ siêu mỏng dần trở thành xu thế bởi sự mỏng nhẹ, mang vẻ đẹp tinh tế, thanh lịch và có sức hấp dẫn riêng. Đồng hồ siêu mỏng thích hợp dành cho những quý ông lịch lãm, có thể đeo như một món phụ kiện trang sức hàng ngày.', 6500, 'sieumong.jpg', 1, 0),
(9, 'Đồng hồ đặc biệt', 'Đồng hồ phiên bản đặc biệt (Limited Edition) chính là dòng sản phẩm với số lượng có hạn được nhà sản xuất thiết kế và tung ra thị trường vào những sự kiện đặc biệt hay cột mốc lịch sử quan trọng nào đó để kỉ niệm.\r\nĐiều làm nên sức hấp dẫn của những chiếc đồng hồ phiên bản giới hạn và được nhiều tín đồ yêu thời trang săn đón chính là bởi sự khan hiếm và đặc biệt của nó. Giá trị đẳng cấp ở những chiếc đồng hồ limited này là rất cao bởi bạn sẽ không sợ đụng hàng với người khác.\r\nĐồng thời vì số lượng có hạn nên không ít người cho dù săn đón cũng không thể sở hữu được nó.', 100, 'dacbiet.jpg', 0, 0),
(10, 'Đồng hồ Chronograph', 'Đồng hồ Chronograph là loại đồng hồ được tích hợp thêm chức năng ghi giờ hay đếm giờ (đo khoảng thời gian của một sự kiện nào đó) bên cạnh tính năng xem giờ thông thường.\r\nĐồng hồ Chronograph có 3 loại là:\r\n- Đồng hồ Double Chronograph: Là loại Chronograph kép gồm 2 kim giây đặt chồng lên nhau để ước tính 2 sự kiện của khoảng thời gian khác nhau. Và có thêm một nút bấm được đặt ở vị trí 8 giờ hoặc 10 giờ để khởi động lại hai kim giây về vị trí 0.\r\n- Đồng hồ Fly-Back Chronograph: Đồng hồ này cũng có 2 nút bấm giờ thể thao chính ở vị trí 2 và 4 giờ nhưng khác biệt là toàn bộ chức năng được thực hiện ở 1 vị trí 4 giờ và loại bỏ bước dừng lại (Stop).\r\n- Đồng hồ Chronograph Monopusher: Loại đồng hồ này là Chronograph một nút bấm. Chỉ với 1 nút bấm duy nhất (thường đặt ở vị trí 3 hoặc 2 giờ) là có thể thực hiện tất cả các nhiệm vụ: Start, Stop và Reset.', 200, 'Chronograph.jpg', 0, 0),
(11, 'Đồng hồ solar', 'Đồng hồ solar (năng lượng mặt trời) là dòng đồng hồ dùng ánh sáng để chuyển hóa thành năng lượng được sạc vào 1 viên pin trong đồng hồ. Chỉ mới 1 phút hấp thụ ánh sáng mặt trời, chiếc đồng hồ\r\ncó thể cho thời gian hoạt động lên đến 3 tới 6 giờ liên tục.\r\nNhắc đến dòng đồng hồ sử dụng năng lượng ánh sáng,\r\nkhông thể không nhắc đến công nghệ Eco-drive của Citizen. \r\nVới công nghệ này, bất kì nguồn ánh sáng nào cũng được chuyển hoá thành năng lượng,\r\nsạc và tích trữ trong pin để duy trì hoạt động của đồng hồ.', 220, 'solar.jpg', 0, 0),
(12, 'Đồng hồ Mạ Bắc Âu', 'Đồng hồ được mạ vàng và có nhiều chi tiết đẹp xuất sắc. Với xuất xứ Thụy Sỹ sẽ không làm cho khách hàng phải chịu thiệt thòi.', 120, 'mabacau.jpg', 0, 0),
(13, 'Đồng hồ hoa lá', 'Chắc hẳn chủ nhân của bữa tiệc sẽ cảm thấy thật hãnh diện khi được sở hữu một trong những kiệt tác tinh xảo này.\r\nTất cả đồng hồ được làm bằng thép sơn tĩnh điện không bong tróc. Tiêu chuẩn chất lượng CE&Rohs (Tiêu chuẩn Châu Âu) chính xác tuyệt đối, mang lại sự yên tâm về thời giờ quý báu của bạn.\r\nKim trôi êm ái, không gây tiếng động ảnh hưởng giấc ngủ của bạn.\r\nMỗi chiếc đồng hồ đều được đóng gói cẩn thận, đảm bảo khi vận chuyển cho quý khách hàng.\r\n\r\n', 300, 'hoala.jpg', 0, 0),
(14, 'Đồng hồ decor phòng', 'Nội thất hiện đại không thể thiếu những chiếc đồng hồ treo tường đẹp, độc đáo. Đồng hồ nghệ thuật hiện nay luôn được đặt một vị trí rất qua trọng trong thiết kế nội thất. Ngoài ra bạn có thể sử dụng những chiếc đồng hồ độc đáo này là quà tặng cho các đôi uyên ương hay dịp tân gia.', 400, 'decor.jpg', 0, 0),
(15, 'Đồng hồ nghệ thuật', 'Tất cả đồng hồ được làm bằng thép sơn tĩnh điện không bong tróc. Tiêu chuẩn chất lượng CE&Rohs (Tiêu chuẩn Châu Âu) chính xác tuyệt đối, mang lại sự yên tâm về thời giờ quý báu của bạn.\r\nKim trôi êm ái, không gây tiếng động ảnh hưởng giấc ngủ của bạn.\r\nMỗi chiếc đồng hồ đều được đóng gói cẩn thận, đảm bảo khi vận chuyển cho quý khách hàng', 500, 'nghethuat.jpg', 0, 0),
(16, 'Đồng hồ decor Trái Đất', 'Tất cả đồng hồ được làm bằng thép sơn tĩnh điện không bong tróc. Tiêu chuẩn chất lượng CE&Rohs (Tiêu chuẩn Châu Âu) chính xác tuyệt đối, mang lại sự yên tâm về thời giờ quý báu của bạn.\r\nKim trôi êm ái, không gây tiếng động ảnh hưởng giấc ngủ của bạn.\r\nMỗi chiếc đồng hồ đều được đóng gói cẩn thận, đảm bảo khi vận chuyển cho quý khách hàng', 200, 'traidat.jpg', 0, 0),
(17, 'Đồng hồ Tráng Gương', 'Tất cả đồng hồ được làm bằng thép sơn tĩnh điện không bong tróc. Tiêu chuẩn chất lượng CE&Rohs (Tiêu chuẩn Châu Âu) chính xác tuyệt đối, mang lại sự yên tâm về thời giờ quý báu của bạn.\r\nKim trôi êm ái, không gây tiếng động ảnh hưởng giấc ngủ của bạn.\r\nMỗi chiếc đồng hồ đều được đóng gói cẩn thận, đảm bảo khi vận chuyển cho quý khách hàng', 170, 'trangguong.jpg', 0, 0),
(18, 'Đồng hồ Tuần Lộc', 'Nội thất hiện đại không thể thiếu những chiếc đồng hồ treo tường đẹp, độc đáo. Đồng hồ nghệ thuật hiện nay luôn được đặt một vị trí rất qua trọng trong thiết kế nội thất. Ngoài ra bạn có thể sử dụng những chiếc đồng hồ tuần lộc này là quà tặng cho các đôi uyên ương hay dịp tân gia.', 320, 'tuanloc.jpg', 0, 0),
(19, 'Đồng hồ Cá Voi', 'Nội thất hiện đại không thể thiếu những chiếc đồng hồ treo tường đẹp, độc đáo. Đồng hồ nghệ thuật hiện nay luôn được đặt một vị trí rất qua trọng trong thiết kế nội thất. Ngoài ra bạn có thể sử dụng những chiếc đồng hồ tuần lộc này là quà tặng cho các đôi uyên ương hay dịp tân gia.', 160, 'cavoi.jpg', 0, 0),
(20, 'Đồng hồ Bông Hoa', 'Nội thất hiện đại không thể thiếu những chiếc đồng hồ treo tường đẹp, độc đáo. Đồng hồ nghệ thuật hiện nay luôn được đặt một vị trí rất qua trọng trong thiết kế nội thất. Ngoài ra bạn có thể sử dụng những chiếc đồng hồ tuần lộc này là quà tặng cho các đôi uyên ương hay dịp tân gia.', 180, 'bonghoa.jpg', 0, 0),
(21, 'Đồng hồ Con Công', 'Nội thất hiện đại không thể thiếu những chiếc đồng hồ treo tường đẹp, độc đáo. Đồng hồ nghệ thuật hiện nay luôn được đặt một vị trí rất qua trọng trong thiết kế nội thất. Ngoài ra bạn có thể sử dụng những chiếc đồng hồ tuần lộc này là quà tặng cho các đôi uyên ương hay dịp tân gia.', 222, 'concong.jpg', 0, 0),
(22, 'Đồng hồ Quả Chuông', 'Một chiếc đồng hồ treo tường đẹp và ấn tượng giờ đây là một sản phẩm không thể thiếu trong mỗi gia đình. Nó là thước đo thời gian, để xem giờ nhưng đồng thời cũng là món đồ trang trí độc đáo cho ngôi nhà\r\nĐồng hồ treo tường trong nhà đều có ý nghĩa rất đặc biệt, nó thể hiện thời gian chuyển động không ngừng nghỉ có ý nghĩa như vòng quay tự nhiên, chuyển động và bất tận.\r\nChiếc đồng hồ trở thành món đồ trang trí độc đáo và tinh tế, mang phong cách hiện đại mà không kém phần sang trọng cho không gian.\r\nBạn cũng có thể chọn đồng hồ treo tường này làm quà cưới, tặng tân gia, tặng sinh nhật … vô cùng độc đáo và ý nghĩa .', 333, 'chuong.jpg', 0, 0),
(23, 'Đồng hồ LED', 'Đồng hồ lịch vạn niên đa chức năng hiện thị thời gian , ngày tháng năm dương lịch, thứ, báo thức, nhiệt độ được tích hợp trọn bộ trên chiếc đồng hồ này sẽ rất tiện dụng cho quý khách hàng khi sử dụng trong nhà, cơ quan, xí nghiệp, trường học…', 123, 'led.jpg', 0, 0),
(24, 'Đồng hồ Con Ngựa', 'Từ thời xa xưa, tranh không chỉ mang tính đẹp mà nó còn có ý nghĩa trong phong thủy, như Tranh hoa sen, cá chép mang ý nghĩa cho sự no đủ, tiền tài viên mãn. Tranh hoa mẫu đơn tượng trưng cho vinh hoa phú quý Cho nên người ta dùng tranh để làm quà tặng và thay lời chúc phúc, cầu cho người thân, bạn bè, bạn hàng, hoặc cấp trên của mình. Hơn thế nữa, ngày nay Tranh còn được phát triển, kết hợp, ứng dụng vào đồng hồ và cho ra đời \"Lịch Vạn Niên\", có nhiều công dụng và ý nghĩa trong cuộc sống.', 784, 'ngua.jpg', 0, 0),
(25, 'Đồng hồ Tài Lộc', 'Từ thời xa xưa, tranh không chỉ mang tính đẹp mà nó còn có ý nghĩa trong phong thủy, như Tranh hoa sen, cá chép mang ý nghĩa cho sự no đủ, tiền tài viên mãn. Tranh hoa mẫu đơn tượng trưng cho vinh hoa phú quý Cho nên người ta dùng tranh để làm quà tặng và thay lời chúc phúc, cầu cho người thân, bạn bè, bạn hàng, hoặc cấp trên của mình. Hơn thế nữa, ngày nay Tranh còn được phát triển, kết hợp, ứng dụng vào đồng hồ và cho ra đời \"Lịch Vạn Niên\", có nhiều công dụng và ý nghĩa trong cuộc sống.', 452, 'tailoc.jpg', 0, 0),
(26, 'Đồng hồ Basic', 'Đồng hồ gỗ treo tường đơn giản luôn là sản phẩm được rất nhiều các chủ nhân chung cư lựa chọn, sự hài hòa đơn giản cùng với giá thành và vật liệu từ gỗ thân thiện môi trường là điều mà căn phòng của bạn cần nhất. Máy đồng hồ gỗ treo tường tại shop đều được sử dụng là loại máy kim trôi nhập có độ chính xác cao và không phát ra tiếng động lạch cạch khi đêm xuống. ️', 111, 'treotuong.jpg', 0, 0),
(27, 'Đồng hồ Basic SSD', 'Đồng hồ gỗ treo tường đơn giản luôn là sản phẩm được rất nhiều các chủ nhân chung cư lựa chọn, sự hài hòa đơn giản cùng với giá thành và vật liệu từ gỗ thân thiện môi trường là điều mà căn phòng của bạn cần nhất. Máy đồng hồ gỗ treo tường tại shop đều được sử dụng là loại máy kim trôi nhập có độ chính xác cao và không phát ra tiếng động lạch cạch khi đêm xuống. ️', 100, 'treotuong1.jpg', 0, 0),
(28, 'Đồng hồ để bàn', 'Đồng hồ gỗ treo tường đơn giản luôn là sản phẩm được rất nhiều các chủ nhân chung cư lựa chọn, sự hài hòa đơn giản cùng với giá thành và vật liệu từ gỗ thân thiện môi trường là điều mà căn phòng của bạn cần nhất. Máy đồng hồ gỗ treo tường tại shop đều được sử dụng là loại máy kim trôi nhập có độ chính xác cao và không phát ra tiếng động lạch cạch khi đêm xuống. ️', 50, 'treotuong2.jpg', 0, 0),
(29, 'Đồng hồ Vạn Niên', 'Từ thời xa xưa, tranh không chỉ mang tính đẹp mà nó còn có ý nghĩa trong phong thủy, như Tranh hoa sen, cá chép mang ý nghĩa cho sự no đủ, tiền tài viên mãn. Tranh hoa mẫu đơn tượng trưng cho vinh hoa phú quý Cho nên người ta dùng tranh để làm quà tặng và thay lời chúc phúc, cầu cho người thân, bạn bè, bạn hàng, hoặc cấp trên của mình. Hơn thế nữa, ngày nay Tranh còn được phát triển, kết hợp, ứng dụng vào đồng hồ và cho ra đời \"Lịch Vạn Niên\", có nhiều công dụng và ý nghĩa trong cuộc sống. Do đó hôm nay, Shop xin giới thiệu tới Quý Khách Đồng hồ \"Lịch Vạn Niên\" treo tường LVNCT 55646', 90, 'vannien.jpg', 0, 0),
(30, 'Xiaomi Miband 4', 'Sau sự thành công của Mi Band 3 hồi năm ngoái, Xiaomi tiếp tục ra mắt đồng hồ thông minh Mi Band 4 với nhiều nâng cấp đáng giá về màn hình, tính năng. Đây chính là sự lựa chọn hàng đầu trong phân khúc smartband dưới 1 triệu đồng. Bên cạnh đó, bạn cũng có thể tham khảo nhanh Xiaomi Mi band 5 mới nhất sắp được lên kệ.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', 590, 'miband4.jpg', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_categories`
--

DROP TABLE IF EXISTS `products_categories`;
CREATE TABLE IF NOT EXISTS `products_categories` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products_categories`
--

INSERT INTO `products_categories` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_user`
--

DROP TABLE IF EXISTS `product_user`;
CREATE TABLE IF NOT EXISTS `product_user` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, '123', '$2y$10$oGNwgVAH6TDe8pwKy3mvQePYUDFsH7bYYMVE8bgcwzhspYWggtTHm', 0),
(2, 'admin', '$2y$10$iyJVtB5vUrXrYdBfOO2ImOCt5MZSdsQTTVDGmcgHxNCDNaIhsfBx6', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
