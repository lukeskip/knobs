$(document).ready(function (){

	

	$("body").on('click', '.switch', function(e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$(this).parent().toggleClass('active');
	});

	// STARTS: TOOLTIPS
		
	$('.hastooltip').hover(function(){
			// Hover over code
			var title = $(this).attr('title');
			$(this).data('tipText', title).removeAttr('title');
			$('<p class="tooltip"></p>')
			.text(title)
			.appendTo('body')
			.fadeIn('fast');
	}, function() {
			// Hover out code
			$(this).attr('title', $(this).data('tipText'));
			$('.tooltip').remove();
	}).mousemove(function(e) {
			var mousex = e.pageX + 20; //Get X coordinates
			var mousey = e.pageY + 10; //Get Y coordinates
			$('.tooltip')
			.css({ top: mousey, left: mousex })
	});
	// ENDS: TOOLTIPS

	

	// $('.loader').fadeOut('fast');
});

// Pool de conexiones
function conection (method,fields,link,handle = false){
	return $.ajax({
		headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
		method:method,
	  	url: APP_URL+link,
	 	dataType:'json',
	  	data:fields,
	  	beforeSend: function( xhr ) {
    		$('.loader').css('display','block');
  		}
	})
	.done(function(data) {
		// Si handle es true, solo regresamos la respuesta del ajax, si no manejamos el mensaje al usuario desde aquí
		$('.loader').fadeOut();
		if(handle){
			return data;
		}else{
			// if(data.success == true){
			// 	show_message('success','¡Listo!',data.message);
			// }else{
			// 	show_message('error','¡Error!',data.message);
			// }
		}	
	  
	}).fail(function(jqXHR, exception){
		$('.loader').fadeOut();
		show_message('error','Error en el servidor!','');
	});

}


// controlador de mensajes
function show_message(type,title,message,link,color = '#28a745'){
	swal({ 
		title: title,
		text: message,
		type: type,
		confirmButtonText: 'OK',
		confirmButtonColor: color 
	}).then(function(result){
		if(link){
			window.location.replace(link);	
		}
	});

	


}

