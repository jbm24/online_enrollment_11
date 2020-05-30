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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>



    <body>
        <div class="row nav">
            <div class="col">
                <form action="/student_management">
                    <input type="submit" class="btn btn-secondary" value="Student Management">
                </form>
            </div>
            <div class="col">
                <form action="/subject_management">
                    <input type="submit" class="btn btn-secondary" value="Subject Management">
                </form>
            </div>
            <div class="row nav">
                <form action="/">
                    <input type="submit" class="btn btn-secondary" value="Logout">
                </form>
            </div>
        </div>
        
    <body>   
        <!-- Back to Staff Main Page -->
        <div class="staffLogin">
            <a href="/staff_main_page" class="backMain"> Back to Staff Main Page </a>
        </div>


        <!-- Modal for adding students -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeBtn">&times;</span>
                    <h2 id="modalHeader">Add Student</h2>
                </div>

                <!-- Indicator sucessful/unsuccessful adding -->
                <div id="existIndicator">dasf
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
                    <button id="showAdd" class="loginBtn">Add Student</button>
                </div><br>

                <table id="student_table" class="student_table">
                    <tr>
                    <th style="width: 25%;">ID Number</th>
                    <th style="width: 40%;">Name</th>
                    <th style="width: 10%;">Course</th>
                    <th style="width: 10%;"></th>
                    <th style="width: 10%;"></th>
                    <th style="width: 10%;"></th>
                    </tr>

                        @foreach ($students as $student) 
                            <tr>
                            <td class="studId">{{ $student->id_number }}</td>
                            <td class="studName"> <p class="studLName">{{ $student->last_name }}</p>, <p class=studFName>{{ $student->first_name }}</p> </td>
                            <td class="studCourse">{{ $student->course }}</td>
                            <td> <button class="viewBtn"> View </button> </td>
                            <td class="editTD"> 
                                <button class="editBtn"> Edit </button> 
                                <p class="hidden">{{ $student->birthday }}</p> 
                            </td>
                            <td> 
                                <form method="POST" action="/delete_student/{{ $student->id_number }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"> Delete </button> 
                                </form>
                            </td>
                            </tr>
                        @endforeach
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

                        },

                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });
        </script>

        <script type="text/javascript" src="/js/student_management.js"></script>
    </body>
</html>