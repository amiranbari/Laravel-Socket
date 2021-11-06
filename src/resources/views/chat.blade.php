<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
    <title>Chat</title>
    <style>
        .profile{
            display: inline-block;
            float: left;
            color: green;
        }

        .message{
            display: inline-block;
        }
    </style>
</head>
<body dir="rtl">
    <div class="container">
        <h3>کاربر : {{ auth()->user()->name }}</h3>
        <div class="row">
            <div class="col-md-6">
               <div class="online-users mt-5">
                   <h5>
                       کاربران آنلاین
                   </h5>
                   <ul id="online-users">
                   </ul>
               </div>
            </div>

            <div class="col-md-6" id="main-messages">
                <input type="text" class="form-control mt-2" id="message">
                <button class="btn btn-success mt-2" onclick="SendMessage()">Send message</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        function SendMessage(e) {
            let message = document.getElementById("message");

            const data = {
                message: message.value
            };


            fetch('/send-message', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("message").value = '';
                });
        }
    </script>
    <script src="http://{{ request()->getHost() }}:6001/socket.io/socket.io.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
