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

$("#form1").change(function () {
    console.log(this.value);

    const value = this.value;

    $.ajax({
        processData: false,
        contentType: false,
        type: "GET",
        url: "/list/search",
        data: value,
        dataType: "JSON",
        success: function (response) {
            console.log(response);
        },
    });
});
