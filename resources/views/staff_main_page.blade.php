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
        <form action="/">
            <input type="submit" value="Back to Landing Page">
        </form>
        <br>

        <form action="/student_management">
            <input type="submit" value="Student Management">
        </form>

        <form action="/subject_management">
            <input type="submit" value="Subject Management">
        </form>
    </body>
</html>