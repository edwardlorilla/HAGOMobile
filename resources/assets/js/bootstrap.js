var config = {
    apiKey: "AIzaSyA11mrE7kp2bUQ_36_qgLSfQ1_iLmO58nw",
    authDomain: "repositories-d0a35.firebaseapp.com",
    databaseURL: "https://repositories-d0a35.firebaseio.com",
    projectId: "repositories-d0a35",
    storageBucket: "repositories-d0a35.appspot.com",
    messagingSenderId: "258477361482"
};
firebase.initializeApp(config);
window.firebase = firebase
window._ = require('lodash');

window.Fuse =  require('fuse.js');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/sw.js')
    })
}
/*window.axios.defaults.headers.common = {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
};*/
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });


