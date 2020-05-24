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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    </head>



    <body>
        <div id="existIndicator" style="display: none">
            <h2> That subject already exists  </h2>
        </div>
        
        <div class="staffLogin">
            <button id="staffModal" class="loginBtn">Add Student</button>
            <a href="/staff_main_page"> Back to Staff Main Page </a>
        </div>

        <div id="simpleModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeBtn">&times;</span>
                    <h2>Add Student</h2>
                </div>
                <div class="modal-body">

                    <form action="add_subject" method="post">
                    @csrf
                        <label for="subjectName">Subject Name</label><br>
                        <input type="text" class="loginInput" name="subjectName" placeholder="Enter Subject Name here..."><br>
                        <label for="capacity">Capacity</label><br>
                        <input type="number" class="loginInput" name="capacity" placeholder="Enter Capacity..."><br>
                        <label for="room">Room</label><br>
                        <input type="text" class="loginInput" name="room" placeholder="Enter Room here..."><br>
                        <label for="schedule">Schedule</label><br>
                        <input type="text" class="loginInput" name="schedule" placeholder="Enter Schedule here..."><br>

                        <input type="submit" value="Add Subject">
                    </form>

                </div>
            </div>
        </div>


        <div>
            <div class="content">
                <div class="title m-b-md">
                    Subject Management
                </div>

                <table style="width:80%;margin-left: 10%;">
                    <tr>
                    <th style="width: 25%;">Subject</th>
                    <th style="width: 25%;">Enrollees</th>
                    </tr>

                        @foreach ($subjects as $subject) 
                            <tr>
                            <td>{{ $subject->subject_name }}</td>
                            <td>enrollees</td>
                            <td> <button> Edit Subject </button> </td>
                            <td>  <button type="submit"> View Subject </button> </td>
                            </tr>
                        @endforeach
                </table>

            </div>
        </div>

        <script type="text/javascript" src="/js/modal.js"></script>

        <script>
            // Toggle indicator of whether added student already exists
            function toggleExistIndicator(state){
                if(state){
                    $("#existIndicator").show();
                }
                else{
                    $("#existIndicator").hide();
                }
            }
            // Check whether added student already exists
            if ( <?php echo json_encode($exists); ?> == true){
                toggleExistIndicator(true);
            }
            else toggleExistIndicator(false);
        </script>

    </body>
</html>