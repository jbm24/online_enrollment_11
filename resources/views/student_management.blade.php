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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>



    <body>
        <div id="existIndicator" style="display: none">
            <h2> A student with that ID Number already exists  </h2>
        </div>
        
        <div class="staffLogin">
            <a href="/staff_main_page"> Back to Staff Main Page </a>
        </div>

        <div id="simpleModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeBtn">&times;</span>
                    <h2 id="modalHeader">Add Student</h2>
                </div>
                <div class="modal-body">

                    <form action="add_student" method="post">
                    @csrf
                        <label for="firstName">First Name</label><br>
                        <input type="text" id="fname" class="loginInput" name="firstName" placeholder="Enter first name here..."><br>
                        <label for="lastName">Last Name</label><br>
                        <input type="text" id="lname" class="loginInput" name="lastName" placeholder="Enter last name here..."><br>
                        <label for="idNumber">ID Number</label><br>
                        <input type="number" id="idNum" class="loginInput" name="idNumber" placeholder="Enter ID Number here..."><br>
                        <label for="birthday">Birthday</label><br>
                        <input type="date" id="bday" class="loginInput" name="birthday"><br>
                        <label for="course">Course</label><br>
                        <input type="text" id="course" class="loginInput" name="course" placeholder="Enter course here..."><br>

                        <input type="submit" id="modalSubmit" value="Add Student">
                    </form>

                </div>
            </div>
        </div>


        <div>
            <div class="content">
                <div class="studentTitle m-b-md">
                    Student Management
                </div>

                <table class="student_table">
                    <tr>
                    <th style="width: 25%;">ID Number</th>
                    <th style="width: 25%;">Name</th>
                    <th style="width: 10%;">Course</th>
                    </tr>

                        @foreach ($students as $student) 
                            <tr>
                            <td>{{ $student->id_number }}</td>
                            <td>{{ $student->last_name }}, {{ $student->first_name }}</td>
                            <td>{{ $student->course }}</td>
                            <td> <button id="{{ $student->id_number }}" class="editButton"> Edit </button> </td>
                            <td> 
                                <form method="POST" action="/delete/{{ $student->id_number }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"> Delete </button> 
                                </form>
                            </td>
                            </tr>
                        @endforeach
                </table>
                <div class="addStudentBtn">
                    <button id="staffModal" class="loginBtn">Add Student</button>
                </div>
            </div>
        </div>


        <script type="text/javascript" src="/js/modal.js"></script>
        <script>
            var exists = <?php echo json_encode($exists); ?>;
        </script>
        <script type="text/javascript" src="/js/student_management.js"></script>

    </body>
</html>