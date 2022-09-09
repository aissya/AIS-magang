// $('#download_refresh').click(function () {
//     location.reload();
// });

$('#download_refresh').click(function (event) {
    event.preventDefault();
    $('.content').location.reload();
});