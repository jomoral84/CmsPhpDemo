
$(document).ready(function(){

       //////   Editor de texto en el contenido  //////

       ClassicEditor
       .create( document.querySelector( '#body' ) )    
       .catch( error => {
       	console.error( error );
       } );



  /// Script para seleccionar o deseleccionar todos los posts con el checkbox


  $('#selectAllBoxes').click(function(event) {

  	if(this.checked) {

  		$('.checkBoxes').each(function(){
  			this.checked = true;


  		});

  	} else {

  		$('.checkBoxes').each(function(){
  			this.checked = false;

  		});

  	}

  }); 



  var div_box = "<div id='load-screen'><div id='loading'></div></div>";

  $("body").prepend(div_box);

  $('#load-screen').delay(700).fadeOut(600, function(){

  	$(this).remove();
  });





  function loadUsersOnline() {

  	$.get("../functions.php?onlineusers=result", function(data){

  		$(".usersonline").text(data);

  	});

  }


  setInterval(function(){

    loadUsersOnline();


  },500);

});



