<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Online Enrollment</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">      
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="staffLogin">
            <button type="button" id="staffModal" class="btn btn-outline-dark" data-toggle="modal" data-target="#simpleModal">Staff Login</button>
        </div>

        <div id="simpleModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h2>Staff Login</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body">

                        <form id="loginForm" class="form-group" method="post" action="/auth">
                        <!-- Indicator for if input had wrong details -->
                        <div class="alert alert-danger collapse" role="alert" data-dismiss="alert">
                        </div>
                        
                        @csrf
                            <label for="user">Username</label><br>
                            <input type="text" class="form-control" name="user" placeholder="Enter username here..." required><br>

                            <label for="pass">Password</label><br>
                            <input type="password" class="form-control" name="pass" placeholder="Enter password here..." required><br>
                            <div class="positionDiv">
                                <input type="submit" id="loginSubmit" class="btn btn-outline-dark loginBtn" value="Login">
                            </div>
                            
                        </form>

                    </div>
                </div>
            </div>
            
        </div>
        <div class="flex-center position-ref full-height">
            

            <div class="content">
                <img class="home-logo" src="/img/computer.png" alt="logo">
                <div class="title m-b-md">
                    Online Enrollment
                </div>

                <p class="description">
                    This web app allows students to make online enrollment easier without needing to login to their account.
                    Just search for the subject you want to enroll in, click the enroll button on the subject, and enter your ID number
                    and birthday as verification. After you have done this to all your required subjects, you now have completed your online
                    enrollment!
                </p>
                <p>
                    <form action="/enrollment">
                        <input type="submit" class="btn btn-outline-dark" value="Click here to enroll">
                    </form>
                </p>
            </div>
        </div>

        <!-- <script type="text/javascript" src="/js/modal.js"></script> -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        
        
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Authenticate Login
            $('#loginSubmit').click(function (e) {
                $('.alert').hide();
                $("#loginForm").validate({
                    submitHandler: function (form) {
                        $('#loginSubmit').val('Authenticating..');

                        $.ajax({
                            data: $('#loginForm').serialize(),
                            url: "auth",
                            type: "post",
                            dataType: 'json',

                            success: function (data) {
                                if (data.success){
                                    window.location.href= "student_management";
                                }
                                else{
                                    $('#loginForm').trigger("reset");
                                    $('#loginSubmit').val('Login');
                                    $('.alert').html(data.incorrect);
                                    $('.alert').show();
                                }
                            },

                            error: function (data) {
                                console.log('Error:', data);
                                
                                $('#loginSubmit').val('Login');
                                if (data.status == 422) {                             
                                    $('.alert').html(data.responseJSON.message);
                                    $('.alert').show();
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>
