<?php
	require("header.php");
?>
<body>
	<script type="text/javascript">
		$(document).on('change','.brand',function(){
		   var url = "brand.php";
		   $.ajax({
			 type: "POST",
			 url: url,
			 data: $(".cauta_brand").serialize(),
			 success: function(data)
			 {                  
				$('.ccauta_brand').html(data);
			 }               
		   });
		  return false;
		});
	</script>
</body>

