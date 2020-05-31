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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>



    <body>
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
        
        <form action="/">
            <input type="submit" class="loginBtn btn btn-secondary" value="Back to Landing Page">
        </form>
        


        <!-- Modal for Enrollment confirmation -->
        <div id="enrollModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="modalHeader">Enrollment Confirmation</h2>
                        <span class="closeEnrollBtn">&times;</span>
                    </div>
                    <div class="modal-body">

                        <form action="/enroll" method="post">
                            @csrf
                            <label for="editedSubjectName">Id Number</label><br>
                            <input type="number" class="loginInput" name="confirmId" required><br>
                            <label for="editedCapacity">Birthday</label><br>
                            <input type="date" class="loginInput" name="confirmBday" required><br>

                            <input type="text" id="subject" class="hidden" name="subject"><br>

                            <input type="submit" id="modalSubmit" value="Confirm Enrollment">
                        </form>

                    </div>
                </div>
            </div>
        </div>

        

        <!-- Table of Subjects -->
        <div>
            <div class="content">
                <div class="title m-b-md">
                    Enrollment Page
                </div>
                <!-- Searchbar for subjects -->
                <form action="/search">
                    @csrf
                    <label for="searchSubject">Search subject:</label><br>
                    <input type="text" name="searchSubject"><br>

                    <input type="submit" value="Search">
                </form>
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
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </body>
</html>