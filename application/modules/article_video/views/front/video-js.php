<script src="<?= base_url("asset/js/jquery-3.2.0.min.js"); ?>"></script>
<script>
	$(document).ready(function(){
		// changeVideo('OMDJY6Fh9YY');
		var api  = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=PLlCQXfeG_aFS3lAtr4yM1ucicsZYhKAeR&key=AIzaSyDqoEcyjaSCam5od9bi9iqC9UcLJJW1U2Q";

		$.ajax({
			url : api,
			type: 'GET',
			success: function (response) {
				console.log(response);
				$.each(response, function (index, value) {
                    // console.log(response.firstname);
                    // console.log(JSON.stringify(response));
                    console.log(response.items[0]);
                    // console.log(value.id);
					for (var i = 0; i < response.items.length; i++) {
					    console.log(JSON.stringify(response.items[i]));
					    // console.log(response.items[i]);
					    
					}
                })
			}
		})
	});

	function changeVideo(URL){
	  var iframe=document.getElementById("iframeYoutube");
	  iframe.src= URL;

	  $("#myModal").modal("show");
	}

	$('#myModal').on('shown.bs.modal', function () {
	    $(this).removeData('bs.modal');
	});
</script>