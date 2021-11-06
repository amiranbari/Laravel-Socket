import Echo from 'laravel-echo'

// window.io = require('socket.io-client');

// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: window.location.hostname + ':6001'
// });
//
// window.Echo.channel('test-event')
//     .listen('ExampleEvent', (e) => {
//         console.log(e);
//     });


// import Echo from 'laravel-echo'

let e = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
})

/*e.private('user.1')
    .listen('.message.created', function (e) {
        $('#main-messages').prepend(`
        <div class="alert alert-secondary" role="alert">
                    <span class="message">${e.data.message}</span>
                    <div class="profile">
                        ${e.data.user}
                    </div>
                </div>
        `);
    })*/

e.channel('laravel_database_presence-user')
    .listen('.message.created', function (e) {
        $('#main-messages').prepend(`
        <div class="alert alert-secondary" role="alert">
                    <span class="message">${e.data.message}</span>
                    <div class="profile">
                        ${e.data.user}
                    </div>
                </div>
        `);
    })

e.join('user')
    .here((users) => {
        users.forEach(user => {
            $('#online-users').prepend(`<li id="user-${user.id}">${user.name}</li>`);
        });
    })
    .joining((user) => {
        $('#online-users').prepend(`<li id="user-${user.id}">${user.name}</li>`);
    })
    .leaving((user) => {
        $("#user-" + user.id).remove();
    });





// e.join('laravel_database_presence-test-event')
//     .here(function(users) {
//         console.log(users);
//     })
//     .joining(function(user) {
//         console.log(user);
//     })
//     .leaving(function(user) {
//         console.log(user.name);
//     });





