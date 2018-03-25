
Dropzone.options.addImages = {
	maxfileSize: 0,
	maxFiles: 5,
	acceptedFiles: 'image/*',
	success: function(file, response) {
		if (file.status == 'success') {
			handleDropzoneFileUpload.handleSuccess(response);
		} else {
			handleDropzoneFileUpload.handleError(response);
		}
	},

	init: function() {
	    this.on("maxfilesexceeded", function(file){
	        alert("No more files please!");
	    });
  	}

};

var handleDropzoneFileUpload = {
	handleError: function(response) {
		console.log(response);
	},
	handleSuccess: function(response) {
		var imageList = $('#gallery-images');
		$(imageList).append("<div class='col-sm-4 p-2'><div class='g-image' style='background-image: url(" +'"'+  response.image +'"'+ ");'></div></div>");
	},
}


$(document).ready(function(){
		console.log('Document is ready')
	});
