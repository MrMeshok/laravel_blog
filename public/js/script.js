$(document).ready(function() {
	$(document).on("click", ".reply_button", function() {
		var id = $(this).attr('id')
		// $("#reply_form_"+id).toggle(400)
		$($(this).next()).toggle(400)
	});

	$("#all_comments").click(function() {
		var id = $(this).attr('data')
		$("#all_comments").remove()
		jQuery.ajax({
			url: 'all_comments/'+id,
			success:function(data){
				$(".card-body-comments").append(data)
			},
			error:function (){
				console.log('Ошибка')
			}
		})
	});
	$("#add_book").click(function() {
		$($(this).next().next()).toggle(400)
	});
	$(".edit_book").click(function() {
		$($(this).next().next()).toggle(400)
	});
});