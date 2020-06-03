$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


// Add Student
$('#addSubmit').click(function (e) {

    $("#addForm").validate({
        submitHandler: function (form) {
            $('#addSubmit').val('Adding student..');
            
            $.ajax({
                data: $('#addForm').serialize(),
                url: "add_student",
                type: "post",
                dataType: 'json',

                success: function (data) {
                    $('#addForm').trigger("reset");
                    $('#addSubmit').val('Add student');
                    $('.existIndicator').html(data.success);
                    $('.existIndicator').show();
                    generateTable();
                },

                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});




// Edit Student
$('#updateSubmit').click(function (e) {
    
    $("#updateForm").validate({
        submitHandler: function (form) {
            $("#updateSubmit").val('Editing student..');

            $.ajax({
                data: $('#updateForm').serialize(),
                url: "update_student",
                type: "put",
                dataType: 'json',

                success: function (data) {
                    $('#updateSubmit').val('Edit student');
                    $('.existIndicator').html(data.success);
                    $('.existIndicator').show();
                    generateTable();
                },

                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });
});



// Delete student
$(document).on('click', '.deleteBtn', function(){
    var deleteModal = $('#deleteModal');

    // For closing Delete modal
    $(".closeDelBtn").on('click', function(){
        deleteModal.hide();
    });
        
    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('deleteModal')){
            deleteModal.hide();
        }
    }


    var id = $(this).attr("id");

    $.ajax({
        url:"delete_student",
        method:"delete",
        data:{id:id},

        success:function(data)
        {
            $('#deleteMsg').html(data.success);
            deleteModal.show();
            generateTable();
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
});

    

// Generate Student table
function generateTable(){
    $.ajax({
        url: "fetch_student_table",
        type: "get",
        dataType: 'json',

        success: function (data) {
            var table = $("#studTable");
            var tableData;
            for (var count=0; count<data.length; count++){
                tableData += '<tr><td class="studId">' + data[count].id_number + '</td>';
                tableData += '<td class="studName"> <p class="studLName">' + data[count].last_name + "</p>, <p class=studFName>" + data[count].first_name + '</p></td>';
                tableData += '<td class="studCourse">' + data[count].course + '</td>';
                tableData += '<td><button type="button" class="viewBtn btn btn-outline-dark">View</button></td>';
                tableData += '<td class="editTD"> <button type="button" class="editBtn btn btn-outline-dark">Edit</button> <p class="hidden">' + data[count].birthday + '</p></td>';
                tableData += '<td class="del"><button type="button" class="btn btn-outline-danger btn-xs deleteBtn" id="' + data[count].id + '">Delete</button></td></tr>';
            }
            table.html(tableData);
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
}








// For opening Add modal
$(document).on('click', '#showAdd', function(){
    

    //modal element
    var addModal = $('#addModal');
    //close btn
    var closeAddBtn = $('#closeAddBtn');

    //listen and open Add modal
    addModal.show();

    //fcn to close modal
    closeAddBtn.on('click', function(){
        addModal.hide();
        $(".existIndicator").hide();
    });

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('addModal')){
            addModal.hide();
            $(".existIndicator").hide();
        }
    }
});




// For opening Update modal
$(document).on('click', '.editBtn', function(){
    //modal element
    var updateModal = $('#updateModal');
    //close btn
    var closeUpdateBtn = $('.closeUpdateBtn');

    //listen and open Update modal and show current student details
        $("#fname").val( $(this).parent().siblings(".studName").children('p.studFName').html() );
        $("#lname").val( $(this).parent().siblings(".studName").children('p.studLName').html() );
        $("#idNum").val( $(this).parent().siblings(".studId").html() );
        $("#bday").val( $(this).siblings(".hidden").html() );
        $("#course").val( $(this).parent().siblings(".studCourse").html() );

        $("#oldIdNum").val( $(this).parent().siblings(".studId").html() );
        $("#studentId").val( $(this).parent().siblings(".del").children(".deleteBtn").attr("id") );

        updateModal.show();

    //listen for close
    closeUpdateBtn.on('click', closeUpdateModal);

    //fcn to close modal
    function closeUpdateModal(){
        updateModal.hide();
        $(".existIndicator").hide();
    } 

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('updateModal')){
            updateModal.hide();
            $(".existIndicator").hide();
        }
    }
});




// For opening View modal
$(document).on('click', '.viewBtn', function(){
    
    //modal element
    var viewModal = $('#viewModal');
    //close btn
    var closeViewBtn = $('.closeViewBtn');

    //listen and open View modal 
    $("#viewFirstName").html( $(this).parent().siblings(".studName").children('p.studFName').html() );
    $("#viewLastName").html( $(this).parent().siblings(".studName").children('p.studLName').html() );
    $("#viewIdNumber").html( $(this).parent().siblings(".studId").html() );
    $("#viewBirthday").html( $(this).parent().siblings(".editTD").children('p.hidden').html() );
    $("#viewCourse").html( $(this).parent().siblings(".studCourse").html() );

    viewModal.show();

    //listen for close
    closeViewBtn.on('click', closeViewModal);

    //fcn to close modal
    function closeViewModal(){
        viewModal.hide();
        $(".existIndicator").hide();
    } 

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('viewModal')){
            viewModal.hide();
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

var inputBox = document.getElementById("idNum");

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


$(document).ready(function(){
    generateTable();


});