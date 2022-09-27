
var idd;

// On double click show the input box
$( ".text" ).dblclick(function() {
idd=this.id;
  $( "#"+this.id ).hide();
  $( "#"+this.id+"_input" ).val($( "#"+this.id ).html()); // Copies the text of the span to the input box.
  $( "#"+this.id+"_input" ).show();
  $( "#"+this.id+"_input" ).focus();
  
});

// What to do when user changes the text of the input
function textChanged(idd){
	
  $( "#"+idd+"_input" ).hide();
  $( "#"+idd ).html($(  "#"+idd+"_input" ).val()); // Copies the text of the input box to the span.
  $( "#"+idd ).show();
      
  // Here update the database
      
}
/*
$(document).on('click','body',function(){
   textChanged(idd);
    return false;  
});
*/
$(  ".text_input" ).keypress(function (e) {

 var key = e.which;
 if(key == 13)  // the enter key code
  {
	 
    textChanged(idd);
    return false;  
  }
});