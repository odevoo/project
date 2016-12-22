
$(function($){
	$('.subject-search').on('mouseenter', rotate);
	function rotate(){
		for(var i=1;i<20;i++) {
			(function (local_i) {
				$('#hair' + local_i).removeClass('rotate');
				setTimeout(function(){
					$('#hair' + local_i).addClass('rotate');
	        //document.getElementById('hair' + local_i).classList.add('rotate');
	    }, 100 * local_i);
			})(i);
		}
	}
});