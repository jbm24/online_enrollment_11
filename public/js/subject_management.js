$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



// Add Subject
$('#addSubmit').click(function (e) {
    e.preventDefault();
    $(this).val('Adding subject..');

    $.ajax({
        data: $('#addForm').serialize(),
        url: "add_subject",
        type: "post",
        dataType: 'json',

        success: function (data) {
            $('#addForm').trigger("reset");
            $('#addSubmit').val('Add subject..');
            $('.existIndicator').html(data.success);
            $('.existIndicator').show();
            generateTable();
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
});



// Edit Subject
$('#updateSubmit').click(function (e) {
    e.preventDefault();
    $(this).val('Editing student..');

    $.ajax({
        data: $('#updateForm').serialize(),
        url: "update_subject",
        type: "put",
        dataType: 'json',

        success: function (data) {
            $('#updateSubmit').val('Edit student..');
            $('.existIndicator').html(data.success);
            $('.existIndicator').show();
            generateTable();
        },

        error: function (data) {
            console.log('Error:', data);
        }
    });
});



// Delete Subject
$(document).on('click', '.deleteBtn', function(){
    var deleteModal = $('#deleteModal');
    
    $.ajax({
        data: $('#deleteSubject').serialize(),
        url:"delete_subject",
        method:"delete",

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
                tableData += '<td class="edit"> <button class="editBtn btn btn-secondary"> Edit Subject </button>' 
                            + '<h1 class="hidden">' + data[count].capacity + '</h1>' 
                            + '<h2 class="hidden">' + data[count].room + '</h2>' 
                            + '<h3 class="hidden">' + data[count].schedule + '</h3></td>';
                tableData += '<td><button type="button" class="viewBtn btn btn-secondary">View Enrollees</button></td>';
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
    $("#eSubName").val( $(this).parent().siblings(".subName").html() );
    $("#eCapacity").val( $(this).siblings('h1').html() );
    $("#eRoom").val( $(this).siblings('h2').html() );
    $("#eSchedule").val( $(this).siblings('h3').html() );

    $("#oldSubName").val( $(this).parent().siblings(".subName").html() );

    $("#delSubName").val( $(this).parent().siblings(".subName").html() );

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
        if(event.target == document.getElementById('deleteModal')){
            deleteModal.hide();
        }
    }



    var deleteModal = $('#deleteModal');

    // For closing Delete modal
    $(".closeDelBtn").on('click', function(){
        deleteModal.hide();
    });
        

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




$(document).ready(function(){
    generateTable();
});