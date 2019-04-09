 $(document).on('submit', '#search-form',function(event){
   event.preventDefault();
   $('#result').text('');
   $('#loader').removeClass('hidden');
        event.preventDefault();
            $.ajax({
                url:"app/data.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data)
                    {
                    $('#loader').addClass('hidden');
                    $('#result').html(data);
                    }
                    else
                    {
                    errorNotifier(data);   
                    }
                }
            });

});

$('#signup').click(function(){
//$('#signup_form')[0].reset();
$('#signupModal').removeClass('hide');
});

$('#login').click(function(){
//$('#loginModal').modal('show');
$('#login_form')[0].reset();
$('#loginModal').removeClass('hide');
});

$('#dashboard').click(function(){
    window.open('dashboard','_self');
});

$('#logout').click(function(){
    window.open('logout','_self');
});
$('#home').click(function(){
    window.open('index','_self');
});

$('#product').click(function(){
$('#product_form')[0].reset();
    $('#upload_type').removeClass('hidden');
    $('#upload_label').removeClass('hidden');
                    
    $('.modal-title').text('Update Drug');
    $('#operation').val('Upload');
    $('#action').val('upload');
    
});

$('#donate').click(function(){
successNotifier("coming soon");
});

       




	    function loadstate() 
        {
            var action = "fetch_states";
            $.ajax({

			url:"app/data.php",
			method:"POST",
			data:{action:action},
			dataType:"text",
			success:function(data)
			{
				$('#state').html(data);
			}

            });
        }
    
      function loadstate_() 
        {
            var action = "fetch_states";
            $.ajax({

			url:"app/data.php",
			method:"POST",
			data:{action:action},
			dataType:"text",
			success:function(data)
			{
				$('#state_').html(data);
			}

            });
        }
    


                $('#user_type').on('change', function() {
                    var sel = $("#user_type option:selected").val();
                    if (sel == "Hospital") {
                        $('#name_hidden').removeClass('hidden');
						$('#hospital_type').removeClass('hidden');
				
				    } else {
                        $('#name_hidden').addClass('hidden');
						$('#hospital_type').addClass('hidden');
			    	}
                  //  console.log(sel);
                });
        

                 $('#user_type').on('change', function() {
                    var sel = $("#user_type option:selected").val();
                    if (sel != "user") {
                        $('#state_label').removeClass('hidden');
						$('#state').removeClass('hidden');
                        $('#lga_label').removeClass('hidden');
						$('#lga').removeClass('hidden');
                        $('#address_label').removeClass('hidden');
						$('#address').removeClass('hidden');
                        loadstate();        
				    } else {
                        $('#state_label').addClass('hidden');
						$('#state').addClass('hidden');
                        $('#lga_label').addClass('hidden');
						$('#lga').addClass('hidden');
                        $('#address_label').addClass('hidden');
						$('#address').addClass('hidden');
                	}
                //    console.log(sel);
            });
            
    
            $('#upload_type').on('change', function() {
                    var sel = $("#upload_type option:selected").val();
                    if (sel == "excel") {
                        $('#upload_file').removeClass('hidden');
						$('#upload_label').removeClass('hidden');
					    $('#instr').removeClass('hidden');
						$('#drug_name').addClass('hidden');
						$('#drug_desc').addClass('hidden');
						$('#pre').addClass('hidden');
                    	$('#status').addClass('hidden');
                    	$('#qty').addClass('hidden');
                        $('#qty_label').addClass('hidden');
                        $('#name_label').addClass('hidden');
                        $('#desc_label').addClass('hidden');
                        $('#pre_label').addClass('hidden');
                    	$('#status_label').addClass('hidden');
                 

				    } else {
                        $('#upload_file').addClass('hidden');
						$('#upload_label').addClass('hidden');
						$('#instr').addClass('hidden');
						$('#drug_name').removeClass('hidden');
						$('#drug_desc').removeClass('hidden');
						$('#pre').removeClass('hidden');
                    	$('#status').removeClass('hidden');
                        $('#name_label').removeClass('hidden');
                        $('#desc_label').removeClass('hidden');
                    	$('#pre_label').removeClass('hidden');
                    	$('#status_label').removeClass('hidden');
                        $('#qty').removeClass('hidden');
                        $('#qty_label').removeClass('hidden');
                        
					}
                    //console.log(sel);
                });
        
       	$('#state').change(function(){
			var state = $(this).val();
            var action = "fetch_lga";
            $.ajax({
			url:"app/data.php",
			method:"POST",
			data:{action:action,state:state},
			dataType:"text",
			success:function(data)
			{
				$('#lga').html(data);
			}
			});
		});

            $('#state_').change(function(){
			var state = $(this).val();
            var action = "fetch_lga";
            $.ajax({
			url:"app/data.php",
			method:"POST",
			data:{action:action,state:state},
			dataType:"text",
			success:function(data)
			{
				$('#lga_').html(data);
			}
			});
		});


        
    $(document).on('submit', '#signup_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/data.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                    successNotifier("You have registered successfully");   
                    $('#signupModal').modal('hide');
                    }
                    else
                    {
                    errorNotifier(data);   
                    }
                }
            });
        });  
    
        

    $(document).on('submit', '#login_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/data.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                    successNotifier("Welcome");   
                    window.open('dashboard','_self');
                    }
                    else
                    {
                    errorNotifier(data);   
                    }
                }
            });
        });  
    
        $(document).on('submit', '#product_form',function(event){
        event.preventDefault();
            $.ajax({
                url:"app/data.php",
                method: "POST",
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if (data == "success")
                    {
                    successNotifier("Your action was successful");   
                    $('#productModal').modal('hide');
                    $('#product_form')[0].reset();
                    $('#product_table').bootstrapTable('refresh', {url:'app/data.php?action=fetch'});
                   
                    }
                    else
                    {
                    errorNotifier(data);   
                    }
                }
            });
        });  
    
    
       
       
       $(document).on('click', '.update', function()
        {
         var id = $(this).attr("id");
         var qty = $('#qty'+id).val();
         var action = "update";
           $.ajax({
                url:"app/data.php",
                method: "POST",
                data: {action:action, id:id, qty:qty},
                success:function(data)
                {
                    if (data == "success")
                    {
                    successNotifier("You have updated your product quantity successfully");   
                    $('#product_table').bootstrapTable('refresh', {url:'app/data.php?action=fetch'});
                   
                    }
                    else
                    {
                    errorNotifier(data);   
                    }
                }
            });
        });
       
       $(document).on('click', '.viewer', function()
        {
         var id = $(this).attr("id");
         
         var action = "fetch_single";
           $.ajax({
                url:"app/data.php",
                method: "POST",
                data: {action:action, id:id},
                dataType:"json",
                success:function(data)
                {
                    if (!data.error)
                    {
                    $('#upload_file').addClass('hidden');
                    $('#upload_label').addClass('hidden');
                    $('#instr').addClass('hidden');
                    $('#upload_type').addClass('hidden');
                    $('#upload_label').addClass('hidden');
                    $('.modal-title').text('Update Drug');
                    $('#operation').val('Update');
                    $('#action').val('update_');
                    $('#id_').val(id);
                   	$('#drug_name').val(data.name);
                    $('#drug_desc').val(data.desc);
                    $('#pre').val(data.pre);
                    $('#status').val(data.status);
                    $('#qty').val(data.qty);
                    
                    $('#productModal').modal('show');
                    }
                    else
                    {
                    errorNotifier(data.error);   
                    }
                }
            });
        });


       $(document).on('click', '.view_drug', function()
        {
         var id = $(this).attr("id");
         var action = "fetch_drug";
           $.ajax({
                url:"app/data.php",
                method: "POST",
                data: {action:action, id:id},
                dataType:"json",
                success:function(data)
                {
                    if (!data.error)
                    {
                   	$('#d_name').text(data.drug_name);
                    $('#d_desc').text(data.drug_desc);
                    $('#d_req').text(data.presc);
                    $('#d_status').text(data.status);
                    $('#d_qty').text(data.qty);

                    $('#d_insti').text(data.type);
                    $('#d_real_name').text(data.name);
                    $('#d_address').text(data.address);
                    $('#d_email').text(data.email);
                    $('#d_gsm').text(data.gsm);


                    $('#vModal').modal('show');
                
            
                    }
                    else
                    {
                    errorNotifier(data.error);   
                    }
                }
            });
        });



        // success message notifier ..
        function successNotifier(message = "Action Successful")
        {

            $('#msg').text(message);
            $('#color').removeClass('alert-danger').addClass('alert-success');
            $('#msgModal').modal('show');
            setTimeout(function(){
            $('#msgModal').modal('hide');
            }, 3000);
        }

        // error message notifier ..
        function errorNotifier(message = "An Error Occured, Try Again")
        {
            $('#msg').text(message);
            $('#color').removeClass('alert-success').addClass('alert-danger');
            $('#msgModal').modal('show');
            setTimeout(function(){
            $('#msgModal').modal('hide');
            }, 3000);
        }
  

  