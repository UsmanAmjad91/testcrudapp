$(document).ready(function(){

  $('.input').focus(function(){
    $(this).parent().find(".label-txt").addClass('label-active');
  });

  $(".input").focusout(function(){
    if ($(this).val() == '') {
      $(this).parent().find(".label-txt").removeClass('label-active');
    };
  });

});



$(document).ready(function() {
    $("#form").submit(function(e) {
        e.preventDefault();
        var username = $('#username').val();
        if (username == "" || username == null) {
            // $("#username").css('border', '1px solid red');
           $("#usernamecheck").html('**Please Enter Username').css("color", "red");
           
            error = true;
        }
        // alert(is_student);
        var status = $('#status').val();
       
        var email = $("#email").val();
        if (email == "" || email == null) {
            // $("#email").css('border', '1px solid red');
             $("#emailcheck").html('**Please Enter Email').css("color", "red");
         
            error = true;
        }

        var password = $("#password").val();
        if (password == "" || password == null) {
            // $("#password").css('border', '1px solid red');
             $("#passwordcheck").html('**Please Enter Password').css("color", "red");
          
            error = true;
        }

        var confirmpassword = $("#confirmpassword").val();   
        if (password != confirmpassword) {
            $("#confirmpassword").css('border', '1px solid red');
             $("#confirmcheck").html('**Password mismatch').css("color", "red");
            error = true;
          
        }
         setTimeout(function () { 
          $('#confirmcheck').hide() ;
           $('#passwordcheck').hide();
             $('#emailcheck').hide();   
            $('#usernamecheck').hide();
            error = false;
           }, 3000);

        var error = false;


        if ((status != '') && (username != '') && (email != '') && (password != '')) {
            var formData = new FormData(this);
            $.ajax({
                url: "adduser",
                type: 'post',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                // cache: false,
                contentType: false,
                processData: false,
                success: function(msg) {
                    console.log(msg.message, msg.status);
                    $("#form")[0].reset();
                    if (msg.status == 200) {
                        alert(msg.message);
                        
                       
                    }

                }
            });
        }
      

    });

});
$(document).ready(function() {
    $("#login").submit(function(e) {
        e.preventDefault();
       
        var email = $("#email").val();
        if (email == "" || email == null) {
            // $("#email").css('border', '1px solid red');
             $("#emailcheck").html('**Please Enter Email').css("color", "red");
         
            error = true;
        }

        var password = $("#password").val();
        if (password == "" || password == null) {
            // $("#password").css('border', '1px solid red');
             $("#passwordcheck").html('**Please Enter Password').css("color", "red");
          
            error = true;
        }

         setTimeout(function () { 
       
           $('#passwordcheck').hide();
             $('#emailcheck').hide();   
          
            error = false;
           }, 3000);

        var error = false;


        if ((email != '') && (password != '')) {
            var formData = new FormData(this);
            $.ajax({
                url: "loginuser",
                type: 'post',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                // cache: false,
                contentType: false,
                processData: false,
                success: function(msg) {
                    // $("#login")[0].reset();
                    if (msg.status == 200) {                    
                        window.location.replace("dashboard");    
                    } else{
                    alert(msg.message);
                    window.location.replace("/signin"); 
                    }    
                }
            });
        }
      

    });

});

$(document).ready(function() {
    $("#formupdate").submit(function(e) {
        e.preventDefault();
        var username = $('#username').val();
        if (username == "" || username == null) {
            // $("#username").css('border', '1px solid red');
           $("#usernameupdate").html('**Please Enter Username').css("color", "red");
           
            error = true;
        }
 
       
        var email = $("#email").val();
        if (email == "" || email == null) {
            // $("#email").css('border', '1px solid red');
             $("#emailupdate").html('**Please Enter Email').css("color", "red");
         
            error = true;
        }

         setTimeout(function () { 
          
        //    $('#passwordupdate').hide();
             $('#emailupdate').hide();   
            $('#usernameupdate').hide();
            error = false;
           }, 3000);

        var error = false;


        if ( (username != '') && (email != '')) {
            var formData = new FormData(this);
             var id = $("#admin_id").val();
            //  alert(id);
            $.ajax({
                url: "/updateuser/" + id,
                type: 'post',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(msg) {
                    console.log(msg.message, msg.status);
                    $("#formupdate")[0].reset();
                    if (msg.status == 200) {
                        alert(msg.message);
                         window.location.replace("/logout");
                    }else{
                   alert(msg.message);
                    }

                }
            });
        }
      

    });

});



