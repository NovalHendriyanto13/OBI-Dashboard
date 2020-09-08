$(function () {
	'use strict';

	let form = $('form')
	form.submit( function(e) {
		e.preventDefault()
		var that = $(this)
		var url = that.attr('action')
		var params = that.serializeArray()
		var method = that.attr('method')

		const alert = $('.alert')
		const alertMsg = $('.alert-msg')
		if (typeof(method) === 'undefined') {
			alertMsg.html('Error ! Please provide form method')
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
			url: baseUrl + url,
			data: params,
			type: method,
			dataType: 'JSON',
			success: (res)=> {
				let data = res.data;
				if(res.status === true) {
					if (typeof(res.redirect.page) != 'undefined') {
						return window.location.href = baseUrl + res.redirect.page
					}
				}
				else {
					alertMsg.html('Error ! ' + res.errors.messages)
					alert.css('display','block')
				}
			},
			error: (err)=> {
				console.log(err)

				$('.alert-msg').html('Error ! ' + err.errors.messages)
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

    let select2 = $('.select2')
    if (select2.length > 0) {
    	select2.select2({
          placeholder: 'Select one',
          searchInputPlaceholder: 'Search options',
          allowClear: true
        });
    }
});