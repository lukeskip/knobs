Dropzone.autoDiscover = false;
	$(document).ready(function(){

		$('#upload-files').dropzone({	
	        url:'/upload/mp3',
			autoProcessQueue: false,
	        uploadMultiple: false,
	        maxFilezise: 15,
	        maxFiles: 1,
	        acceptedFiles:'.mp3',
	        success: function(file, response){
                $('.song-file').val(response.file);
                register();
                
            },


	        init: function () {       
	            this.on("maxfilesexceeded", function(file) {
		            this.removeAllFiles();
		            this.addFile(file);
	      		});
				
	        }
		});

		$('#fields').validate({
			ignore:".hidden",
			invalidHandler: function(form, validator) {
				show_message('error','¡Error!','Tienes que llenar todos los campos');
			},
			submitHandler: function(form) {
				
				var myDropzone = Dropzone.forElement(".dropzone");
				if (myDropzone.getQueuedFiles().length === 0) {
					show_message('error','¡Error!','Tienes que agregar un archivo');
				}else{
					$('.loader').css('display','block');
					myDropzone.processQueue();
				}
					
				
				
			}
		});
		
		$("body").on('click', '.submit', function(e) {
			e.preventDefault();
    		$('#fields').submit();
    		
		});

		$("body").on('click', '.select', function(e) {
			e.preventDefault();
			target = $(this).closest('.profile');
			console.log(target);
			$('.profile').each(function(){
				$(this).removeClass('selected');
			});

    		$('.profile-selection').val(target.data('id'));
			target.addClass('selected');
    		
		});

		$('.owl-carousel').owlCarousel({
			loop:false,
			margin:10,
			nav:true,
			items:4,
			autoplay:true,
			autoplayTimeout:5000
		});


		function register(){
			conection('POST', $('#fields').serialize(),'/songs',true).then(function(data){
				if(data.success == 1){
					show_message('success','¡Listo!','Tu canción fue registrada',data.redirect);
				}else{
					show_message('error','Error!',data.message);
				}
			});
		}

	});