/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

$(".collapseSidebar").on("click", function(e) {
    $(".vertical").hasClass("narrow") ? $(".vertical").toggleClass("open") : ($(".vertical").toggleClass("collapsed"), $(".vertical").hasClass("hover") && $(".vertical").removeClass("hover")), e.preventDefault()
}), $(".sidebar-left").hover(function() {
    $(".vertical").hasClass("collapsed") && $(".vertical").addClass("hover"), $(".narrow").hasClass("open") || $(".vertical").addClass("hover")
}, function() {
    $(".vertical").hasClass("collapsed") && $(".vertical").removeClass("hover"), $(".narrow").hasClass("open") || $(".vertical").removeClass("hover")
}), $(".toggle-sidebar").on("click", function() {
    $(".navbar-slide").toggleClass("show")
})

// include utils
require('./scripts/forms')
require('./charts/public')

// public Map
require('./components/PublicMap')

// internal Map
require('./components/Map')

// claims Table
require('./components/DataTable/ClaimTable')

