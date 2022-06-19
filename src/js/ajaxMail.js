function sendMailClick(){

	//Setting mail --> https://symfony.com/doc/current/email.html

	var email = $("#email").val();
	var name = $("#name").val();
	var obj = $("#subject").val();
	var msg = $("#message").val();
	var pj = $('#pj').prop("files")[0];

	var formData = new FormData();
	formData.append('email', $("#email").val());
	formData.append('name', $("#name").val());
	formData.append('obj', $("#subject").val());
	formData.append('msg', $("#message").val());
	formData.append('pj', $('#pj').prop("files")[0])

	if (email !== null && name !== null && obj !== null && msg !== null ) {

		$.ajax({
	    	type: "POST",
	    	url: "http://localhost/boxracing/public/sendmail",
	    	data: formData,
	    	processData: false,
			contentType: false
		})
		.done(function(data){

		    if (typeof data.status != "undefined" && data.status != "undefined")
		    {
		        // At this point we know that the status is defined,
		        // so we need to check for its value ("OK" in my case)
		        if (data.status == "OK")
		        {
		            document.getElementById("alert-mail").style.visibility= 'visible' ;
		        }
		    }
		});

	} else {
		//Add response her if error
	}

}