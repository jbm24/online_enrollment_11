$(document).ready(function(){
    //modal element
    var enrollModal = $('#enrollModal');
    //edit modal btn
    var enrollBtn = $('.enrollBtn');
    //close btn
    var closeEnrollBtn = $('.closeEnrollBtn');

    //listen and open Enrollment Confirmation modal 
    enrollBtn.on('click', function() {
        if ($(this).parent().siblings(".population").children(".enrollees").html() < $(this).parent().siblings(".population").children(".capacity").html()) {
            $("#subject").val( $(this).parent().siblings(".subName").html() );
            enrollModal.show();
        }
        else toggleFullIndicator(true);
    } );

    //listen for close
    closeEnrollBtn.on('click', closeEnrollModal);

    //fcn to close modal
    function closeEnrollModal(){
        enrollModal.hide();
    } 

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('enrollModal')){
            enrollModal.hide();
        }
    }
});


// Toggle Enrolled indicator
function toggleEnrolledIndicator(state){
    if(state){
        $("#enrolledIndicator").show();
    }
    else{
        $("#enrolledIndicator").hide();
    }
}

// Toggle confirm indicator
function toggleConfirmIndicator(state){
    if(state){
        $("#confirmIndicator").show();
    }
    else{
        $("#confirmIndicator").hide();
    }
}

// Toggle full indicator
function toggleFullIndicator(state){
    if(state){
        $("#fullIndicator").show();
    }
    else{
        $("#fullIndicator").hide();
    }
}


// Check whether to toggle alreadyEnrolled indicator
if ( alreadyEnrolled == true){
    toggleEnrolledIndicator(true);
}
else toggleEnrolledIndicator(false);

// Check whether to toggle confirmIndicator
if ( flag == false){
    toggleConfirmIndicator(true);
}
else toggleConfirmIndicator(false);

// Check whether to toggle fullIndicator
if ( full == true){
    toggleFullIndicator(true);
}
else toggleFullIndicator(false);