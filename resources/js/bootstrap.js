window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('moment')
    require('simplebar')
    require('tinycolor')
    require('bootstrap');
    require('dropzone')
    require('chart.js')
    require('@chartisan/chartjs')
} catch (e) {}


window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/*
window.axios.interceptors.request.use(function (config) {
    config.url = '/zoomin'+config.url
    return config
    }, function (error) {
        return Promise.reject(error)
    })
*/

if (document.getElementById('notifications-modal')) {
    document.getElementById('clear-notifications').addEventListener('click', function (e) {
        e.preventDefault()
        let $notifications = $('.notification-group-item')
        $notifications.fadeOut(1000, function() { $(this).remove() })
        $notifications.each(function (index, $elem) {
            const $notification_id = $($elem).data('notification')
            axios.get('/zoomin/api/notification/'+$notification_id)
                .then((response) => {
                    console.log(response)
                })
        })
    })
}
