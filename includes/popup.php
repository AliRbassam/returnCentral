
<div class="popup hidden" id="popupMsg">

	<div class="content">

        <div class="closeBtn clickable"></div>

        <div class=" text textCenter big greyDark"></div>

    </div>

</div>


<script>

	function showPopupMsg(id,text,href){

		var popupId="#"+id;

		$(popupId).removeClass("hidden");

		$(popupId).find(".text").html(text);

		
		$(".closeBtn").click(function(){

			if(href==""){
				$(popupId).addClass("hidden");
			}
			else{
				window.location.href=href;
			}

		});


	}


</script>