$(document).ready(function () {
    console.log("modal")
    var date = window.localStorage.getItem("dismissedAlert");
    date = new Date(date);
    if ($('.AlertModal').length > 0 && date < new Date()) {
        $('.AlertModal').each(function (i, obj) {
            $(this).modal('show');
            today = new Date();
            today.setHours(today.getHours() + 3);
            window.localStorage.setItem('dismissedAlert', today.toISOString());
        });
    }
});