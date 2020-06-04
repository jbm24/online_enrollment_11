$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



// Add Subject
$('#addSubmit').click(function (e) {
    $('.alert').hide();

    $("#addForm").validate({
        submitHandler: function (form) {
            $('#addSubmit').val('Adding subject..');

            $.ajax({
                data: $('#addForm').serialize(),
                url: "add_subject",
                type: "post",
                dataType: 'json',

                success: function (data) {
                    $('#addSubmit').val('Add subject');
                    if (data.exists){
                        $('.alert-danger').html(data.exists);
                        $('.alert-danger').show();
                    }
                    else{
                        $('.alert-success').html(data.success);
                        $('.alert-success').show();
                        setTimeout(function(){
                            $('.alert-success').hide('fade');
                        }, 2000);
                    }

                    generateTable();
                },

                error: function (data) {
                    console.log('Error:', data);
                    console.log(data.responseJSON.errors);

                    $('#addSubmit').val('Add student');

                    var errorList='';
                    for (var error in data.responseJSON.errors){
                        errorList += data.responseJSON.errors[error] + '<br>';
                    }
                    $('.alert-danger').html(errorList);

                    $('.alert-danger').show();
                }
            });
        }
    });
});



// Edit Subject
$('#updateSubmit').click(function (e) {
    $('.alert').hide();

    $("#updateForm").validate({
        submitHandler: function (form) {
            $('#updateSubmit').val('Editing subject..');

            $.ajax({
                data: $('#updateForm').serialize(),
                url: "update_subject",
                type: "put",
                dataType: 'json',

                success: function (data) {
                    $('#updateSubmit').val('Edit subject');
                    
                    if (data.exists){
                        $('.alert-danger').html(data.exists);
                        $('.alert-danger').show();
                    }
                    else{
                        $('.alert-success').html(data.success);
                        $('.alert-success').show();
                        setTimeout(function(){
                            $('.alert-success').hide('fade');
                        }, 2000);
                    }

                    generateTable();
                },

                error: function (data) {
                    console.log('Error:', data);

                    $('#updateSubmit').val('Edit subject');
                    
                    var errorList='';
                    for (var error in data.responseJSON.errors){
                        errorList += data.responseJSON.errors[error] + '<br>';
                    }
                    $('.alert-danger').html(errorList);
                    
                    $('.alert-danger').show();
                }
            });
        }
    });
});