$(document).ready(function() {
    $("#formchange").submit(function(e) {
        e.preventDefault();
        
           var oldpassword = $('#oldpassword').val();
        if (oldpassword== "" ||oldpassword == null) {
           $("#oldpasswordcheck").html('**Please Enter Old Password').css("color", "red");          
            error = true;
        }
       
        var newpassword = $("#newpassword").val();
        if (newpassword == "" || newpassword == null) {         
             $("#newpasswordcheck").html('**Please Enter New Password').css("color", "red");       
            error = true;
        }

        var confirmnew = $("#confirmnew").val();   
        if (newpassword != confirmnew || confirmnew == null) {
             $("#confirmnewcheck").html('**Password mismatch').css("color", "red");
            error = true;
          
        }
        var confirmnew = $("#confirmnew").val();   
        if (confirmnew == "") {
             $("#confirmnewcheck").html('**Please Enter Confirm Password').css("color", "red");
            error = true;
          
        }
         setTimeout(function () { 
          $('#confirmnewcheck').hide() ;
           $('#newpasswordcheck').hide();
             $('#oldpasswordcheck').hide();   
           
            error = false;
           }, 5000);

        var error = false;
 

        if ((oldpassword != '') && (newpassword != '') && (confirmnew != '') ) {
            var formData = new FormData(this);
             var id = $("#admins_id").val();
            //  alert(id);
            $.ajax({
                url: "/changepass/" + id,
                type: 'post',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(msg) {
                    console.log(msg.message, msg.status);
                    $("#formchange")[0].reset();
                    if (msg.status == 200) {
                        alert(msg.message);
                         window.location.replace("/logout");
                    }else{
                    alert(msg.message);
                    }

                }
            });
        }
      

    });

});

