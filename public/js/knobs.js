$(document).ready(function (){

	

	var _fn1 = $.fn.roundSlider.prototype._setValue;
	$.fn.roundSlider.prototype._setValue = function (e) {
	  _fn1.apply(this, arguments);
	  this._raiseEvent("change");
	}

	slider_options = {
        value: 0,
        sliderType: "min-range",
        radius:80,
        step:1,
        min:0,
        max:10,
        circleShape: "pie",
        editableTooltip: false,
        startAngle: 315,
        width:25,
        create: function (event) {
    		this.control.parent().find('.knob').addClass("rs-transition").eq(0).rsRotate(this._handle1.angle);
    		changeColor(this.control,event);
    		this.control.parent().find('input').val(event.value);
    	}
    };
    

	$(".slider").roundSlider(slider_options).on("change drag", function (event) {
			$(this).parent().find('.knob').rsRotate(event.handle.angle);
			changeColor($(this),event);
			$(this).parent().find('.score').html(event.value);
			$(this).parent().find('input').val(event.value);
			if(event.value > 0){
				$(this).parent().find('.error_light').removeClass('active');	
			}else{
				$(this).parent().find('.error_light').addClass('active');
			}
			
	});


	$(".slider.big").roundSlider({'radius':100,'width':25});

	$(".slider.small").roundSlider({'radius':80,'width':25});



	if(mode != 'create'){
		$('.slider').each(function(){
			value = $(this).data('score');
			$(this).roundSlider('setValue',value);
		});

		
		$(".slider.disable").roundSlider("disable");
		
	}
	
    
	function changeColor(obj,event) {
		var val = event.value;
   		if(val > 8){
   			obj.find('.rs-range-color').css('background','#2FAB31');
   			// obj.find('.rs-handle').css('background','#2FAB31');
   		}else if(val > 5 ){
   			obj.find('.rs-range-color').css('background','#9B9408');
   			// obj.find('.rs-handle').css('background','#9B9408');
   		}else if(val >= 1){
   			obj.find('.rs-range-color').css('background','red');
   			// obj.find('.rs-handle').css('background','red');
   		}else{
   			obj.find('.rs-range-color').css('background','#131313');
   			// obj.find('.rs-handle').css('background','red');
   		}
	    
	}


});


