$(function () {
	'use strict';

	$('form').submit( (e) => {
		e.preventDefault()
		const that = $(this)
		const url = that.attr('action')
		var params = $('form').serializeArray()
		$.ajax({
			beforeSend: ()=>{
				$('.spinner').css('display','block')
			},
			complete: ()=> {
				$('.spinner').css('display','none')
			},
			url: url,
			data: params,
			type: 'POST',
			dataType: 'JSON',
			success: (res)=> {
				let data = res.data;
				if(res.status === true) {
					if (typeof(res.redirect.page) != 'undefined') {
						return window.location.href = baseUrl + res.redirect.page
					}
				}
			},
			error: (err)=> {
				console.log(err)

			}
		});
	})
});