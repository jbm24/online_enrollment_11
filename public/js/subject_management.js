$(document).ready(function(){
    //modal element
    var updateModal = $('#updateModal');
    //edit modal btn
    var editBtn = $('.editBtn');
    //close btn
    var closeUpdateBtn = $('.closeUpdateBtn');

    //listen and open Update modal and show current subject details
    editBtn.on('click', function openUpdateModal(){
        $("#eSubName").val( $(this).parent().siblings(".subName").html() );
        $("#eCapacity").val( $(this).siblings('h1').html() );
        $("#eRoom").val( $(this).siblings('h2').html() );
        $("#eSchedule").val( $(this).siblings('h3').html() );

        $("#oldSubName").val( $(this).parent().siblings(".subName").html() );

        $("#delSubName").val( $(this).parent().siblings(".subName").html() );

        updateModal.show();
    } );

    //listen for close
    closeUpdateBtn.on('click', closeUpdateModal);

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
        console.log();
        $("#viewFirstName").html( $(this).parent().siblings(".studName").children('p.studFName').html() );
        $("#viewLastName").html( $(this).parent().siblings(".studName").children('p.studLName').html() );
        $("#viewIdNumber").html( $(this).parent().siblings(".studId").html() );
        $("#viewBirthday").html( $(this).parent().siblings(".editTD").children('p.hidden').html() );
        $("#viewCourse").html( $(this).parent().siblings(".studCourse").html() );

        viewModal.show();
    } );

    //listen for close
    closeViewBtn.on('click', closeViewModal);

    //fcn to close modal
    function closeViewModal(){
        viewModal.hide();
    } 

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('updateModal')){
            updateModal.hide();
        }
        if(event.target == document.getElementById('viewModal')){
            viewModal.hide();
        }
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