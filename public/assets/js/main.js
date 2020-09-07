$(function () {
	'use strict';

	$('form').submit( (e) => {
		e.preventDefault()
		const that = $(this)
		const url = that.attr('action')
		var params = $('form').serializeArray()
		var method = that.attr('method')

		const alert = $('.alert')
		const alertMsg = $('.alert-msg')

		if (typeof(method) === 'undefined') {
			alertMsg.html('Error !')
			alert.css('display','block')
			return false;
		}
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

				$('.alert-msg').html('Error ! ')
				$('.alert').css('display','block')
			}
		});
	})

	let dataTable = $('.datatable')
	if (dataTable.length > 0) {
		dataTable.DataTable({
    	  	responsive: true,
      		language: {
        		searchPlaceholder: 'Search...',
        		sSearch: '',
        		lengthMenu: '_MENU_ items/page',
      		}
    	});
    }
});