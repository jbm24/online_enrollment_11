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
        <!-- Indicator for if added or updated Subject already exists -->
        <div id="existIndicator" style="display: none">
            <h2> That subject already exists  </h2>
        </div>
        
        <!-- Modal for adding Subjects -->
        <div id="simpleModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Add Subject</h2>
                    <span class="closeBtn">&times;</span>
                </div>
                <div class="modal-body">

                    <form action="add_subject" method="post">
                    @csrf
                        <label for="subjectName">Subject Name</label><br>
                        <input type="text" class="loginInput" name="subjectName" placeholder="Enter Subject Name here..." required><br>
                        <label for="room">Room</label><br>
                        <input type="text" class="loginInput" name="room" placeholder="Enter Room here..." required><br>
                        <label for="capacity">Capacity</label><br>
                        <input type="number" class="loginInput" name="capacity" placeholder="Enter Capacity..." required><br>
                        <label for="schedule">Schedule</label><br>
                        <input type="text" class="loginInput" name="schedule" placeholder="Enter Schedule here..." required><br>

                        <input type="submit" id="modalSubmit" value="Add Subject">
                    </form>

                </div>
            </div>
        </div>


        <!-- Modal for updating Subject details -->
        <div id="updateModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 id="modalHeader">Edit Subject Information</h2>
                    <span class="closeUpdateBtn">&times;</span>
                </div>
                <div class="modal-body">

                    <form action="/update_subject" method="post">
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

                        <input type="text" id="oldSubName" class="hidden" name="oldSubName" required><br>

                        <input type="submit" id="modalSubmit" value="Edit">
                    </form>

                    <form method="POST" action="/delete_subject">
                        @csrf
                        @method('delete')
                        <input type="text" id="delSubName" class="hidden" name="delSubName"><br>
                        <button type="submit" class="delete"> Delete this subject </button> 
                    </form>

                </div>
            </div>
        </div>
        

        <!-- Modal for viewing Enrollees of a Subject  -->
        <div id="viewModal" class="modal">
            <div class="enrollee-modal-content">
                <div class="modal-header">
                    <h2>Enrollees</h2>
                    <span class="closeBtn">&times;</span>
                </div>
                <div id="viewEnrolleesTable" class="modal-body">

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
                    <button id="staffModal" class="loginBtn btn btn-secondary">Add Subject</button>
                </div>
                <!-- For clearing all Enrollees -->
                <form action="/clear_enrollees" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="loginBtn btn btn-secondary" value="Clear Enrollees">
                </form>

                <table id="enrollee_table" class="student_table">
                    <tr>
                    <th style="width: 25%;">Subject</th>
                    <th style="width: 10%;">Enrollees</th>
                    <th style="width: 10%;"></th>
                    <th style="width: 10%;"></th>
                    </tr>

                        @foreach ($subjects as $subject) 
                            <tr>
                            <td class="subName">{{ $subject->subject_name }}</td>
                            <td>{{ $subject->enrollee()->count() }}/{{ $subject->capacity }}</td>
                            <td class="edit"> 
                                <button class="editBtn btn btn-secondary"> Edit Subject </button> 
                                <h1 class="hidden">{{ $subject->capacity }}</h1>
                                <h2 class="hidden">{{ $subject->room }}</h2>
                                <h3 class="hidden">{{ $subject->schedule }}</h3>

                                <table class="hidden">
                                <tr>
                                    <th style="width: 25%;">ID Number</th>
                                    <th style="width: 10%;">Full Name</th>
                                    <th style="width: 10%;">Course</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                                @foreach ($subject->enrollee as $enrolled)
                                <tr>
                                <td>{{ $enrolled->student->id_number }}</td>
                                <td>{{ $enrolled->student->last_name }}, {{ $enrolled->student->first_name }}</td>
                                <td>{{ $enrolled->student->course }}</td>
                                <td> 
                                <form method="POST" action="/delete_enrollee/{{ $enrolled->student_id }}/{{ $enrolled->subject_id }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"> Unenroll </button> 
                                </form>
                            </td>
                                </tr>
                                @endforeach
                                </table>
                            </td>
                            <td>  <button class="viewBtn btn btn-secondary"> View Enrollees </button> </td>
                            </tr>
                        @endforeach
                </table>

            </div>
        </div>




        <script type="text/javascript" src="/js/modal.js"></script>
        <script>
            var exists = <?php echo json_encode($exists); ?>;
        </script>
        <script type="text/javascript" src="/js/subject_management.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    </body>
</html>