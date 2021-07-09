$(document).ready(function () {
    console.log("modal")
    var date = window.localStorage.getItem("dismissedAlert");
    date = new Date(date);
    if ($('.AlertModal').length > 0 && date < new Date()) {
        $('.AlertModal').each(function (i, obj) {
            $(this).modal('show');
            today = new Date();
            today.setHours(today.getHours() + 4);
            window.localStorage.setItem('dismissedAlert', today.toISOString());
            const second = 1000;
                minute = second * 60;
                hour = minute * 60;
                day = hour * 24;

            let countDown = new Date('2019-12-01T23:59:59.999Z').getTime();
                x = setInterval(function () {

                        let now = new Date().getTime();
                        distance = countDown - now;
                        document.getElementById('days').innerText = Math.floor(distance / (day));
                        document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour));
                        document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute));
                        document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);

                    //do something later when date is reached
                    //if (distance < 0) {
                    //  clearInterval(x);
                    //  'IT'S MY BIRTHDAY!;
                    //}

                }, second);
        });
    }
    if ($('#daysx').length > 0) {
                    const second = 1000;
                minute = second * 60;
                hour = minute * 60;
                day = hour * 24;

            let countDown = new Date('2019-12-01T23:59:59.999Z').getTime();
                x = setInterval(function () {

                        let now = new Date().getTime();
                        distance = countDown - now;
                        document.getElementById('daysx').innerText = Math.floor(distance / (day));
                        document.getElementById('hoursx').innerText = Math.floor((distance % (day)) / (hour));
                        document.getElementById('minutesx').innerText = Math.floor((distance % (hour)) / (minute));
                        document.getElementById('secondsx').innerText = Math.floor((distance % (minute)) / second);

                    //do something later when date is reached
                    //if (distance < 0) {
                    //  clearInterval(x);
                    //  'IT'S MY BIRTHDAY!;
                    //}

                }, second);
    }
});