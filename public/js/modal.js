//modal element
var modal = document.getElementById('simpleModal');
//open modal btn
var modalBtn = document.getElementById('staffModal');
//close btn
var closeBtn = document.getElementsByClassName('closeBtn')[0];

//listen for open
modalBtn.addEventListener('click', openModal);
//listen for close
closeBtn.addEventListener('click', closeModal);
//listen for outside click
window.addEventListener('click', clickOutside);

//fcn to open modal
function openModal(){
    modal.style.display = 'block';
} 

//fcn to close modal
function closeModal(){
    modal.style.display = 'none';
} 

//fcn to close modal for outside click
function clickOutside(e){
    if(e.target == modal){
        modal.style.display = 'none';
    }
}