  $(document).ready(function(){

 	$("#WebAccount_scriptID").change(function() {

 		var checkScript = $(this).val();
		var postParam = "script="+checkScript;
		$.ajax({
			type: "POST",
			url: "/apanel/index.php?r=webAccount/list",
			data: postParam,
			success: function(res_query) {
				var $el = $("#WebAccount_defaultProxyID");
				$el.empty();
				$el.append(res_query);
				$el.select2({'placeholder':'Please select Proxy','width':'resolve'});

			}
		});
	});

  });