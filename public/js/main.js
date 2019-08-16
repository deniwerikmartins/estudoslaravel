$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$("#teste").click(function(event) {	

	$.ajax({
		url: './teste/1',
		type: 'POST',
		data: {
			msg: 'do post'
		},
		success: function(data){
			console.log(data);
		}
	});
	
});