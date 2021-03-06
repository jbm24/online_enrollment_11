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
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

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
        <div id="addModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h2 id="modalHeader">Add Student</h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </div>

                    <div class="modal-body">
                        <!-- Indicator for sucessful adding -->
                        <div class="alert alert-success collapse" role="alert" data-dismiss="alert">
                        </div>
                        <!-- Indicator for unsuccessful adding -->
                        <div class="alert alert-danger collapse" role="alert" data-dismiss="alert">
                        </div>

                        <form id="addForm" class="form-group">
                        @csrf
                            <label for="firstName">First Name</label><br>
                            <input type="text" class="form-control" name="firstName" placeholder="Enter first name here..." required><br>
                            <label for="lastName">Last Name</label><br>
                            <input type="text" class="form-control" name="lastName" placeholder="Enter last name here..." required><br>
                            <label for="idNumber">ID Number</label><br>
                            <input type="number" class="form-control" id="numberInput" name="idNumber" placeholder="Enter ID Number here..." required><br>
                            <label for="birthday">Birthday</label><br>
                            <input type="date" class="form-control" name="birthday" required><br>
                            <label for="course">Course</label><br>
                            <input type="text" class="form-control" name="course" placeholder="Enter course here..." required><br>
                            <div class="positionDiv">
                                <input type="submit" id="addSubmit" class="btn btn-outline-dark mb-2" value="Add Student">
                            </div>
                            

                            
                        </form>

                    </div>
                </div>

            </div>
        </div>


        <!-- Modal for updating student details -->
        <div id="updateModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h2 id="modalHeader">Edit Student Information</h2>
                        <span class="closeUpdateBtn">&times;</span>
                    </div>

                    <div class="modal-body">
                        <!-- Indicator sucessful editing -->
                        <div class="alert alert-success collapse" role="alert" data-dismiss="alert">
                        </div>
                        <!-- Indicator unsucessful editing -->
                        <div class="alert alert-danger collapse" role="alert" data-dismiss="alert">
                        </div>

                        <form id="updateForm" class="form-group">
                        @csrf
                        @method('put')
                            <label for="updatedFirstName">First Name</label><br>
                            <input type="text" id="fname" class="form-control" name="updatedFirstName" required><br>
                            <label for="updatedLastName">Last Name</label><br>
                            <input type="text" id="lname" class="form-control" name="updatedLastName" required><br>
                            <label for="updatedIdNumber">ID Number</label><br>
                            <input type="number" id="idNum" class="form-control" name="updatedIdNumber" required><br>
                            <label for="updatedBirthday">Birthday</label><br>
                            <input type="date" id="bday" class="form-control" name="updatedBirthday" required><br>
                            <label for="updatedCourse">Course</label><br>
                            <input type="text" id="course" class="form-control" name="updatedCourse" required><br>

                            <input type="number" id="oldIdNum" class="hidden" name="oldIdNumber">
                            <input type="number" id="studentId" class="hidden" name="studentId">
                            <div class="positionDiv">
                                <input type="submit" id="updateSubmit" class="btn btn-outline-dark" value="Edit">
                            </div>
                            

                            
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <!-- Modal for viewing student details -->
        <div id="viewModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h2 id="modalHeader">View Student Information</h2>
                        <span class="closeViewBtn">&times;</span>
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
        </div>


        <!-- Modal for indicating successful deleting of Student -->
        <div id="deleteModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h6>Deleted</h6>
                        <span class="closeDelBtn">&times;</span>
                    </div>
                    <!-- Successful Delete Alert -->
                    <div class="alert alert-success collapse" role="alert" data-dismiss="alert">
                    </div>
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
                    <button type="button" id="showAdd" class="btn btn-outline-dark mt-1" data-toggle="modal" data-target="#addModal">Add Student</button>
                </div><br>
                <div class="border border-dark mx-auto">
                    <table>
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
        </div>



        <script type="text/javascript" src="/js/student_management.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>