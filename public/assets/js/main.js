$(function () {
  'use strict';

  let form = $('form')
  form.submit( function(e) {
    e.preventDefault()
    var that = $(this)
    var url = that.attr('action')
    // var params = that.serializeArray()
    var method = that.attr('method')
	
    var params = new FormData(this);
    const alert = $('.alert')
    const alertForm = $('.alert-form')
    const alertMsg = $('.alert-msg')
    if (typeof(method) === 'undefined') {
      alertMsg.html('Error ! Please provide form method')
      alertForm.css('display','block')
      return false;
    }
    alert.css('display','none');
    /*
     * used for additional parameter and not in form generated
     */
    if (typeof(additionalParams) != 'undefined') {
      params.append('additional', additionalParams)
    }

    $.ajax({
      url: baseUrl + url,
      data: params,
      type: method,
      dataType: 'JSON',
      // cache:false,
      contentType: false,
      processData: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      beforeSend: ()=>{
        $('.spinner').css('display','block')
      },
      complete: ()=> {
        $('.spinner').css('display','none')
      },
      success: (res)=> {
        let data = res.data
        if(res.status === true) {
          if (typeof(res.redirect.page) != 'undefined') {
            return window.location.href = baseUrl + res.redirect.page
          }
        }
        else {
          if (typeof(res.errors.messages) === 'object') {
            let errId
            $.each((res.errors.messages), function(i, v) {
              errId = $('#'+i+'-errors')
              var errMessage = ''
              $.each(v, function(ix, error) {
                errMessage = errMessage + error + '<br/>'
              })
              errId.html(errMessage)
              errId.css('display','block')
            })
            alertMsg.html('Error ! Some errors in your input')
          }
          else {
            alertMsg.html('Error ! ' + res.errors.messages)
          }
          alertForm.css('display','block')
        }
      },
      error: (err)=> {
        console.log(err)
        console.log('error-request')
        alertMsg.html('Error ! Something error in your input')
        alertForm.css('display','block')
      }
    });
  })

  let dataTable = $('.datatable')
  if (dataTable.length > 0) {
    let searchable = dataTable.data('searchable')
    let source = dataTable.data('source')
    let columns = dataTable.data('columns')
    let paramsFilter = {};

    let dataTableConfig = {
      responsive: true,
      processing: true,
      serverSide: true,
      ajax: {
        url: source,
        data: function(d) {
          d.custom_filters = paramsFilter
        }
      },
      columns: (columns),
      dom:'lfrtip',
      bAutoWidth: false,
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
      },
      columnDefs: [ {
       // orderable: false,
       // className: 'select-checkbox',
	   // targets:   0,
      } ],
    }
    const dt = dataTable.DataTable(dataTableConfig)
    if (searchable > 0) {
      const advanceFilterHtml = '<div class="advance-filter" style="display:inline"><a href="#advance-filter-form" data-toggle="collapse">Advance Filter</a></div>';
      const filterHtml = $('div.dataTables_filter').find('label').css('display','inline')
      $('div.dataTables_filter').prepend(advanceFilterHtml)

      $('.input-filter').on('keyup', function(e) {
        const that = $(this)
        $('.input-filter').each(function(i, a) {
          var name = $(a).attr('name')
          var value = $(a).val()
          if (value != '') {
            paramsFilter[name] = value
          }
        })
        dt.draw()
      })
    }
  }
  
  $('#table-checkall').on('click', function(){
    var rows = $('.table');
    $('.table-check', rows).prop('checked', this.checked);
  })
	 
  $('.btn-bulk-actions').click(function(){
    var action = $('select[name=action_bulk]').val()
    if (action == '')
	  return false;

    var path = window.location.href
    var checked = []
    $('.table-check:checked').each(function(){
      checked.push($(this).val())
    })
    $.ajax({
      url : path,
      type: 'GET',
      data: {
        action: action,
        data: JSON.stringify(checked),
      },
      dataType: 'JSON',
      success: function(res){
        
        if(res.status === true) {
          if (typeof(res.redirect.page) != 'undefined') {
            // return window.location.href = baseUrl + res.redirect.page
          }
        }
      }
    })
  })

  let select2 = $('.select2')
  if (select2.length > 0) {
    select2.select2({
	  placeholder: 'Select one',
      searchInputPlaceholder: 'Search options',
      allowClear: true
    })
  }

  let ajaxCall = $('select.ajax-call')
  if (ajaxCall.length > 0) {
    ajaxCall.change(function(e){
      e.preventDefault();
      let that = $(this)
      let to = that.attr('ajax-to')
      let href = that.attr('ajax-href')
      let lenBaseUrl = baseUrl.length

      $.ajax({
        url : href,
        type: 'GET',
        data: {
          value:that.val()
        },
        success:(res) => {
          if (to.substring(0, lenBaseUrl) == baseUrl) {
            window.location.href = to
          }
          else {
            if (typeof(res.data.value)=='undefined') {
              $(to).removeAttr('readonly')
              $(to).val('')
            }
            else {
              if (res.data.value != '') {
                $(to).val(res.data.value)
                $(to).attr('readonly', true)
                return true
              }
			}
          }
          return true;
        }
      })
    })
  }

  let datePicker = $('.datepicker')
  if (datePicker.length > 0) {
    datePicker.datepicker({
	  showOtherMonths: true,
      selectOtherMonths: true,
      changeMonth: true,
      changeYear: true,
      dateFormat : 'yy-mm-dd',
    })
  }

  let inputImage = $('.input-image')
  if (inputImage.length > 0) {
    inputImage.on('change',function(){
      let thisId = $(this).attr('id')
      let reader = new FileReader()
      reader.onload = (e) => {
        let preview = $('#'+thisId+'-preview') 
        preview.attr('src', e.target.result)
        preview.css('display','block')

        let remove = $('#'+thisId+'-preview-remove') 
        remove.css('display','block')
      }
      reader.readAsDataURL(this.files[0])
    })
  }

  let removePreview = $('.remove-preview')
  if (removePreview.length > 0) {
    removePreview.on('click',function(e){
      e.preventDefault()
      let target = $(this).data('target')
      $('#'+target).removeAttr('src')
      $('#'+target).css('display','none')

      let targetFile = $(this).data('file')
      console.log($('#'+targetFile).val())
      $('#'+targetFile).val('')
    		
      $(this).css('display','none')

    })
  }
	
  let timepicker = $('.timepicker');
  if (timepicker.length > 0) {
    var dt = new Date()
    var defaultTime = dt.getHours() + ":00"
      timepicker.timepicker({
        timeFormat: 'HH:mm',
        interval: 30,
        startTime: '09:00',
        // defaultTime: defaultTime,
        dynamic: false,
        dropdown: true,
        scrollbar: true
    })
  }
});