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
        <!-- Indicator for if added or updated Student Id already exists -->
        <div id="existIndicator">
            <h2> A student with that ID Number already exists  </h2>
        </div>
        
        <!-- Back to Staff Main Page -->
        <div class="staffLogin">
            <a href="/staff_main_page" class="backMain"> Back to Staff Main Page </a>
        </div>


        <!-- Modal for adding students -->
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
                        <input type="text" class="loginInput" name="firstName" placeholder="Enter first name here..." required><br>
                        <label for="lastName">Last Name</label><br>
                        <input type="text" class="loginInput" name="lastName" placeholder="Enter last name here..." required><br>
                        <label for="idNumber">ID Number</label><br>
                        <input type="number" class="loginInput" name="idNumber" placeholder="Enter ID Number here..." required><br>
                        <label for="birthday">Birthday</label><br>
                        <input type="date" class="loginInput" name="birthday" required><br>
                        <label for="course">Course</label><br>
                        <input type="text" class="loginInput" name="course" placeholder="Enter course here..." required><br>

                        <input type="submit" id="modalSubmit" value="Add Student">
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

                    <form action="/update_student" method="post">
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

                        <input type="submit" id="modalSubmit" value="Edit">
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

                <!-- For adding Student -->
                <div class="addStudentBtn">
                    <button id="staffModal" class="loginBtn">Add Student</button>
                </div><br>

                <table class="student_table">
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



        <script type="text/javascript" src="/js/modal.js"></script>
        <script>
            var exists = <?php echo json_encode($exists); ?>;
        </script>
        <script type="text/javascript" src="/js/student_management.js"></script>
    </body>
</html>