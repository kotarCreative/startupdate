window.Vue = require('vue');

/* Vue Modal */
import VueModal from "vue2-modal";

Vue.use(VueModal);

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Redirects the current page to the given url.
 *
 * @param string url
 *
 * @return void
 */
function redirectTo(url, newTab) {
    if (newTab) {
        window.open('http://' + window.location.hostname + url, '_blank');
    } else {
        window.location.href = 'http://' +
        window.location.hostname +
        url;
    }
}

/**
 * Used to format a date object to the required specifications.
 *
 * Y - year in 4 digit format
 * y - year in 2 digit format
 * M - month fully spelled out
 * m - month in shortened 3 letter format
 * d - date
 * T - time in 'h:m a' format
 * H - 24 hour clock hours
 * h - 12 hour clock hours
 * i - minutes
 * s - seconds
 * a - time period (AM or PM)
 *
 * @return string
 */
Date.prototype.format = function(format = 'M d Y') {
    // Check if a valid date is being used
    if (this.getTime() !== this.getTime()) return;

    var months = [
        { short: "Jan", long: "January" },
        { short: "Feb", long: "February" },
        { short: "Mar", long: "March" },
        { short: "Apr", long: "April" },
        { short: "May", long: "May" },
        { short: "Jun", long: "June" },
        { short: "Jul", long: "July" },
        { short: "Aug", long: "August" },
        { short: "Sep", long: "September" },
        { short: "Oct", long: "October" },
        { short: "Nov", long: "November" },
        { short: "Dec", long: "December" }
    ];

    // Insert Year
    format = format.replace('Y', this.getFullYear());
    format = format.replace(/\by/, this.getFullYear().toString().slice(2));

    // Insert Month
    format = format.replace('M', months[this.getMonth()]['long']);
    format = format.replace(/\bm/, months[this.getMonth()]['short']);

    // Insert Date
    format = format.replace('d', this.getDate());

    // Insert Time
    var hours = this.getHours() % 12 == 0 ? 12 : this.getHours() % 12;
    var mins = this.getMinutes();
    mins = mins < 10 ? "0" + mins : mins;
    var secs = this.getSeconds();
    secs = secs < 10 ? "0" + secs : secs;

    var period = this.getHours() >= 12 ? 'PM' : 'AM';

    format = format.replace('T', hours + ':' + mins + ' ' + period);
    format = format.replace('H', this.getHours());
    format = format.replace(/\bh/, hours);
    format = format.replace(/\bi/, mins);
    format = format.replace(/\bs/, secs);
    format = format.replace(/\ba/, period);

    return format;
}
