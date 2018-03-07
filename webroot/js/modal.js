$('body').on('click', 'a[data-action="modal-open"]', function(event){
	$('#modal').css({
		'visibility': 'visible'
	});
});

$('body').on('click', '#modal', function(event){
	$('#modal').css({
		'visibility': 'hidden'
	});
});
