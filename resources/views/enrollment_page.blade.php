<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Subject Management</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>



    <body>
        <!-- Modal for Enrollment confirmation -->
        <div id="enrollModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeEnrollBtn">&times;</span>
                    <h2 id="modalHeader">Enrollment Confirmation</h2>
                </div>
                <div class="modal-body">

                    <form action="/enroll" method="post">
                    @csrf
                        <label for="editedSubjectName">Id Number</label><br>
                        <input type="number" class="loginInput" name="confirmId"><br>
                        <label for="editedCapacity">Birthday</label><br>
                        <input type="date" class="loginInput" name="confirmBday"><br>

                        <input type="submit" id="modalSubmit" value="Confirm Enrollment">
                    </form>

                </div>
            </div>
        </div>

        
        <!-- Table of Subjects -->
        <div>
            <div class="content">
                <div class="title m-b-md">
                    Subject Management
                </div>

                <table style="width:80%;margin-left: 10%;">
                    <tr>
                    <th style="width: 25%;">Subject Name</th>
                    <th style="width: 10%;">Enrolled/Capacity</th>
                    <th style="width: 30%;">Room and Schedule</th>
                    <th style="width: 10%;"></th>
                    </tr>

                    <td>  <button class="enrollBtn"> Enroll </button> </td>

            </div>
        </div>

        <script type="text/javascript" src="/js/enrollment_page.js"></script>
    </body>
</html>