$(document).ready(function(){
    //modal element
    var enrollModal = $('#enrollModal');
    //edit modal btn
    var enrollBtn = $('.enrollBtn');
    //close btn
    var closeEnrollBtn = $('.closeEnrollBtn');

    //listen and open Enrollment Confirmation modal 
    enrollBtn.on('click', function() {
        enrollModal.show();
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