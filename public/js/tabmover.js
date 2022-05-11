function menu1() {
    $('[href="#data_diri"]').tab("show");
}
function menu2() {
    $('[href="#upload_foto"]').tab("show");
}
function menu3() {
    $('[href="#pendidikan"]').tab("show");
}
function menu4() {
    $('[href="#pelatihan"]').tab("show");
}
function menu5() {
    $('[href="#pekerjaan"]').tab("show");
}

$(".nav-tabs a[data-toggle=tab]").on("click", function (e) {
    if ($(this).hasClass("disabled")) {
        e.preventDefault();
        return false;
    }
});
