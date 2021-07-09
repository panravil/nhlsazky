$(document).ready(function () {
    console.log("modal")
    if ($('.subExpModal').length > 0 && window.localStorage.getItem('expirationAlert') !== new Date().toLocaleDateString()) {

        $('.subExpModal').each(function (i, obj) {
            $(this).modal('show');
            window.localStorage.setItem('expirationAlert', new Date().toLocaleDateString());
        });
    }
});
