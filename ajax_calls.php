<!DOCTYPE html>
<html>
<head>
	<title>Ajax Calls</title>
</head>
<body>
<div id="loading" style="display:none"><img src="assets/images/loading.gif"></div>
<div id="target_div"></div>

<script>
    function AjaxHTMLCall(local_var)
    {
      $("#target_div").html($("#loading").html());
      jQuery.post(
        "ajax_html_requests.php",
        {
            server_var: local_var
        },
        function (response)
        {
            $("#target_div").html(response);
        }, 'html');
    }

    function AjaxJsonCall(local_var)
    {
      $("#target_div").html($("#loading").html());
      jQuery.post(
        "ajax_json_requests.php",
        {
            server_var: local_var
        },
        function (response)
        {
	        var errmsg = response.errormsg;
	        var newcontent = "";
	        if (errmsg == "")
	        {
	            otherLocalVar = response.otherServerVar;
	            newcontent = otherLocalVar;
	         } else {
	            newcontent = errmsg;
	        }
	        $("#target_div").html(newcontent);
        }, 'json');
    }

    $(document).ready(function() {
    	// when document ready do...
    });
</script>
</body>
</html>