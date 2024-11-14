$(document).ready(function () {
    $('.slider').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        dots: true,
        arrows: true
    });
});

function submitComment() {
    // Lấy giá trị từ input và textarea
    const name = document.getElementById('nameInput').value.trim();
    const commentText = document.getElementById('commentInput').value.trim();

    // Kiểm tra xem người dùng đã nhập đủ thông tin chưa
    if (name === "" || commentText === "") {
        if (name === "") {
            alert("Vui lòng nhập tên.");
        } else {
            alert("Vui lòng nhập bình luận.");
        }
        return;
    }

    // Lấy ngày giờ hiện tại
    const currentDate = new Date();
    const dateString = currentDate.toLocaleDateString('vi-VN', {
        day: 'numeric', month: 'long', year: 'numeric'
    });

    // Tạo phần tử bình luận mới
    const commentElement = document.createElement('div');
    commentElement.classList.add('comment');

    commentElement.innerHTML = `
        <span class="user-info">Tên: ${name}</span>
        <span class="date">Ngày: ${dateString}</span>
        <p class="text">Bình luận: ${commentText}</p>
    `;

    // Thêm bình luận mới vào đầu danh sách bình luận
    const commentsList = document.getElementById('comments-list');
    commentsList.insertBefore(commentElement, commentsList.firstChild);

    // Xóa nội dung trong các ô nhập
    document.getElementById('nameInput').value = '';
    document.getElementById('commentInput').value = '';
}