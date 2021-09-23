$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	$( "#board_form" ).validate({
	    // define validation rules
	    rules: {
	        productTitle: {
	        	required: true,
	        },
	        productLicenseUrl: {
	        	required: true
	        },
	        productMoreInfo: {
	        	required: true
	        },
	        productIdx: {
	        	required: true
	        }
	    },
	    //display error alert on form submit  
	    invalidHandler: function(event, validator) {     
	        var alert = $('#m_form_1_msg');
	        alert.removeClass('m--hide').show();
	        mUtil.scrollTop();
	        setTimeout(function(){
	        	$('#m_form_1_msg').addClass('m--hide').hide();
	        }, 5000);
	    },
	    submitHandler: function (form) {
			$(':input[type="submit"]').prop('disabled', true);
			let formData = new FormData($('#board_form')[0]);
	    	$.ajax(
                    {
                        url: WEBSITE_URL+"/admin/products/update", 
                        type: "POST",
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
						data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result) 
                                {   
                                	console.log(result);
                                    if(result == "success")
                                    {
                                        window.location.href = WEBSITE_URL+"/admin/products";
                                    }else{
										$(':input[type="submit"]').prop('disabled', false);
                                    	window.alert(result);
                                    }
                                },
                        error: function (msg) 
                                {
                                    console.log('error', msg);
									$(':input[type="submit"]').prop('disabled', false);
									window.alert("Oops! An error occurred, please try again later.");
                                }
                    }
                );
	    }
	});  
	
	
});

function wantDelete(record_idx){
	swal({
	  title: "Are you sure?",
	  text: "This action can not be undone.",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Yes, Delete it",
	  cancelButtonText: "No",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm) {    
	  if (isConfirm) {
		$.ajax({
		  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  },
		  url: WEBSITE_URL+'/admin/offers/delete/'+record_idx,
		  /* url: '/admin/offers/delete/'+record_idx, */
		  method: 'post',
		  success: function(res){
			if(res=="success"){
			  window.location.reload();
			  //window.location.href= WEBSITE_URL+"/admin/offers";
			}
		  }
		});
	  }else 
		swal("Cancelled", "Action has been cancelled", "error");
	});
  }
  