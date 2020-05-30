$(document).ready(function(){
    generateTable();



    //modal element
    var addModal = $('#addModal');
    //open modal btn
    var modalBtn = $('#showAdd');
    //close btn
    var closeAddBtn = $('.closeBtn');

    //fcn to open modal
    modalBtn.on('click', function openModal(){
        addModal.show();
    });

    //fcn to close modal
    closeAddBtn.on('click', function(){
        addModal.hide();
        $(".resultIndicator").hide();
    });
    
    
    //modal element
    var updateModal = $('#updateModal');
    //edit modal btn
    var editBtn = $('.editBtn');
    //close btn
    var closeUpdateBtn = $('.closeUpdateBtn');

    //listen and open Update modal and show current student details
    editBtn.on('click', function openUpdateModal(){
        $("#fname").val( $(this).parent().siblings(".studName").children('p.studFName').html() );
        $("#lname").val( $(this).parent().siblings(".studName").children('p.studLName').html() );
        $("#idNum").val( $(this).parent().siblings(".studId").html() );
        $("#bday").val( $(this).siblings(".hidden").html() );
        $("#course").val( $(this).parent().siblings(".studCourse").html() );

        $("#oldIdNum").val( $(this).parent().siblings(".studId").html() );

        updateModal.show();
    } );

    //listen for close
    closeUpdateBtn.on('click', closeUpdateModal);

    //fcn to close modal
    function closeUpdateModal(){
        updateModal.hide();
        $(".resultIndicator").hide();
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
        $(".resultIndicator").hide();
    } 

    //listen for outside click
    window.onclick = function(event) {
        if(event.target == document.getElementById('addModal')){
            addModal.hide();
            $(".resultIndicator").hide();
        }if(event.target == document.getElementById('updateModal')){
            updateModal.hide();
            $(".resultIndicator").hide();
        }
        if(event.target == document.getElementById('viewModal')){
            viewModal.hide();
            $(".resultIndicator").hide();
        }
    }
});