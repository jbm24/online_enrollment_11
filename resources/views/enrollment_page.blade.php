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
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>



    <body>
        <form action="/">
            <input type="submit" class="loginBtn btn btn-secondary" value="Back to Landing Page">
        </form>




        <!-- Modal for Indicator for successful enrollment, full class, or if student is already enrolled -->
        <div id="modalIndicator" class="modal">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>Enrollment Message</h6>
                        <span class="closeIndicatorBtn">&times;</span>
                    </div>
                    <div id="indicator" class="modal-body">
    
                    </div>
                </div>
            </div>
        </div>

        


        <!-- Modal for Enrollment confirmation -->
        <div id="enrollModal" class="modal" tabindex=-1 role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 id="modalHeader">Enrollment Confirmation</h2>
                        <span class="closeEnrollBtn">&times;</span>
                    </div>


                    <div class="modal-body">

                        <form id="enrollForm">
                            <!-- Indicator for if input had wrong Student details -->
                            <div id="wrongIndicator" class="hidden">
                            </div>
                            @csrf
                            <label for="editedSubjectName">Id Number</label><br>
                            <input type="number" class="loginInput" name="confirmId" required><br>
                            <label for="editedCapacity">Birthday</label><br>
                            <input type="date" class="loginInput" name="confirmBday" required><br>

                            <input type="text" id="subject" class="hidden" name="subject"><br>

                            <input type="submit" id="enrollSubmit" value="Confirm Enrollment">

                            
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
                <form id="search">
                    @csrf
                    <label for="searchSubject">Search subject:</label><br>
                    <input type="text" id="searchInput" class="searched" name="searchSubject"><br>

                    <!-- Indicator for when the searched subject does not exist -->
                    <p id="searchIndicator" class="hidden">The subject you are looking for does not exist.</p>

                    <input type="button" id="searchBtn" value="Search">
                </form>

                <table style="width:80%;margin-left: 10%;">
                    <thead>
                    <tr>
                    <th style="width: 25%;">Subject Name</th>
                    <th style="width: 10%;">Enrolled/Capacity</th>
                    <th style="width: 30%;">Room and Schedule</th>
                    <th style="width: 10%;"></th>
                    </tr>
                    </thead>

                    <tbody id="subjTable">

                    </tbody>

                </table>

            </div>
        </div>


        <script type="text/javascript" src="/js/enrollment_page.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </body>
</html>