//Save product
$(document).ready(function() {
    $("#addpro").submit(function(e) {
        e.preventDefault();
    var product_code = $('#product_code').val();
			if (product_code.length == "") {    
                $("#product_codecheck").show().delay(5000).queue(function(n) {
                    $(this).hide(); n();
                  });
				$("#product_codecheck").html('** Please enter Product Code').css("color", "red");
				$('#product_codecheck').focus();
				$('#product_codecheck').css("color", "red");
			} else {
				$('#product_codecheck').hide();
			}
    var product_name = $('#product_name').val();
    if (product_name.length == "") {    
        $("#product_namecheck").show().delay(5000).queue(function(n) {
            $(this).hide(); n();
          });
        $("#product_namecheck").html('** Please enter Product Name').css("color", "red");
        $('#product_namecheck').focus();
        $('#product_namecheck').css("color", "red");
    } else {
        $('#product_namecheck').hide();
    }
    var product_price = $('#product_price').val();
    if (product_price.length == "") {    
        $("#product_pricecheck").show().delay(5000).queue(function(n) {
            $(this).hide(); n();
          });
        $("#product_pricecheck").html('** Please enter Product Price').css("color", "red");
        $('#product_pricecheck').focus();
        $('#product_pricecheck').css("color", "red");
    } else {
        $('#product_pricecheck').hide();
    }
    if (!product_code == "", !product_name == "", !product_price == "") {
        var formData = new FormData(this);
       $.ajax({
           url: "/addproduct",
           type: 'post',
           data: formData,
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           dataType: 'json',
           contentType: false,
           processData: false,
           success: function(msg) {
               console.log(msg.message, msg.status);
               $("#addpro")[0].reset();
               
            //    $('#Modal_Add').modal('hide');
               show_product();
               if (msg.status == 200) {
                   alert(msg.message);
                   $('#Modal_Add').modal('hide');
               }else{
               alert(msg.message);
               }

           }
       });
    }
    // return false;
  });


  show_product(); //call function show all product

        
  
        //function show all product
        function show_product() {
            $.ajax({
                url: "/showproduct",
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                contentType: false,
                processData: false,
            success: function(data) {
                var items = data.data.data;
                // const  res = JSON.stringify(items);
               
                // console.log(items);
            //   $.each (data, function (key , value) {
              var i;
              var html = '';
              for (i = 0; i < items.length; i++) {   
                html += '<tr>' +
                  '<td>' + items[i].product_id + '</td>' +
                  '<td>' + items[i].product_code + '</td>' +
                  '<td>' + items[i].product_name + '</td>' +
                  '<td>' + items[i].product_price + '</td>' +
                  '<td style="text-align:right;">' +
                    '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-toggle="modal"  data-target="#Modal_Edit" data-product_id="' + items[i].product_id + '" data-product_code="' + items[i].product_code + '" data-product_name="' + items[i].product_name + '" data-price="' + items[i].product_price + '">Edit</a>' + ' ' +
                  '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-toggle="modal" data-target="#Modal_Delete" data-product_id="' + items[i].product_id + '" data-product_code="' + items[i].product_code + '">Delete</a>' +
                  '</td>'+
                  '</tr>';
              }
             
            //   $('#show_data').html(html);
            // });
            //   $('#show_data').empty();
            // const obj = JSON.parse(data);
            
            //   $('#show_data').html(html);
              $('#show_data').append(html);
              $('#pagination').html(data['pagination']);   
              
            }

          });
        }

//get data for update record
$('#show_data').on('click', '.item_edit', function() {
    var product_id = $(this).data('product_id');
    var product_code = $(this).data('product_code');
    var product_name = $(this).data('product_name');
    var price = $(this).data('price');

    $('#Modal_Edit').modal('show');
    $('[name="product_id_edit"]').val(product_id);
    $('[name="product_code_edit"]').val(product_code);
    $('[name="product_name_edit"]').val(product_name);
    $('[name="product_price_edit"]').val(price);
  });
$("#close").on('click',function() {
    $('#Modal_Edit').modal('hide');
});

// Update Record //

$("#editpro").submit(function(e) {
    e.preventDefault();
    var product_id_edit = $('#product_id_edit').val();
        if (product_id_edit.length == "") {    
            $("#product_id_editcheck").show().delay(5000).queue(function(n) {
                $(this).hide(); n();
              });
            $("#product_id_editcheck").html('** Please dont,t Remove Product Id').css("color", "red");
            $('#product_id_editcheck').focus();
            $('#product_id_editcheck').css("color", "red");
        } else {
            $('#product_id_editcheck').hide();
        }
var product_code_edit = $('#product_code_edit').val();
        if (product_code_edit.length == "") {    
            $("#product_code_editcheck").show().delay(5000).queue(function(n) {
                $(this).hide(); n();
              });
            $("#product_code_editcheck").html('** Please enter Product Code').css("color", "red");
            $('#product_code_editcheck').focus();
            $('#product_code_editcheck').css("color", "red");
        } else {
            $('#product_code_editcheck').hide();
        }
var product_name_edit = $('#product_name_edit').val();
if (product_name_edit.length == "") {    
    $("#product_name_editcheck").show().delay(5000).queue(function(n) {
        $(this).hide(); n();
      });
    $("#product_name_editcheck").html('** Please enter Product Name').css("color", "red");
    $('#product_name_editcheck').focus();
    $('#product_name_editcheck').css("color", "red");
} else {
    $('#product_name_editcheck').hide();
}
var product_price_edit = $('#product_price_edit').val();
if (product_price_edit.length == "") {    
    $("#product_price_editcheck").show().delay(5000).queue(function(n) {
        $(this).hide(); n();
      });
    $("#product_price_editcheck").html('** Please enter Product Price').css("color", "red");
    $('#product_price_editcheck').focus();
    $('#product_price_editcheck').css("color", "red");
} else {
    $('#product_price_editcheck').hide();
}
if (!product_code_edit == "", !product_name_edit == "", !product_price_edit == "") {
    var formData = new FormData(this);
    var id = $('#product_id_edit').val();
   $.ajax({
       url: "/updateproduct/" + id,
       type: 'post',
       data: formData,
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       dataType: 'json',
       contentType: false,
       processData: false,
       success: function(msg) {
           console.log(msg.message, msg.status);
           $("#editpro")[0].reset();
       
        //    $('#Modal_Edit').modal('hide');
           $('#Modal_Edit').fadeOut('hide');
           
        location.reload()
           show_product();
           if (msg.status == 200) {
            // $('#success').appand(msg.message);
               alert(msg.message);
          
           }else{
           alert(msg.message);
           }

       }
   });
}
// return false;
});


// Delete Record //
//Get record//
//get data for update record
$('#show_data').on('click', '.item_delete', function() {
    var product_id = $(this).data('product_id');
    

    $('#Modal_Delete').modal('show');
    $('[name="product_id_delete"]').val(product_id);
    
  });
$("#closed").on('click',function() {
    $('#Modal_Delete').modal('hide');
});
//
function closed_modal(){
$('#Modal_Delete').modal('hide');
location.reload();
}
//Del
$("#delpro").submit(function(e) {
    e.preventDefault();
   var  product_id_delete = $('#product_id_delete').val();
 
if (!product_id_delete == "") {
    var formData = new FormData(this);
    var id = $('#product_id_delete').val();
   $.ajax({
       url: "/deleteproduct/" + id,
       type: 'post',
       data: formData,
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       },
       dataType: 'json',
       contentType: false,
       processData: false,
       success: function(msg) {
           console.log(msg.message, msg.status);
           $("#delpro")[0].reset();
       
        //    $('#Modal_Edit').modal('hide');
        //    $('#Modal_Edit').fadeOut('hide');
        // $("#closed").on('click',function() {
            closed_modal();

        // });
        // location.reload()
           show_product();
           if (msg.status == 200) {
            // $('#success').appand(msg.message);
               alert(msg.message);
          
           }else{
           alert(msg.message);
           }

       }
   });
}
// return false;
});



});