// Delete Subject
$(document).on('click', '#deleteBtn', function(){
    var deleteModal = $('#deleteModal');
    
    $.ajax({
        data: $('#deleteSubject').serialize(),
        url:"delete_subject",
        method:"delete",

        success:function(data)
        {
            $('.alert-success').html(data.success);
            $('.alert-success').show();
            deleteModal.show();

            setTimeout(function(){
                deleteModal.hide('fade');
                $('.alert').hide('fade');
            }, 2000);

            generateTable();
            $('#updateModal').hide();
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
});



// Clear Enrollees
$(document).on('click', '#clearBtn', function(){
    var clearModal = $('#deleteModal');
    
    $.ajax({
        url:"clear_enrollees",
        method:"delete",

        success:function(data)
        {
            $('.alert-success').html(data.success);
            $('.alert-success').show();
            clearModal.show();

            setTimeout(function(){
                clearModal.hide('fade');
                $('.alert').hide('fade');
            }, 2000);

            generateTable();
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
});




    

// Generate Subject table
function generateTable(){
    $.ajax({
        url: "fetch_subject_table",
        type: "get",
        dataType: 'json',

        success: function (data) {
            var table = $("#subjTable");
            var tableData;
            for (var count=0; count<data.length; count++){
                tableData += '<tr><td class="subName">' + data[count].subject_name + '</td>';
                tableData += '<td class="studName">' + data[count].enrollee.length + "/" + data[count].capacity + '</td>';
                tableData += '<td class="edit"> <button class="editBtn btn btn-outline-dark"> Edit Subject </button>' 
                            + '<h1 class="hidden">' + data[count].capacity + '</h1>' 
                            + '<h2 class="hidden">' + data[count].room + '</h2>' 
                            + '<h3 class="hidden">' + data[count].schedule + '</h3>'
                            + '<h4 class="hidden">' + data[count].id + '</h4></td>';
                tableData += '<td><button type="button" id="' +data[count].id+ '" class="viewBtn btn btn-outline-dark">View Enrollees</button></td>';
            }
            table.html(tableData);
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
}



// Generates Enrollee table
function generateEnrolleeTable(id){
    $.ajax({
        data:{id:id},
        url: "fetch_enrollee_table",
        type: "get",
        dataType: 'json',

        success: function (data) {
            var table = $("#enrolleeTable");
            table.html('');

            var tableData;
            for (var count=0; count<data.length; count++){
                tableData += '<tr><td>' + data[count].student.id_number + '</td>';
                tableData += '<td>' + data[count].student.last_name+ ", " + data[count].student.first_name + '</td>';
                tableData += '<td>' + data[count].student.course + '</td>';
                tableData += '<td><button type="button" id="' + data[count].id + '" class="unenrollBtn btn btn-outline-danger">Unenroll</button> <h1 class="hidden">' +id+ '</h1></td>';
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
        $('.alert').hide();
    });

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('addModal')){
            addModal.hide();
            $('.alert').hide();
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
    $("#eSubName").val( $(this).parent().siblings(".subName").html() );
    $("#eCapacity").val( $(this).siblings('h1').html() );
    $("#eRoom").val( $(this).siblings('h2').html() );
    $("#eSchedule").val( $(this).siblings('h3').html() );

    $("#oldSubName").val( $(this).parent().siblings(".subName").html() );
    $("#subjId").val( $(this).siblings('h4').html() );

    $("#delSubId").val( $(this).siblings('h4').html() );

    updateModal.show();

    //listen for close
    closeUpdateBtn.on('click', closeUpdateModal);

    //fcn to close modal
    function closeUpdateModal(){
        updateModal.hide();
        $('.alert').hide();
    } 

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('updateModal')){
            updateModal.hide();
            $('.alert').hide();
        }
        if(event.target == document.getElementById('deleteModal')){
            deleteModal.hide();
            $('.alert').hide();
        }
    }



    var deleteModal = $('#deleteModal');

    // For closing Delete modal
    $(".closeDelBtn").on('click', function(){
        deleteModal.hide();
        $('.alert').hide();
    });
        

});






// For opening View Enrollees modal
$(document).on('click', '.viewBtn', function(){
    $("#enrolleeTable").html('');

    var id = $(this).attr("id");

    generateEnrolleeTable(id);



    //modal element
    var viewModal = $('#viewModal');
    //close btn
    var closeViewBtn = $('.closeViewBtn');

    viewModal.show();

    //listen for close
    closeViewBtn.on('click', closeViewModal);

    //fcn to close modal
    function closeViewModal(){
        viewModal.hide();
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





// Unenroll student
$(document).on('click', '.unenrollBtn', function(){
    
    var unenrollModal = $('#deleteModal');

    // For closing Delete modal
    $(".closeUnenrollBtn").on('click', function(){
        unenrollModal.hide();
    });
        
    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('unenrollModal')){
            unenrollModal.hide();
        }
        if(event.target == document.getElementById('viewModal')){
            $("#viewModal").hide();
        }
    }


    var id = $(this).attr("id");
    var subject_id = $(this).siblings(".hidden").html();

    $.ajax({
        url:"unenroll",
        method:"delete",
        data:{id:id},
        dataType: 'json',

        success:function(data)
        {
            generateEnrolleeTable(subject_id);
            
            $('.alert-success').html(data.success);
            $('.alert-success').show();
            unenrollModal.show();

            setTimeout(function(){
                unenrollModal.hide('fade');
                $('.alert').hide('fade');
            }, 2000);
            
            generateTable();
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
});








$(document).ready(function(){
    generateTable();
});