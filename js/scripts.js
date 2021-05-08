$( window ).ready(function(){
	var clipboard = new Clipboard('.ip-copy');
	clipboard.on('success', function(e) {
		swal({
			title: "Başarılı..!", 
			text: "IP adresi kopyalandı!",
			type: "success",
			confirmButtonColor: "#8CC152",
			confirmButtonText: "Tamam"
		});
	});
});		
