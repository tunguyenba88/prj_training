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
            }
        },
    });
});

// $("#select").change(function () {
//     const number = this.value;
//     $.ajax({
//         processData: false,
//         contentType: false,
//         type: "GET",
//         url: "/list",
//         data: number,
//         dataType: "JSON",
//         success: function (response) {
//             console.log(response);
//         },
//     });
// });

// $("#form1").keyup(function () {
//     const value = this.value;
//     $.ajax({
//         type: "GET",
//         url: "/list/search",
//         data: {
//             search: value,
//         },
//         success: function (response) {
//             $("tbody").html(response.data);
//         },
//     });
// });

$(".pagination a")
    .unbind("click")
    .click(function (e) {
        e.preventDefault();
        var page = $(this).attr("href").split("page=")[1];
        console.log(page);
        $.ajax({
            type: "GET",
            url: "?page=" + page,
            success: function (data) {
                console.log(data);
                $("body").html(data);
            },
        });
    });
