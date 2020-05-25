<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">

        <!-- Jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>



    <body>
                    <form method="POST" action="/update_student">
                    @csrf
                    @method('put')
                        <label for="firstName">First Name</label><br>
                        <input type="text" class="loginInput" name="firstName" value={{ $fName }} ><br>
                        <label for="lastName">Last Name</label><br>
                        <input type="text" class="loginInput" name="lastName" value={{ $lName }} ><br>
                        <label for="idNumber">ID Number</label><br>
                        <input type="number" class="loginInput" name="idNumber" value={{ $idNum }} ><br>
                        <label for="birthday">Birthday</label><br>
                        <input type="date" class="loginInput" name="birthday" value={{ $bday }} ><br>
                        <label for="course">Course</label><br>
                        <input type="text" class="loginInput" name="course" value={{ $course }} ><br>

                        <input type="submit" value="Update">
                    </form>
    </body>
</html>