<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Enrollment Page</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="/css/main.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>



    <body>
        <form action="/">
            <input type="submit" value="Back to Landing Page">
        </form>
        <!-- Indicator for if Student is already an Enrollee in the Subject -->
        <div id="enrolledIndicator" style="display: none">
            <h2> You are already enrolled in this subject.  </h2>
        </div>

        <!-- Indicator for if correct Student details were inputted -->
        <div id="confirmIndicator" style="display: none">
            <h2> Wrong ID Number or Birthday.  </h2>
        </div>

        <!-- Indicator for if the class is already full -->
        <div id="fullIndicator" style="display: none">
            <h2> This subject is already full.  </h2>
        </div>


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

                        <input type="text" id="subject" class="hidden" name="subject"><br>

                        <input type="submit" id="modalSubmit" value="Confirm Enrollment">
                    </form>

                </div>
            </div>
        </div>

        
        <!-- Table of Subjects -->
        <div>
            <div class="content">
                <div class="title m-b-md">
                    Enrollment Page
                </div>

                <table style="width:80%;margin-left: 10%;">
                    <tr>
                    <th style="width: 25%;">Subject Name</th>
                    <th style="width: 10%;">Enrolled/Capacity</th>
                    <th style="width: 30%;">Room and Schedule</th>
                    <th style="width: 10%;"></th>
                    </tr>

                    @foreach ($subjectList as $subject) 
                            <tr>
                            <td class="subName">{{ $subject->subject_name }}</td>
                            <td class="population"><p class="enrollees">{{ $subject->enrollee()->count() }}</p>/<p class="capacity">{{ $subject->capacity }}</p></td>
                            <td> {{ $subject->room }} - {{ $subject->schedule }} </td>
                            <td>  <button class="enrollBtn"> Enroll </button> </td>
                            </tr>
                    @endforeach

            </div>
        </div>


        <script>
            var alreadyEnrolled = <?php echo json_encode($alreadyEnrolled); ?>;
            var flag = <?php echo json_encode($flag); ?>;
            var full = <?php echo json_encode($full); ?>;
        </script>
        <script type="text/javascript" src="/js/enrollment_page.js"></script>
    </body>
</html>