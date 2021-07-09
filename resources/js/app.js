/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.AOS = require('aos');
// Importing JavaScript
//
// You have two choices for including Bootstrap's JS files—the whole thing,
// or just the bits that you need.


// Option 1
//
// Import Bootstrap's bundle (all of Bootstrap's JS + Popper.js dependency)

// import "../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js";


// Option 2
//
// Import just what we need

// If you're importing tooltips or popovers, be sure to include our Popper.js dependency
// import "../../node_modules/popper.js/dist/popper.min.js";

import "../../node_modules/popper.js/dist/popper.min.js";
window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('calculator-component', require('./components/CalculatorComponent.vue').default);


new Vue({
    el: '#app'
})


gsap.registerPlugin(ScrollTrigger);
gsap.registerPlugin(ScrollToPlugin);

AOS.init();
$('#carouselExampleIndicators').carousel();
$('#carousel-example-generic').carousel('pause');
(function ($) {
    function calcStepSize(optionNode) {
        var breakM = 990;
        var breakS = 768;

        var width = $(window).innerWidth();

        if (width < breakS) {
            var key = 's';
        } else if (width < breakM) {
            key = 'm';
        } else {
            key = 'l';
        }

        var cnt = 1 * optionNode.data("itemcount-" + key);
        return cnt > 0 ? cnt : 1;
    }

    function repartition(container, items, count) {
        container.children().remove();

        for (var i = 0; i < items.length; i++) {
            var cBlock = $('<div class="carousel-item container" ></div>').appendTo(container);
            var cInnerBlock = $('<div class="row"></div>').appendTo(cBlock);

            for (var j = 0; j < count; j++) {
                var cIdx = (i + j) % items.length;

                cInnerBlock.append($(items.get(cIdx)).clone());
            }
        }

        container.children().first().addClass("active");
    }

    $('.carousel.multi').each(function (idx, El) {
        var carousel = $(El);
        var container = carousel.find('.carousel-inner');

        if (!container.children().first().hasClass('carousel-item')) {
            var items = container.children().clone();

            var lastSize = calcStepSize(carousel);
            repartition(container, items, lastSize);

            $(window).resize(function () {
                var cSize = calcStepSize(carousel);

                if (cSize != lastSize) {
                    repartition(container, items, cSize);
                    lastSize = cSize;
                }
            });
        } else {
            container.children().first().addClass("active");
        }

    });

}(jQuery));


