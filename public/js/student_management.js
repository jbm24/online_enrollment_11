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