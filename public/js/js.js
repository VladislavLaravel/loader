$(function () {

	$('.sort-js').click(function (e) {

		var name = $(this).data('name');
		var old_name = $('.name-js').val();

		var price_direction = $('.direction-js').val();

		if(name != old_name){
			$(".name-js").val(name);
			$(".direction-js").val('asc');
			$(".vacancies-filter-js").submit();
		}else{
			if(price_direction == 'asc'){
				$(".direction-js").val('desc');
			}else{
				$(".direction-js").val('asc');
			}
			$(".vacancies-filter-js").submit();
		}
	});

})