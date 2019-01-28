
$(document).ready(function (){

	var playlist_to_follow = [];
	owl = $('.owl-carousel');
	owl.owlCarousel({
		loop:false,
		margin:10,
		nav:false,
		items:1,
		stagePadding: 0,
		touchDrag:false,
		mouseDrag:false,
		// animateOut: 'fadeOut'
	});

	$('.next').click(function() {
		owl.trigger('next.owl.carousel');
	});

	slider_options = {
        value: 0,
        sliderType: "min-range",
        radius:80,
        step:1,
        min:0,
        max:10,
        circleShape: "pie",
        editableTooltip:false,
        startAngle: 315,
        width:25,
        create: function (event) {
        	console.log($(this));
    		this.control.parent().find('.knob').addClass("rs-transition").eq(0).rsRotate(this._handle1.angle);
    		changeColor(this.control,event);
    	}
    };

    slider_options_big = {
        value: 0,
        sliderType: "min-range",
        radius:100,
        step:1,
        min:0,
        max:10,
        circleShape: "pie",
        editableTooltip:false,
        startAngle: 315,
        width:25,
        create: function (event) {
        	console.log($(this));
    		this.control.parent().find('.knob').addClass("rs-transition").eq(0).rsRotate(this._handle1.angle);
    		changeColor(this.control,event);
    	}
    };

    slider_options_small = {
        value: 4,
        sliderType: "min-range",
        radius:30,
        step:1,
        min:0,
        max:10,
        circleShape: "pie",
        editableTooltip:false,
        startAngle: 315,
        width:5,
        create: function (event) {
        	console.log("event.value");
    		this.control.parent().find('.knob').addClass("rs-transition").eq(0).rsRotate(event.handle.angle);
    		changeColor(this.control,event);
    	}
    };

	$(".slider").roundSlider(slider_options).on("change drag", function (event) {
			$(this).parent().find('.knob').rsRotate(event.handle.angle);
			changeColor($(this),event);
			$(this).parent().find('.score').html(event.value);
			console.log($(this));

	});

	$(".slider.big").roundSlider(slider_options_big).on("change drag", function (event) {
			$(this).parent().find('.knob').rsRotate(event.handle.angle);
			changeColor($(this),event);
			$(this).parent().find('.score').html(event.value);
			console.log($(this));

	});

	$(".slider.small").roundSlider(slider_options_small).on("change drag", function (event) {
			$(this).parent().find('.knob').rsRotate(event.handle.angle);
			changeColor($(this),event);
			$(this).parent().find('.score').html(event.value);
			console.log($(this));

	});
    
	function changeColor(obj,event) {
		var val = event.value;
   		if(val > 8){
   			obj.find('.rs-range-color').css('background','#2FAB31');
   			obj.find('.rs-handle').css('background','#2FAB31');
   		}else if(val > 5 ){
   			obj.find('.rs-range-color').css('background','#9B9408');
   			obj.find('.rs-handle').css('background','#9B9408');
   		}else if(val >= 1){
   			obj.find('.rs-range-color').css('background','red');
   			obj.find('.rs-handle').css('background','red');
   		}else{
   			obj.find('.rs-range-color').css('background','#131313');
   			obj.find('.rs-handle').css('background','red');
   		}
	    
	}

	// $('.step_1').click(function() {
	// 		songLink = $('#song').val();
	// 		if(songLink != ''){
	// 			conection('POST',{'link':songLink,'user':user_id},'/tracks_repeated',true).then(function(data){
	// 				if(data.success == true){
	// 					owl.trigger('next.owl.carousel');
	// 				}else{
	// 					Swal({
	// 						type: 'error',
	// 						title: 'Oops...',
	// 						text: data.message,
	// 					});
	// 				}
	// 			});	
	// 		}		
				
	// });

	// $('.step_2').click(function() {
	// 		follow_user();	
	// });

	// $('.step_3').click(function() {
	// 	if(playlist_to_follow.length >= 2){
	// 		follow(playlist_to_follow);
	// 	}else{
	// 		Swal({
	// 		  title: 'Error!',
	// 		  text: 'Debes de seleccionar al menos 2 listas para seguir',
	// 		  type: 'error',
	// 		  confirmButtonText: 'Ok!'
	// 		})
	// 	}
		
	// });

	// $("body").on("click", ".playlist", function(){
	// 	addPlaylist($(this));
	// });

	




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


	$('.loader').fadeOut('fast');
});


