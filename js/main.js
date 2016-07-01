 window.onload = function () { 
	

	$('#font_size_c').val('80 px');
	$('#font_size_c').css('color', '#FFF');

	var enc = url('?enc');
	var nombre = url('?nombre');

	$(function() {
	    $( "#sliderc" ).slider({
	      range: "min",
	      value: 80,
	      min: 48,
	      max: 300,
	      slide: function( event, ui ) {
	        $('#font_size_c').val( ui.value + 'px' )
	        $('#glyphlist a').css('width', ui.value + 'px');
			//		         .css('height', ui.value*1.5 + 'px');
	        $('.char').css('font-size', ui.value + 'px' )
				      .css('line-height', ui.value*1.3 + 'px' )
				      .css('width', ui.value + 'px');
	      }
	    });
	    //$( "#font_size_c" ).val( $( "#sliderc" ).slider( value + "px") );
	});


	$(function() {
			$('#navigation li a').click(function(e) {
		        var $this = $(this);
		        $('.selected').removeClass('selected');
		        $this.addClass('selected');
		        //$('span').css('color','red');
		        // prevent default link click
		        //e.preventDefault();
		    })
	    });

/*
	<a id="basic" href="index.php?enc=basic">Basic</a> |
		<a id="adobe" href="index.php?enc=adobe">Adobe Extended</a> | <a href="index.php?enc=ext" id="ext">Extended</a> | 
		<a id="full" href="index.php?enc=full">Full <sup>0410-048F</sup> </a> | 
		<a href="index.php?enc=sup">Supplement <sup>A640-A69F</sup></a>
*/


		/*
	$.fn.changeBG(arg){
		var col = "";
		if (arg == a) {col = "#9696c8";};
		if (arg == b) {col = "#a4a9a4"};
		if (arg == c) {col = "#af94af"};
		$('.signos').css('background','col');	
	};
		*/
/*
 	$('#ptsans').click(function (){
	 	$('#glyphlist').addClass('ptsans')
	 				   .removeClass('dejavu')
	 				   .removeClass('charis-i')
					   .removeClass('andika-r')
	 				   .removeClass('backdr');
 	});

	$('#dejavu').click(function (){
		$('#glyphlist').addClass('dejavu')
					   .removeClass('ptsans')
					   .removeClass('charis-i')
					   .removeClass('andika-r')
					   .removeClass('backdr');
 	});

	$('#backdr').click(function (){
		$('#glyphlist').addClass('backdr')
					   .removeClass('ptsans')
					   .removeClass('charis-i')
					   .removeClass('andika-r')
					   .removeClass('dejavu');
 	});

	$('#andika-r').click(function (){
		$('#glyphlist').addClass('andika-r')
					   .removeClass('ptsans')
					   .removeClass('dejavu')
					   .removeClass('charis-i')
					   .removeClass('backdr')
					   //.css('color', 'red');
 	});

	$('#charis-i').click(function (){
		$('#glyphlist').addClass('charis-i')
					   .removeClass('ptsans')
					   .removeClass('andika-r')
					   .removeClass('dejavu')
					   .removeClass('backdr');
 	});

	$('#code-i').click(function (){
		$('#glyphlist').addClass('code-i')
					   .removeClass('ptsans')
					   .removeClass('andika-r')
					   .removeClass('dejavu')
					   .removeClass('backdr');
 	});
 	
	$('#code').click(function (){
		$('#glyphlist').addClass('code')
					   .removeClass('ptsans')
					   .removeClass('andika-r')
					   .removeClass('dejavu')
					   .removeClass('backdr');
 	});
*/
}();