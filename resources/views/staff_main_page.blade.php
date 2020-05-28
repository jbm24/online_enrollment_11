<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Staff Main Page</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>



    <body>
    <div class="container">
        <p class="staffP">
                What would you like to do?
        </p>
        <div class="contentStaff">
            
            <form action="/student_management">
                <input type="submit" class="btnStaff" value="Student Management">
            </form>
             
            <form action="/subject_management">
                <input type="submit" class="btnStaff" value="Subject Management">
            </form>

            <form action="/">
                <input type="submit" class="btnStaff" value="Logout">
            </form>
            
        </div>
    </div>
    
        
    </body>
</html>