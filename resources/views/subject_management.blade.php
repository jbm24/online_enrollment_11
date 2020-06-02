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
                <li class="nav-item">
                    <a class="nav-link" href="/student_management">Student Management</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Subject Management <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Logout</a>
                </li>
            </ul>
        </div>
    </nav>         


        <!-- Modal for adding Subjects -->
        <div id="addModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Add Subject</h2>
                        <span id="closeAddBtn">&times;</span>
                    </div>

                    <div class="modal-body">

                        <form id="addForm" action="add_subject" method="post">
                            <!-- Indicator sucessful/unsuccessful adding -->
                            <div class="existIndicator">
                            </div>
                        @csrf
                            <label for="subjectName">Subject Name</label><br>
                            <input type="text" class="loginInput" name="subjectName" placeholder="Enter Subject Name here..." required/><br>
                            <label for="room">Room</label><br>
                            <input type="text" class="loginInput" name="room" placeholder="Enter Room here..." required/><br>
                            <label for="capacity">Capacity</label><br>
                            <input type="number" class="loginInput" id="numberInput" name="capacity" placeholder="Enter Capacity..." required/><br>
                            <label for="schedule">Schedule</label><br>
                            <input type="text" class="loginInput" name="schedule" placeholder="Enter Schedule here..." required/><br>

                            <input type="submit" id="addSubmit" value="Add Subject">

                            

                        </form>

                    </div>
                </div>
            </div>
        </div>



        <!-- Modal for updating Subject details -->
        <div id="updateModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="modalHeader">Edit Subject Information</h2>
                        <span class="closeUpdateBtn">&times;</span>
                    </div>

                    <div class="modal-body">

                        <form id="updateForm">
                        <!-- Indicator sucessful/unsuccessful adding -->
                        <div class="existIndicator">
                            </div>
                            @csrf
                            @method('put')
                            <label for="editedSubjectName">Subject Name</label><br>
                            <input type="text" class="loginInput" id="eSubName" name="editedSubjectName" required><br>
                            <label for="editedRoom">Room</label><br>
                            <input type="text" class="loginInput" id="eRoom" name="editedRoom" required><br>
                            <label for="editedCapacity">Capacity</label><br>
                            <input type="number" class="loginInput" id="eCapacity" name="editedCapacity" required><br>
                            <label for="editedSchedule">Schedule</label><br>
                            <input type="text" class="loginInput" id="eSchedule" name="editedSchedule" required><br>

                            <input type="text" id="oldSubName" class="hidden" name="oldSubName">
                            <input type="text" id="subjId" class="hidden" name="subjId">

                            <input type="submit" id="updateSubmit" value="Edit">

                            

                        </form>


                        <form id="deleteSubject">
                            @csrf
                            @method('delete')
                            <input type="text" id="delSubId" class="hidden" name="delSubId"><br>
                            <button type="button" class="btn btn-danger btn-xs deleteBtn"> Delete this subject </button> 
                        </form>

                    </div>
                </div>
            </div>
        </div>
        

        <!-- Modal for viewing Enrollees of a Subject  -->
        <div id="viewModal" class="modal">
            <div class="enrollee-modal-content">
                <div class="modal-header">
                    <h2>Enrollees</h2>
                    <span class="closeViewBtn">&times;</span>
                </div>

                <table>
                    <thead>
                    <tr>
                    <th style="width: 10%;">ID Number</th>
                    <th style="width: 10%;">Full Name</th>
                    <th style="width: 10%;">Course</th>
                    <th style="width: 10%;"></th>
                    </tr>
                    </thead>
                    <tbody id="enrolleeTable">

                    </tbody>
                </table>

            </div>
        </div>



        <!-- Modal for indicating successful deleting of Subject -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeDelBtn">&times;</span>
                </div>
                <div id="deleteMsg" class="modal-body">
 
                </div>
            </div>
        </div>


        <!-- Modal for indicating successful unenrolling of Student -->
        <div id="unenrollModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeUnenrollBtn">&times;</span>
                </div>
                <div id="unenrollMsg" class="modal-body">

                </div>
            </div>
        </div>



        
        <!-- Table of Subjects -->
        <div>
            <div class="content">
                <div class="studentTitle m-b-md">
                    Subject Management
                </div>

                <!-- For adding Subjects -->
                <div class="addStudentBtn">
                    <button type="button" id="showAdd" class="loginBtn btn btn-secondary" data-toggle="modal" data-target="#simpleModal">Add Subject</button>
                </div>

                <!-- For clearing all Enrollees -->
                <form action="/clear_enrollees" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="loginBtn btn btn-secondary" value="Clear Enrollees">
                </form>


                <table class="student_table">
                    <thead>
                    <tr>
                    <th style="width: 15%;">Subject</th>
                    <th style="width: 10%;">Enrollees</th>
                    <th style="width: 10%;"></th>
                    <th style="width: 10%;"></th>
                    </tr>
                    </thead>
                    <tbody id="subjTable">

                    </tbody>
                </table>

            </div>
        </div>



        <script type="text/javascript" src="/js/subject_management.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>