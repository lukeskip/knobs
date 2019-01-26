$(document).ready(function (){
	$('.add_list').click(function(e) {
		e.preventDefault();
		obj = $(this);
		song_id = $(this).data('song_id');
		conection('POST',{'song_id':song_id},'/add_list',true).then(function(data){
			if(data.success == true){
				Swal({
				  type: 'success',
				  title: '¡Listo!',
				  text: data.message,
				});
				if(obj.data('remove') == 1){
					obj.parent().parent().remove();
				}
				
				
			}else{
				Swal({
					type: 'error',
					title: 'Oops...',
					text: 'Hubo un error en el servidor, por favor inténtalo de nuevo',
				});
			}
		});
		
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
			// show_message('error','Error en el servidor!','');
		});

	}

});


