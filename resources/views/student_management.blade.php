<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Student Management</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        
    </head>



    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="/img/computer.png" width="30" height="30" class="d-inline-block align-top" alt="">
            Online Enrollment
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Student Management <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/subject_management">Subject Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Logout</a>
                </li>
            </ul>
        </div>
    </nav>    


        <!-- Modal for adding students -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeBtn">&times;</span>
                    <h2 id="modalHeader">Add Student</h2>
                </div>

                <!-- Indicator sucessful/unsuccessful adding -->
                <div id="existIndicator">
                </div>

                <div class="modal-body">

                    <form id="addForm">
                    @csrf
                        <label for="firstName">First Name</label><br>
                        <input type="text" class="loginInput" name="firstName" placeholder="Enter first name here..." required><br>
                        <label for="lastName">Last Name</label><br>
                        <input type="text" class="loginInput" name="lastName" placeholder="Enter last name here..." required><br>
                        <label for="idNumber">ID Number</label><br>
                        <input type="number" class="loginInput" name="idNumber" placeholder="Enter ID Number here..." required><br>
                        <label for="birthday">Birthday</label><br>
                        <input type="date" class="loginInput" name="birthday" required><br>
                        <label for="course">Course</label><br>
                        <input type="text" class="loginInput" name="course" placeholder="Enter course here..." required><br>

                        <input type="submit" id="addSubmit" value="Add Student">
                    </form>

                </div>
            </div>
        </div>


        <!-- Modal for updating student details -->
        <div id="updateModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeUpdateBtn">&times;</span>
                    <h2 id="modalHeader">Edit Student Information</h2>
                </div>
                <div class="modal-body">

                    <form id="updateForm" action="/update_student" method="post">
                    @csrf
                    @method('put')
                        <label for="updatedFirstName">First Name</label><br>
                        <input type="text" id="fname" class="loginInput" name="updatedFirstName" required><br>
                        <label for="updatedLastName">Last Name</label><br>
                        <input type="text" id="lname" class="loginInput" name="updatedLastName" required><br>
                        <label for="updatedIdNumber">ID Number</label><br>
                        <input type="number" id="idNum" class="loginInput" name="updatedIdNumber" required><br>
                        <label for="updatedBirthday">Birthday</label><br>
                        <input type="date" id="bday" class="loginInput" name="updatedBirthday" required><br>
                        <label for="updatedCourse">Course</label><br>
                        <input type="text" id="course" class="loginInput" name="updatedCourse" required><br>

                        <input type="number" id="oldIdNum" class="hidden" name="oldIdNumber" required><br>

                        <input type="submit" id="updateSubmit" value="Edit">
                    </form>

                </div>
            </div>
        </div>


        <!-- Modal for viewing student details -->
        <div id="viewModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeViewBtn">&times;</span>
                    <h2 id="modalHeader">View Student Information</h2>
                </div>
                <div class="modal-body">
                        <label for="viewFirstName">First Name</label> <br>
                        <p id="viewFirstName" name="viewFirstName"></p> <br>
                        <label for="viewLastName">Last Name</label> <br>
                        <p id="viewLastName" name="viewLastName"></p> <br>
                        <label for="viewIdNumber">ID Number</label> <br>
                        <p id="viewIdNumber" name="viewIdNumber"></p> <br>
                        <label for="viewBirthday">Birthday</label> <br>
                        <p id="viewBirthday" name="viewBirthday"></p> <br>
                        <label for="viewCourse">Course</label> <br>
                        <p id="viewCourse" name="viewCourse"></p> <br>
                </div>
            </div>
        </div>



        <!-- Table of Students -->
        <div>
            <div class="content">
                <div class="studentTitle m-b-md">
                    Student Management
                </div>

                <!-- Button for adding Student -->
                <div class="addStudentBtn">
                    <button id="showAdd" class="loginBtn btn btn-secondary">Add Student</button>
                </div><br>

                <table id="student_table" class="student_table">
                    <thead>
                    <tr>
                    <th style="width: 25%;">ID Number</th>
                    <th style="width: 40%;">Name</th>
                    <th style="width: 10%;">Course</th>
                    <th style="width: 10%;"></th>
                    <th style="width: 10%;"></th>
                    <th style="width: 10%;"></th>
                    </tr>
                    </thead>

                    <tbody id="studTable">
                        
                    </tbody>
                </table>
                
            </div>
        </div>



        <script>
            $(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Add Student
                $('#addSubmit').click(function (e) {
                    e.preventDefault();
                    $(this).val('Adding student..');

                    $.ajax({
                        data: $('#addForm').serialize(),
                        url: "add_student",
                        type: "post",
                        dataType: 'json',

                        success: function (data) {
                            $('#addForm').trigger("reset");

                            $('#existIndicator').html(data.success);
                            $('#existIndicator').show();
                            generateTable();
                        },

                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

            // Generate Student table
            function generateTable(){
                $.ajax({
                    url: "fetchTable",
                    type: "get",
                    dataType: 'json',

                    success: function (data) {
                        var table = $("#studTable");
                        var tableData;
                        for (var count=0; count<data.length; count++){
                            tableData += '<tr><td class="studId">' + data[count].id_number + '</td>';
                            tableData += '<td class="studName"> <p class="studLName">' + data[count].last_name + "</p>, <p class=studFName>" + data[count].first_name + '</p></td>';
                            tableData += '<td class="studCourse">' + data[count].course + '</td>';
                            tableData += '<td><button type="button" class="viewBtn">View</button></td>'
                            tableData += '<td class="editTD"><button type="button" class="editBtn">Edit</button></td>'
                            tableData += '<td><button type="button" class="deleteBtn">Delete</button></td></tr>'
                        }
                        table.html(tableData);
                    },

                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        </script>

        <script type="text/javascript" src="/js/student_management.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>