$(function () {
    $("a[data-anchor^='#']").on("click", function (e) {
        // Offset: use this only if you have (for example) a fixed header
        if ($(this.hash).length) {
            $('#dropdown-toggler').dropdown();
            return $("html, body").animate({
                scrollTop: $(this.hash).offset().top
            }, 300);
        }
    });
    ScrollTrigger.matchMedia({

        "(min-width: 768px)": function () {
            gsap.from('#puck', {
                scrollTrigger: {
                    trigger: "#puck",
                    markers: false,
                    start: "top center",
                    end: "bottom top",
                    toggleActions: "play none none reverse"
                },
                duration: 0.5,
                opacity: 1,
                x: +500,
                rotate: 45,
                scale: 0.75,
                ease: "back.out(1.2)",
            });

            gsap.from('.puck_text', {
                scrollTrigger: {
                    trigger: "#puck",
                    start: "top center",
                    markers: false,
                    end: "bottom top",
                    toggleActions: "play none none reverse",
                    onfinish: ScrollTrigger.refresh(),
                },
                stagger: 0.2,
                duration: 0.75,
                opacity: 0,
                y: -100,
                offset: 200,
                ease: "back.out(1.2)",
            });
        },


        "(max-width: 768px)": function () {

            gsap.from('#puck', {
                scrollTrigger: {
                    trigger: "#puck",
                    markers: false,
                    start: "top center",
                    end: "bottom top",
                    toggleActions: "play none none reverse"
                },
                duration: 0.5,
                opacity: 1,
                x: -500,
                rotate: 45,
                scale: 0.75,
                ease: "back.out(1.2)",
            })

            gsap.from('.puck_text', {
                scrollTrigger: {
                    trigger: "#puck",
                    start: "top bottom",
                    markers: false,
                    end: "bottom top",
                    toggleActions: "play none none reverse",
                    onfinish: ScrollTrigger.refresh(),
                },
                stagger: 0.2,
                duration: 0.75,
                opacity: 0,
                y: -100,
                offset: 200,
                ease: "back.out(1.2)",
            })

        },

        "all": function () {
            gsap.to('#pucks', {
                y: -10,
                duration: 1,
                yoyo: true,
                repeat: -1,
                ease: "power3.out"
            });


            gsap.from("#calculator", {
                scrollTrigger: {
                    trigger: "#calculator",
                    markers: true,
                    start: "top 90%",
                    end: "center top",
                    toggleActions: "play none none none"
                },
                duration: 0.5,
                opacity: 0,
                scale: 0.8,
                ease: "power3.out"
            })

            let counters = gsap.timeline({
                scrollTrigger: {
                    trigger: "#counters",
                    markers: false,
                    start: "top 70%",
                    emd: "center top",
                    toggleActions: "play none none none"
                }
            });
            ScrollTrigger.refresh();

            counters.from(".count_number_decimal span", {

                duration: 1,
                ease: "sine.out",
                innerText: 0,
                y: -50,
                opacity: 0,
                snap: {
                    "innerText": 0.01 // x snaps to the closest increment of 20 (0, 20, 40, 60, etc.)
                },
                onUpdate: function () {
                    this.targets().forEach(target => {
                        const val = gsap.getProperty(target, "innerText");
                        target.innerText = nicenumber(val);
                    });
                },
            }, "<");

            counters.from(".count_number span", {

                duration: 1,
                ease: "sine.out",
                innerText: 0,
                y: -50,
                opacity: 0,
                snap: {
                    "innerText": 1 // x snaps to the closest increment of 20 (0, 20, 40, 60, etc.)
                },
                onUpdate: function () {
                    this.targets().forEach(target => {
                        const val = gsap.getProperty(target, "innerText");
                        target.innerText = nicenumber(val);
                    });
                },
            }, "<");
            let articles = gsap.timeline({
                scrollTrigger: {
                    trigger: ".news",
                    markers: false,
                    start: "top center",
                    end: "center top",
                    onToggle: self =>
                        $('#carousel-example-generic').carousel('cycle'),
                    toggleActions: "play none none none"
                }
            });
            articles.from(".article", {
                duration: 0.4,
                ease: "sine.out",
                stagger: 0.2,
                y: -10,
                opacity: 0,
                scale: 0.7,
            });
        }


    });

    function nicenumber(val) {
        val = val.toLocaleString().replace(/,/g, " ",);
        return val;
    }

    /*
    if (document.getElementById('season')) {
        var slideCol = document.getElementById("customRange1");
        var y = document.getElementById("f");
        var season = document.getElementById('season');
        var month = document.getElementById('month');
        var days = document.getElementById('days');
        season.innerHTML = (slideCol.value * 296.86).toLocaleString().replace(/,/g, " ",);

        month.innerHTML = (slideCol.value * 91).toLocaleString().replace(/,/g, " ",);

        days.innerHTML = (slideCol.value * 9.5).toLocaleString().replace(/,/g, " ",);

        y.innerHTML = (slideCol.value * 1.0).toLocaleString().replace(/,/g, " ",);
        ;

        slideCol.oninput = function () {
            document.getElementById('season').innerHTML = (this.value * 296.06).toLocaleString().replace(/,/g, " ",);
            document.getElementById('month').innerHTML = (this.value * 91.02).toLocaleString().replace(/,/g, " ",);
            document.getElementById('days').innerHTML = (this.value * 9.5).toLocaleString().replace(/,/g, " ",);
            y.innerHTML = (this.value * 1.0).toLocaleString().replace(/,/g, " ",);
            ;
        }
    }
    */


    if ($('.subExpModal').length > 0 && window.localStorage.getItem('expirationAlert') !== new Date().toLocaleDateString()) {
        $('.subExpModal').each(function (i, obj) {
            $(this).modal('show');
            window.localStorage.setItem('expirationAlert', new Date().toLocaleDateString());
        });
    }
});
