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
                    <div class="modal-header bg-light">
                        <h2>Add Subject</h2>
                        <span id="closeAddBtn">&times;</span>
                    </div>

                    <div class="modal-body">
                        <!-- Indicator for sucessful adding -->
                        <div class="alert alert-success collapse" role="alert" data-dismiss="alert">
                        </div>
                        <!-- Indicator for unsuccessful adding -->
                        <div class="alert alert-danger collapse" role="alert" data-dismiss="alert">
                        </div>

                        <form id="addForm" class="form-group" action="add_subject" method="post">
                        @csrf
                            <label for="subjectName">Subject Name</label><br>
                            <input type="text" class="form-control" name="subjectName" placeholder="Enter Subject Name here..." required/><br>
                            <label for="room">Room</label><br>
                            <input type="text" class="form-control" name="room" placeholder="Enter Room here..." required/><br>
                            <label for="capacity">Capacity</label><br>
                            <input type="number" class="form-control" id="numberInput" name="capacity" placeholder="Enter Capacity..." required/><br>
                            <label for="schedule">Schedule</label><br>
                            <input type="text" class="form-control" name="schedule" placeholder="Enter Schedule here..." required/><br>
                            <div class="positionDiv">
                                <input type="submit" id="addSubmit" class="btn btn-outline-dark" value="Add Subject">
                            </div>
                            

                            

                        </form>

                    </div>
                </div>
            </div>
        </div>



        <!-- Modal for updating Subject details -->
        <div id="updateModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h2 id="modalHeader">Edit Subject Information</h2>
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
                            <label for="editedSubjectName">Subject Name</label><br>
                            <input type="text" class="form-control" id="eSubName" name="editedSubjectName" ><br>
                            <label for="editedRoom">Room</label><br>
                            <input type="text" class="form-control" id="eRoom" name="editedRoom" ><br>
                            <label for="editedCapacity">Capacity</label><br>
                            <input type="number" class="form-control" id="eCapacity" name="editedCapacity" ><br>
                            <label for="editedSchedule">Schedule</label><br>
                            <input type="text" class="form-control" id="eSchedule" name="editedSchedule" ><br>

                            <input type="text" id="oldSubName" class="hidden" name="oldSubName">
                            <input type="text" id="subjId" class="hidden" name="subjId">
                            <div class="positionDiv">
                                <input type="submit" id="updateSubmit" class="btn btn-outline-dark" value="Edit">
                            </div>
                            

                            

                        </form>


                        <form id="deleteSubject" class="form-group">
                            @csrf
                            @method('delete')
                            <input type="text" id="delSubId" class="hidden" name="delSubId"><br>
                            <div class="positionDiv">
                                <button type="button" id="deleteBtn" class="btn btn-outline-danger btn-xs"> Delete this subject </button>
                            </div>
                             
                        </form>

                    </div>
                </div>
            </div>
        </div>
        

        <!-- Modal for viewing Enrollees of a Subject  -->
        <div id="viewModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h2>Enrollees</h2>
                        <span class="closeViewBtn">&times;</span>
                    </div>

                    <table class="viewEnrolleesTable">
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
        </div>
        <div id="viewModal" class="modal">
            <div class="enrollee-modal-content">
                <div class="modal-header bg-light">
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



        
        <!-- Table of Subjects -->
        <div>
            <div class="content">
                <div class="studentTitle m-b-md">
                    Subject Management
                </div>

                <!-- For adding Subjects -->
                <div class="addStudentBtn">
                    <button type="button" id="showAdd" class="btn btn-outline-dark mb-2" data-toggle="modal" data-target="#simpleModal">Add Subject</button>
                </div>

                <!-- For clearing all Enrollees -->
                <div class="clearEnrolleesBtn">
                    <button type="button" id="clearBtn" class="btn btn-outline-danger">Clear Enrollees</button>
                </div>
                <!-- <form action="/clear_enrollees" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-outline-danger" value="Clear Enrollees">
                </form> -->

                <div class="border border-dark mx-auto mt-3">
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
        </div>



        <script type="text/javascript" src="/js/subject_management.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>