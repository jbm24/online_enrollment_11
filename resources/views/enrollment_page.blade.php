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
            <input type="submit" class="btn btn-outline-dark m-2" value="Back to Landing Page">
        </form>




        <!-- Modal for Indicator for successful enrollment, full class, or if student is already enrolled -->
        <div id="modalIndicator" class="modal">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6>Enrollment Message</h6>
                        <span class="closeIndicatorBtn">&times;</span>
                    </div>
                    <!-- Indicator for sucessful enrolling -->
                    <div class="alert alert-success collapse" role="alert" data-dismiss="alert">
                    </div>
                    <!-- Indicator for unsuccessful enrolling -->
                    <div class="alert alert-danger collapse" role="alert" data-dismiss="alert">
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
                        <!-- Indicator for wrong input details -->
                        <div class="alert alert-danger collapse" role="alert" data-dismiss="alert">
                        </div>

                        <form id="enrollForm">
                            @csrf
                            <label for="editedSubjectName">Id Number</label><br>
                            <input type="number" id="numberInput" class="form-control" name="confirmId" required><br>
                            <label for="editedCapacity">Birthday</label><br>
                            <input type="date" class="form-control" name="confirmBday" required><br>

                            <input type="text" id="subject" class="hidden" name="subject"><br>
                            <div class="positionDiv">
                                <input type="submit" id="enrollSubmit" class="btn btn-outline-dark" value="Confirm Enrollment">
                            </div>
                            

                            
                        </form>

                    </div>
                </div>
            </div>
        </div>


        

        <!-- Table of Subjects -->
        <div>
            <div class="content">
                <div class="title m-b-md mb-2">
                    Enrollment Page
                </div>

                <!-- Searchbar for subjects -->
                <form id="search">
                    @csrf
                    <label for="searchSubject">Search subject:</label><br>
                    <input type="text" id="searchInput" class="form-control searched mx-auto" name="searchSubject"><br>

                    <!-- Indicator for when the searched subject does not exist -->
                    <p id="searchIndicator" class="hidden">The subject you are looking for does not exist.</p>

                    <input type="button" id="searchBtn" class="btn btn-outline-dark" value="Search">
                </form>
                <div class="border border-dark mx-auto mt-3">
                    <table>
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
        </div>


        <script type="text/javascript" src="/js/enrollment_page.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    </body>
</html>