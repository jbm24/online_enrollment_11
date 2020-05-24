<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
            <button id="staffModal" class="loginBtn">Add Student</button>
        </div>

        <div id="simpleModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="closeBtn">&times;</span>
                    <h2>Add Student</h2>
                </div>
                <div class="modal-body">

                    <form action="add_student" method="post">
                    @csrf
                        <label for="firstName">First Name</label><br>
                        <input type="text" class="loginInput" name="firstName" placeholder="Enter first name here..."><br>
                        <label for="lastName">Last Name</label><br>
                        <input type="text" class="loginInput" name="lastName" placeholder="Enter last name here..."><br>
                        <label for="idNumber">ID Number</label><br>
                        <input type="text" class="loginInput" name="idNumber" placeholder="Enter ID Number here..."><br>
                        <label for="birthday">Birthday</label><br>
                        <input type="date" class="loginInput" name="birthday"><br>
                        <label for="course">Course</label><br>
                        <input type="text" class="loginInput" name="course" placeholder="Enter course here..."><br>

                        <input type="submit" value="Add Student">
                    </form>

                </div>
            </div>
        </div>


        <div>
            <div class="content">
                <div class="title m-b-md">
                    Student Management
                </div>

                <table style="width:80%;margin-left: 10%;">
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
                            <td> <a href = 'edit/{{ $student->id_number }}'> Edit </button> </td>
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