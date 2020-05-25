$(document).ready(function(){
    //modal element
    var updateModal = $('#updateModal');
    //edit modal btn
    var editBtn = $('.editBtn');
    //close btn
    var closeUpdateBtn = $('.closeUpdateBtn');

    //listen and open Update modal and show current student details
    editBtn.on('click', function openUpdateModal(){
        $studBday = $(this).attr('id');
        $("#fname").val( $(this).parent().siblings(".studName").children('p.studFName').html() );
        $("#lname").val( $(this).parent().siblings(".studName").children('p.studLName').html() );
        $("#idNum").val( $(this).parent().siblings(".studId").html() );
        $("#bday").val( $studBday );
        $("#course").val( $(this).parent().siblings(".studCourse").html() );

        $("#oldIdNum").val( $(this).parent().siblings(".studId").html() );

        updateModal.show();
    } );

    //listen for close
    closeUpdateBtn.on('click', closeUpdateModal);

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('updateModal')){
            updateModal.hide();
        }
    }

    //fcn to close modal
    function closeUpdateModal(){
        updateModal.hide();
    } 






    //modal element
    var viewModal = $('#viewModal');
    //edit modal btn
    var viewBtn = $('.viewBtn');
    //close btn
    var closeViewBtn = $('.closeViewBtn');

    //listen and open View modal 
    viewBtn.on('click', function openViwModal(){
        console.log("help");
        $("#viewFirstName").val( $(this).parent().siblings(".studName").children('p.studFName').html() );
        $("#viewLastName").val( $(this).parent().siblings(".studName").children('p.studLName').html() );
        $("#viewIdNumber").val( $(this).parent().siblings(".studId").html() );
        $("#viewBirthday").val( $(this).parent().siblings(".editBtn").attr('id') );
        $("#viewCourse").val( $(this).parent().siblings(".studCourse").html() );

        viewModal.show();
    } );

    //listen for close
    closeViewBtn.on('click', closeViewModal);

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('viewModal')){
            viewModal.hide();
        }
    }

    //fcn to close modal
    function closeViewModal(){
        viewModal.hide();
    } 
});




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
if ( exists == true){
    toggleExistIndicator(true);
}
else toggleExistIndicator(false);