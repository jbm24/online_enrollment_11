<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
    </head>
    <body>
        <div class="staffLogin">
            <button id="staffModal" class="loginBtn">Staff Login</button>
        </div>

        <div id="simpleModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeBtn">&times;</span>
                    <h2>Staff Login</h2>
                </div>
                <div class="modal-body">

                    <form action="auth" method="post">
                    <?php echo csrf_field(); ?>
                        <label for="user">Username</label><br>
                        <input type="text" value="user" class="loginInput" name="user" placeholder="Enter username here..."><br>
                        <label for="pass">Password</label><br>
                        <input type="password" value="pass" class="loginInput" name="pass" placeholder="Enter password here..."><br>
                        <input type="submit" value="Login">
                    </form>

                </div>
            </div>
        </div>
        <div class="flex-center position-ref full-height">
            

            <div class="content">
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
                    <form action="">
                        <input type="submit" value="Click here to enroll">
                    </form>
                </p>
            </div>
        </div>
        <script type="text/javascript" src="/js/modal.js"></script>
    </body>
</html>
<?php /**PATH C:\Users\jbpm24\Documents\Laravel\online_enrollment_11\resources\views/welcome.blade.php ENDPATH**/ ?>