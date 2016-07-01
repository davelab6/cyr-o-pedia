var default_content="";

$(document).ready(function(){
	
	checkURL();
	$('#nagivagation ul li a').click(function (e){

			checkURL(this.hash);

	});
	
	//filling in the default content
	default_content = $('#glyphlist').html();
	
	
	setInterval("checkURL()",250);
	
});

var lasturl="";

function checkURL(hash)
{
	if(!hash) hash=window.location.hash;
	
	if(hash != lasturl)
	{
		lasturl=hash;
		
		// FIX - if we've used the history buttons to return to the homepage,
		// fill the pageContent with the default_content
		
		if(hash=="")
		$('#glyphlist').html(default_content);
		
		else
		loadPage(hash);
	}
}


function loadPage(url)
{
	url = url.replace('#','');
	
	$.ajax({
		type: "GET",
		url: "load_page.php",
		data: 'page='+url,
		dataType: "html",
		success: function(msg){
			
			if(parseInt(msg)!=0)
			{
				$('#glyphlist').html(msg);
			}
		}
		
	});

}