$(document).ready(function() {

		/**
		 * call the data.php file to fetch the result from db table.
		 */
		$.ajax({
				url : "http://ec2-13-56-14-28.us-west-1.compute.amazonaws.com/api/data.php",
				type : "GET",
				success : function(data){
						console.log(data);
				},
				error : function(data) {
						console.log(data);
				}
		});

});

