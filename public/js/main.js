$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

/* Upload Image */
$("#upload").change(function () {
    const form = new FormData();

    form.append("file", $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        url: "/upload/store",
        data: form,
        dataType: "JSON",
        success: function (response) {
            if (response.error === false) {
                $("#image-show").attr("src", response.url);
            } else {
                alert("Lỗi");
            }
        },
    });
});

function removeUser(id, url) {
    if (confirm("Bạn có chắc chắn muốn xóa không")) {
        $.ajax({
            type: "DELETE",
            dataType: "JSON",
            data: { id },
            url: url,
            success: function (respone) {
                console.log(respone);
                if (respone.error === false) {
                    location.reload();
                } else {
                    alert("Xóa thất bại hãy thử lại");
                }
            },
        });
    }
}

function removeRoom(id, url) {
    if (confirm("Bạn có chắc chắn muốn xóa không")) {
        $.ajax({
            type: "DELETE",
            dataType: "JSON",
            data: { id },
            url: url,
            success: function (respone) {
                console.log(respone);
                if (respone.error === false) {
                    location.reload();
                } else {
                    alert("Phòng có nhân viên không thể xóa");
                }
            },
        });
    }
}
