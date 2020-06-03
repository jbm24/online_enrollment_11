$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



// Enroll in a Subject
$('#enrollSubmit').click(function (e) {

    $("#enrollForm").validate({
        submitHandler: function (form) {
            $('#enrollSubmit').val('Confirming..');

            $.ajax({
                data: $('#enrollForm').serialize(),
                url: "enroll",
                type: "post",
                dataType: 'json',

                success: function (data) {
                    var enrollModal = $('#enrollModal');
                    var indicator = $("#modalIndicator");
                    var closeIndicatorBtn = $(".closeIndicatorBtn");

                    if (data.wrong){
                        $("#wrongIndicator").html(data.wrong);
                        $("#wrongIndicator").show();
                    }
                    else {
                        $("#indicator").html(data.success);
                        indicator.show();
                        $('#enrollModal').hide();
                        generateTable();
                        $("#searchInput").val('');
                        $('#enrollForm').trigger("reset");
                    }
                    $('#enrollSubmit').val("Confirm Enrollment");

                    //close modal
                    closeIndicatorBtn.on('click', function() {
                        indicator.hide();
                        $("#wrongIndicator").hide();
                    });


                    //listen for outside click
                    window.onclick = function(event) {
                        if(event.target == document.getElementById('modalIndicator')){
                            indicator.hide();
                            $("#wrongIndicator").hide();
                        }
                        if(event.target == document.getElementById('enrollModal')){
                            enrollModal.hide();
                            $('#enrollForm').trigger("reset");
                            $("#wrongIndicator").hide();
                        }
                    }
                },

                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});



// Generate Subject table
function generateTable(){
    $.ajax({
        url: "fetch_enrollment_table",
        type: "get",
        dataType: 'json',

        success: function (data) {
            var table = $("#subjTable");
            var tableData;
            for (var count=0; count<data.length; count++){
                tableData += '<tr><td class="subName">' + data[count].subject_name + '</td>';
                tableData += '<td class="population"> <p class="enrollees">' + data[count].enrollee.length + '</p>/<p class="capacity">' + data[count].capacity + '</p></td>';
                tableData += '<td>' + data[count].room + ' - ' + data[count].schedule + '</td>';
                tableData += '<td><button type="button" class="enrollBtn btn btn-outline-dark">Enroll</button></td>';
            }
            table.html(tableData);
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
}



// Search for Subject

// For clicking the search button when "Enter" is pressed
$("#searchInput").keypress(function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      $("#searchBtn").click();
    }
});

$(document).on('click', '#searchBtn', function(){
    $("#searchIndicator").hide();
    $.ajax({
        data:$('#search').serialize(),
        url:"search",
        method:"get",
        dataType: 'json',

        success:function(data)
        {
            var table = $("#subjTable");
            var tableData;
            for (var count=0; count<data.length; count++){
                tableData += '<tr><td class="subName">' + data[count].subject_name + '</td>';
                tableData += '<td class="population"> <p class="enrollees">' + data[count].enrollee.length + '</p>/<p class="capacity">' + data[count].capacity + '</p></td>';
                tableData += '<td>' + data[count].room + ' - ' + data[count].schedule + '</td>';
                tableData += '<td><button type="button" class="enrollBtn btn btn-secondary">Enroll</button></td>';
            }
            table.html(tableData);

            if (data.length == 0){
                $("#searchIndicator").show();
            }
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
});





// For opening Enroll modal
$(document).on('click', '.enrollBtn', function(){
    //modal element
    var enrollModal = $('#enrollModal');
    //close btn
    var closeEnrollBtn = $('.closeEnrollBtn');

    var indicator = $("#modalIndicator");
    var closeIndicatorBtn = $(".closeIndicatorBtn");

    //listen and open Enrollment Confirmation modal
    var enrollees = Number( $(this).parent().siblings(".population").children(".enrollees").html() );
        var capacity = Number( $(this).parent().siblings(".population").children(".capacity").html() );
        
        if ( enrollees < capacity ) {
            $("#subject").val( $(this).parent().siblings(".subName").html() );
            enrollModal.show();
        }
        else {
            $("#indicator").html("This subject is already full.");
            indicator.show();
        }

    //close modal
    closeEnrollBtn.on('click', function() {
        enrollModal.hide();
        $('#enrollForm').trigger("reset");
    });


    //close modal
    closeIndicatorBtn.on('click', function() {
        indicator.hide();
        $("#wrongIndicator").hide();
    });


    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('enrollModal')){
            enrollModal.hide();
            $('#enrollForm').trigger("reset");
            $("#wrongIndicator").hide();
        }
        if(event.target == document.getElementById('modalIndicator')){
            indicator.hide();
            $("#wrongIndicator").hide();
        }
    }
});








$(document).ready(function(){
    generateTable();

    window.onclick = function(event) {
        if(event.target == document.getElementById('modalIndicator')){
            $("#modalIndicator").hide();
        }
    }
});

//not allowing text to be placed on number box
var inputBox = document.getElementById("numberInput");

var invalidChars = [
  "-",
  "+",
  "e",
];

inputBox.addEventListener("input", function() {
  this.value = this.value.replace(/[e\+\-]/gi, "");
});

inputBox.addEventListener("keydown", function(e) {
  if (invalidChars.includes(e.key)) {
    e.preventDefault();
  }
});

var inputBox = document.getElementById("eCapacity");

var invalidChars = [
  "-",
  "+",
  "e",
];

inputBox.addEventListener("input", function() {
  this.value = this.value.replace(/[e\+\-]/gi, "");
});

inputBox.addEventListener("keydown", function(e) {
  if (invalidChars.includes(e.key)) {
    e.preventDefault();
  }
});

//number box end