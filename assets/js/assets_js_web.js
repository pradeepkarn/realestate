$(document).ready(function() {
  
    var tz = jstz.determine();
    var timezone = tz.name();
    $.post(base_url+'ajax/set_timezone',{timezone:timezone},function(res){
        // console.log(res);
      })

    $.post(base_url+'ajax/currency_rate',function(res){
        //console.log(res);
      })

});

var current_language_url = '';
if(current_language=='hebrew'){
  current_language_url = 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Hebrew.json';
}else{
  current_language_url = 'http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/English.json';
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function ucwords (str) {
    return (str + '').replace(/^([a-z])|\s+([a-z])/g, function ($1) {
        return $1.toUpperCase();
    });
}

function change_language(lang,tag){
        $.post(base_url+'ajax/set_language',{lang:lang,tag:tag},function(res){
         window.location.reload();
      })   

  }


function user_currency(code){
      if(code!=""){

        $.ajax({
           type:'POST',
           url: base_url+'ajax/add_user_currency',
           data :  {code:code},
           dataType:'json',
           success:function(response)
           {  
             if(response.success)
             {
               location.reload();
           }
           else {
            location.reload();
        }
    }
});
    }
}

function please_login(){
  toastr.error(lg_please_login_to3);
}

if(modules=='call' && pages == 'add_review'){

  $("#review_form").validate({
      rules: {
          title: "required",
          review: {
             required: true,
              maxlength: 100
          },
      },
      messages: {
          title: lg_title_is_requir,
          review: {
              required: lg_review_is_requi,
              maxlength: lg_above_100_chara,
          },                  
      },
      submitHandler: function() {
        if (typeof $('input[name=rating]:checked').val() === "undefined") {
          toastr.error(lg_please_select_r);
          return false;
        }
        form.submit();
      }
  });

}

if(modules=='signin'){
  function change_role()
    {
      var role=$('#role').val();
      if(role==1)
      {
        $('#role_type').html(lang_patient);
        $('#role_types').html(lang_doctor);
        $('#role').val(2);
      }
      if(role==2)
      {
        $('#role_type').html(lang_doctor);
        $('#role_types').html(lang_patient);
        $('#role').val(1);
      }
      $('#register_form')[0].reset();
    }

    function email_verification(user_id)
    {
      $.get(base_url+'signin/send_verification_email/'+user_id,function(data){
        toastr.success(lg_activation_mail);
      });
    }

   function resend_otp() {
     // alert('dfd');
     var mobileno=$('#mobileno').val();
     var country_code=$('#country_code').val();
    
       $.ajax({
        url:base_url +'Signin/sendotp',
            data: {
          mobileno : mobileno,country_code:country_code,otpcount:'2'
        },
            //contentType: "application/json; charset=utf-8",
           dataType: "text",
            method:"post",
             beforeSend: function(){
                $('.otp_load').html('<div class="spinner-border text-light" role="status"></div>');
               },
            success:function(res){

                $('.otp_load').html('<a class="forgot-link" onclick="resend_otp()"  href="javascript:void(0);" id="resendotp">Resend OTP</a>');
                
                var obj = JSON.parse(res);    
                if(obj.status===200)
                {
                  $('.OTP').show();
                  toastr.success(obj.msg);
        
                }
                else if(obj.status===500)
                {
                   toastr.error(obj.msg);
                               
                }
                else
                {
                    toastr.error(obj.msg);
                }  
            }  
      });
      
    }

    if(pages == 'request_remarks_info_form'){

      $(document).ready(function(){

        $('#remark_btn').on('click',function(){

          var remark = $('#remark_ans').val();
          var id = $('#id').val();

          if(remark == ''){
            toastr.error(lg_please_enter_re);
            return false;
          }

          $.ajax({

            url:base_url +'signin/information_remark',
            type: "POST",
            data: {id:id,remark:remark},
            beforeSend:function() { 

              $('#remark_btn').html('<div class="spinner-border text-light" role="status"></div>');
              $('#remark_btn').attr('disabled',true);
          
            },
            success: function(res){

              $('#remark_btn').html(lg_submit);
              $('#remark_btn').attr('disabled',false);

              var obj = JSON.parse(res);    
              if(obj.status===200)
              {
                
                toastr.success(obj.msg);

                setTimeout(function(){

                  window.location.href = base_url+'signin';

                },2500);
      
              }
              else if(obj.status===500)
              {
                 toastr.error(obj.msg);
                             
              }
              else
              {
                  toastr.error(obj.msg);
              }

            }

          });

        });

      });

    }
}

if(modules=='information_form'){

  if(pages == 'form_4'){

      $('#spsubcategory').change(function(){

        if($(this).val() !=''){
          $.ajax({
            type: "GET",
            url: base_url+"ajax/get_spcategory",
            data:{id:$(this).val()}, 
            beforeSend :function(){
              $("#spservice option:gt(0)").remove(); 
              $('#spservice').find("option:eq(0)").html(lg_please_wait);
            },                         
            success: function (data) {
              /*get response as json */
              $('#spservice').find("option:eq(0)").html(lg_service_option);
              var obj=jQuery.parseJSON(data);
              $('#spservice').append(obj);
              // $('#spservice').val(specialization);

              /*ends */
              
            }
          });
        }else{
          $("#spservice option:gt(0)").remove(); 
        }
      });

      $('#spcategory').change(function(){

        if($(this).val() !=''){
          $.ajax({
            type: "GET",
            url: base_url+"ajax/get_spcategory",
            data:{id:$(this).val()}, 
            beforeSend :function(){
              $("#spsubcategory option:gt(0)").remove(); 
              $('#spsubcategory').find("option:eq(0)").html(lg_please_wait);
            },                         
            success: function (data) {
              /*get response as json */
              $('#spsubcategory').find("option:eq(0)").html(lg_subcategory1);
              var obj=jQuery.parseJSON(data);
              $('#spsubcategory').append(obj);
              // $('#spsubcategory').val(specialization);

              /*ends */
              
            }
          });
        }else{
          $("#spsubcategory option:gt(0)").remove(); 
        }
      });

      $(document).ready(function(e){

        $('#msform').on('submit',function(e){

          e.preventDefault();

          $.ajax({

            url:base_url +'information-form-submit',
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend:function() { 
              $('#info-submit').html('<div class="spinner-border text-light" role="status"></div>');
              $('#info-submit').attr('disabled',true);
            },
            success: function(res){

              $('#info-submit').html(lg_submit);
              $('#info-submit').attr('disabled',false);

              var obj = JSON.parse(res);    
              if(obj.status===200)
              {
                toastr.success(obj.msg);

                setTimeout(function(){

                  window.location.href = base_url+'information-form-success';

                },2500);
      
              }
              else if(obj.status===500)
              {
                 toastr.error(obj.msg);
                             
              }
              else
              {
                  toastr.error(obj.msg);
              }

            }

          });

        });

      });

    }
  
}

if(modules=='home')
{
  if(pages=='index')
  {

     function search_locations()
   {
    
    $('.location_result').html('');
     var search_location =  $.trim($('#search_location').val());
     if(search_location!=''){
      $.ajax({
                type: "POST",
                url: base_url+'home/search_location',
                data: 'search_location='+search_location,
                success: function(data)
                {
                                              // return false;
                  if(data.length){
                    var obj = jQuery.parseJSON(data);
                    var html = ''

                    if(obj.location!=null){

                      $(obj.location).each(function(){
                        html +='<div class="keyword-search"><a href="'+base_url+'doctors-search?location='+this.location+'">Location  - '+this.location+'</a></div>';
                      });


                    }
             
                      $('.location_result').html(html);


                  }else{
                    $('.location_result').html('<b>'+lg_no_city_found+'</b>');                                                
                  }

              }
          });


     }else{
      $('.location_result').html('');
      }

   }

   function search_keyword()
   {
    $('.keywords_result').html('');
     var search_keywords =  $.trim($('#search_keywords').val());
     if(search_keywords!=''){
      $.ajax({
                type: "POST",
                url: base_url+'home/search_keywords',
                data: 'search_keywords='+search_keywords,
                success: function(data)
                {
                                              // return false;
                  if(data.length){
                    var obj = jQuery.parseJSON(data);
                    var html = ''

                    if(obj.specialist!=null){

                      $(obj.specialist).each(function(){
                        html +='<div class="keyword-search"><a href="'+base_url+'doctors-search?keywords='+this.specialization+'">'+this.specialization+'</a></div>';
                      });


                    }

                    if(obj.doctor!=null){
                      $(obj.doctor).each(function(){
                       html +='<div class="keyword-search"><a href="'+base_url+'doctors-search?keywords='+this.first_name+'"><div class="keyword-img"><img src="'+this.profileimage+'" class="img-responsive"></div>'
                        +this.first_name+' '+this.last_name+                        
                        '</a><small>'+this.speciality+'</small></div>';
                      });

                      $('.keywords_result').html(html);    
                    }else{
                      var html = '<b>'+lg_no_service_prov+'</b>';
                      
                    } 

                   

                      $('.keywords_result').html(html);


                  }else{
                    $('.keywords_result').html('<b>'+lg_no_service_prov+'</b>');                                                
                  }

              }
          });


     }else{
      $('.keyword_result').html('');
      }

   }


  }
  if(pages=='doctors_search'){

    function search_favourities(doctor_id)
    {
      var get_tag = $('#favourities_'+doctor_id).html();
      $('#favourities_'+doctor_id).html('<div class="spinner-border text-light" role="status"></div>');
      $('#favourities_'+doctor_id).attr('disabled',true);

      $.post(base_url+'home/add_favourities',{doctor_id:doctor_id},function(data){
        var obj = JSON.parse(data);

      $('#favourities_'+doctor_id).attr('disabled',false);
          
          if(obj.status===200)
          {
            $('#favourities_'+doctor_id).html("<i class='fa fa-heart'><i>");                                
          }
          else if(obj.status===204)
          {
            toastr.warning(obj.msg);
            $('#favourities_'+doctor_id).html(get_tag);
          }
          else if(obj.status===201)
          {
               $('#favourities_'+doctor_id).html("<i class='far fa-heart'><i>");
               
          }
          else
          {
              $('#favourities_'+doctor_id).html("<i class='far fa-heart'><i>");
          }   

      });
    }

  }
  if(pages=='index' || pages=='doctor_preview'){

    // $(document).on('click','.business_hr',function(){

    //   var service_slot = $(this).attr('data-value');
    //   var username = $('#username').val();
    //   if(service_slot !='')
    //     $('.ser1_btn').attr('href',base_url+'booking/'+username+'/'+service_slot);
    //   else
    //     $('.ser1_btn').attr('href','javascript:;');
    // });

    $(document).on('click','.ser1_btn',function(e){
      var btn_val = $('.ser1_btn').attr('href');
      if(btn_val=='javascript:;'){
        toastr.error(lg_please_select_a);
        $('.ser1_btn').attr('disabled',false);
        $('.ser1_btn').html();
        e.preventDefault();
        e.stopPropagation();
        return false;
      }
      $('.ser1_btn').attr('disabled',true);
      $('.ser1_btn').html('<div class="spinner-border text-light" role="status"></div>');
    });

    function index_favourities(doctor_id)
    {
      var get_tag = $('#favourities_'+doctor_id).html();
      $('#favourities_'+doctor_id).html('<div class="spinner-border text-light" role="status"></div>');
      $('#favourities_'+doctor_id).attr('disabled',true);

      $.post(base_url+'home/add_favourities',{doctor_id:doctor_id},function(data){
        var obj = JSON.parse(data);

      $('#favourities_'+doctor_id).attr('disabled',false);
          
          if(obj.status===200)
          {
            $('#favourities_'+doctor_id).html("<i class='fa fa-heart'><i>");                                
          }
          else if(obj.status===204)
          {
            toastr.warning(obj.msg);
            $('#favourities_'+doctor_id).html(get_tag);   
          }
          else if(obj.status===201)
          {
               $('#favourities_'+doctor_id).html("<i class='far fa-heart'><i>");
               
          }
          else
          {
              $('#favourities_'+doctor_id).html("<i class='far fa-heart'><i>");
          }   

      });
    }
    
    function add_favourities(doctor_id)
    {
      $('#favourities_'+doctor_id).html('<div class="spinner-border text-light" role="status"></div>');
      $('#favourities_'+doctor_id).attr('disabled',true);

      $.post(base_url+'home/add_favourities',{doctor_id:doctor_id},function(data){
        var obj = JSON.parse(data);

      $('#favourities_'+doctor_id).html('<i class="fas fa-heart"></i>');
      $('#favourities_'+doctor_id).attr('disabled',false);
          
          if(obj.status===200)
          {
                $('#favourities_'+doctor_id).addClass("fav-btns");                             
               
          }
          else if(obj.status===204)
          {
               toastr.warning(obj.msg);
               
          }
          else if(obj.status===201)
          {
               $('#favourities_'+doctor_id).removeClass("fav-btns");
               
          }
          else
          {
              $('#favourities_'+doctor_id).removeClass("fav-btns");
          }   

      });
    }
  }
}
$(document).ready(function(){

//signin
  if(modules=='signin') {
    if(pages=='register'){

      // $.ajax({
      //   type: "GET",
      //   url: base_url+"ajax/get_country_code",
      //   data:{id:$(this).val()}, 
      //   beforeSend :function(){
      // $('#country_code').find("option:eq(0)").html(lg_please_wait);
      //   },                         
      //   success: function (data) {
      //     /*get response as json */
      //     $('#country_code').find("option:eq(0)").html(lg_select_country_);
      //     var obj=jQuery.parseJSON(data);
      //     $(obj).each(function()
      //     {
      //      var option = $('<option />');
      //      option.attr('value', this.value).text(this.label);           
      //      $('#country_code').append(option);
      //    });  
      //   }
      // });

    $('.OTP').hide();
    $('#resendotp').hide();
    $("#sendotp").on('click', function() {
      
     var mobileno=$('#mobileno').val();
     var country_code=$('#country_code').val();
     if(mobileno=="")
      {
        toastr.error(lg_please_enter_va4);
      }
      else{
       $.ajax({
        url:base_url +'Signin/sendotp',
            data: {
          mobileno : mobileno,country_code:country_code,otpcount:'1'
        },
            
           dataType: "text",
            method:"post",
             beforeSend: function(){
                $('.otp_load').html('<div class="spinner-border text-light" role="status"></div>');
               },
            success:function(res){

              $('.otp_load').html('<a class="forgot-link" onclick="resend_otp()"  href="javascript:void(0);" id="resendotp">'+lg_resend_otp+'</a>');
        
                 var obj = JSON.parse(res);
                    
                    if(obj.status===200)
                    {
             
                       $('.OTP').show();
                       $('#resendotp').show();
                       toastr.success(obj.msg);
            
                    }
                    else if(obj.status===500)
                    {
                      toastr.error(obj.msg);
                   }
                    else
                    {
                        toastr.error(obj.msg);
                    }  
      }  
      });
      }
    });

 

  jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z]+$/i.test(value);
  }, "Letters only allowed");
  jQuery.validator.addMethod("emailcheck", function(value, element) {
    return this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
  }, lg_please_enter_va1);
  $("#register_form").validate({
            rules: {
                first_name: {
                  required: true,
                  lettersonly: true,
                  minlength: 3,
                },
                last_name: {
                  required: true,
                  lettersonly: true,
                },
                mobileno: {
                    required: true,
                    minlength: 7,
                    maxlength: 12,
                    digits: true,
                    remote: {
                    url: base_url+"signin/check_mobileno",
                    type: "post",
                    data: {
                        mobileno: function(){ return $("#mobileno").val(); }
                    }
                  }
                },
                email: {
                  required: true,
                  email: true,
                  emailcheck: true,
                  remote: {
                    url: base_url+"signin/check_email",
                    type: "post",
                    data: {
                        email: function(){ return $("#email").val(); }
                    }
                  }
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                     required: true,
                     equalTo: "#password"
                }
                
               },
            messages: {
                first_name: {
                  required: lg_please_enter_yo,
                  minlength: 'minimum 3 characters allowed',
                },
                last_name: {
                  required: lg_please_enter_yo1,
                },
                mobileno: {
                    required: lg_please_enter_mo,
                    maxlength: lg_please_enter_va,
                    minlength: lg_please_enter_va,
                    digits: lg_please_enter_va,
                    remote: lg_your_mobile_no_
                },
                email: {
                    required: lg_please_enter_em,
                    email: lg_please_enter_va1,
                    remote: lg_your_email_addr1
                },
                password: {
                    required: lg_please_enter_pa,
                    minlength: lg_your_password_m
                },
                confirm_password: {
                    required: lg_please_enter_co,
                    equalTo: lg_your_password_d
                }
                
            },
            submitHandler: function(form) {
       
                $.ajax({
            url: base_url+'signin/signup',
            data: $("#register_form").serialize(),
            type: "POST",
            beforeSend: function(){
                $('#register_btn').attr('disabled',true);
                $('#register_btn').html('<div class="spinner-border text-light" role="status"></div>');
               },
            success: function(res){
                $('#register_btn').attr('disabled',false);
                $('#register_btn').html(lg_signup);
                    var obj = JSON.parse(res);
                    
                    if(obj.status===200)
                    {
                        $('#register_form')[0].reset();
                        window.location.href=base_url+'register-success/'+obj.id;
                      
                    }
                    else
                    {
                        toastr.error(obj.msg);
                    }   
            }
        });
                return false;
            }
        });


}

if(pages=='index'){

  $("#signin_form").validate({
            rules: {
                email: "required",
                password: {
                   required: true,
                    minlength: 6
                },
            },
            messages: {
                email: lg_please_enter_em,
                password: {
                    required: lg_please_enter_pa,
                    minlength: lg_your_password_m
                },
                                
            },
            submitHandler: function(form) {
                $.ajax({
                    url: base_url+'signin/is_valid_login',
                    data: $("#signin_form").serialize(),
                    type: "POST",
                    beforeSend: function(){
                        $('#signin_btn').attr('disabled',true);
                        $('#signin_btn').html('<div class="spinner-border text-light" role="status"></div>');
                       },
                    success: function(res){
                        $('#signin_btn').attr('disabled',false);
                        $('#signin_btn').html(lg_signin);
                        
                            var obj = JSON.parse(res);
                            
                            if(obj.status===200)
                            { 
                              if(obj.msg !='')
                              {
                                window.location.href=base_url+'video-call/'+obj.msg;
                              }
                              else
                              {
                                window.location.href=base_url+'dashboard';
                              }
                            }
                            else
                            {
                                toastr.error(obj.msg);
                            }   
                    }
                });
                return false;
            }
        });
}
if(pages=='forgot_password'){
$("#reset_password").validate({
            rules: {
           
                resetemail: {
                  required: true,
                  email: true,
                  remote: {
                    url: base_url+"signin/check_resetemail",
                    type: "post",
                    data: {
                        resetemail: function(){ return $("#resetemail").val(); }
                    }
                  }
                }
               },
            messages: {
                resetemail: {
                    required: lg_please_enter_em,
                    email: lg_please_enter_va1,
                    remote: lg_your_email_addr
                }                 
            },
            submitHandler: function(form) {
                $.ajax({
                    url: base_url+'signin/reset_password',
                    data: $("#reset_password").serialize(),
                    type: "POST",
                    beforeSend: function(){
                         $('#reset_pwd').attr('disabled',true);
                         $('#reset_pwd').html('<div class="spinner-border text-light" role="status"></div>');
                       },
                    success: function(res){
                         $('#reset_pwd').attr('disabled',false);
                         $('#reset_pwd').html(lg_reset_password);
                        
                            var obj = JSON.parse(res);
                            
                            if(obj.status===200)
                            {
                                $('#reset_password')[0].reset();
                                toastr.success(obj.msg);
                                setTimeout(function(){ window.location.href=base_url+'home'; }, 5000);
                                
                            }
                            else
                            {
                                toastr.error(obj.msg);
                            }   
                    }
                });
                return false;
            }
        });
    }

    if(pages=='change_password')
{
    $(document).ready(function(){

         $("#change_password").validate({
            rules: {
                               
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                     required: true,
                     equalTo: "#password"
                },
               },
            messages: {
                password: {
                    required: lg_please_enter_pa,
                    minlength: lg_your_password_m
                },
                confirm_password: {
                    required: lg_please_enter_co,
                    equalTo: lg_your_password_d
                },
                
            },
            submitHandler: function(form) {
                $.ajax({
                    url: base_url+'signin/update_password',
                    data: $("#change_password").serialize(),
                    type: "POST",
                    beforeSend: function(){
                         $('#update_pwd').attr('disabled',true);
                         $('#update_pwd').html('<div class="spinner-border text-light" role="status"></div>');
                        
                       },
                    success: function(res){
                        $('#update_pwd').attr('disabled',false);
                         $('#update_pwd').html(lg_confirm3);
                        var obj = JSON.parse(res);
                           
                            if(obj.status===200)
                            {
                               $('#change_password')[0].reset();
                                toastr.success(obj.msg);
                                setTimeout(function(){ window.location.href=base_url+'home'; }, 5000);
                            }
                            else
                            {
                                toastr.error(obj.msg);
                            }   
                    }
                });
                return false;
            }
        });

    });

}

}



if((modules=='doctor' || modules=='patient') && (pages=='doctor_profile' || pages=='patient_profile') || pages=='doctors_searchmap' || pages=='patients_search'){

  $('#specializations').select2();

  // $.ajax({
  //       type: "GET",
  //       url: base_url+"ajax/get_country_code",
  //       data:{id:$(this).val()}, 
  //       beforeSend :function(){
  //         $('#country_code').find("option:eq(0)").html(lg_please_wait);
  //       },                         
  //       success: function (data) {
  //         /*get response as json */
  //          $('#country_code').find("option:eq(0)").html(lg_select_country_);
  //         var obj=jQuery.parseJSON(data);
  //         $(obj).each(function()
  //         {
  //          var option = $('<option />');
  //          option.attr('value', this.value).text(this.label);           
  //          $('#country_code').append(option);
  //        });  

  //         $('#country_code').val(country_code);

  //         /*ends */
          
  //       }
  //     });


   $.ajax({
        type: "GET",
        url: base_url+"ajax/get_country",
        data:{id:$(this).val()}, 
        beforeSend :function(){
      $('#country').find("option:eq(0)").html(lg_please_wait);
        },                         
        success: function (data) {
          /*get response as json */
           $('#country').find("option:eq(0)").html(lg_select_country);
          var obj=jQuery.parseJSON(data);
          $(obj).each(function()
          {
           var option = $('<option />');
           option.attr('value', this.value).text(this.label);           
           $('#country').append(option);
         });  

          $('#country').val(country);

          /*ends */
          
        }
      });

   $.ajax({
        type: "POST",
        url: base_url+"ajax/get_state",
        data:{id:country}, 
        beforeSend :function(){
      $("#state option:gt(0)").remove(); 
      $("#city option:gt(0)").remove(); 
      $('#state').find("option:eq(0)").html(lg_please_wait);

        },                         
        success: function (data) {
          /*get response as json */
           $('#state').find("option:eq(0)").html(lg_select_state);
          var obj=jQuery.parseJSON(data);
          $(obj).each(function()
          {
           var option = $('<option />');
           option.attr('value', this.value).text(this.label);           
           $('#state').append(option);
         });  
          $('#state').val(state);
          /*ends */
          
        }
      });

        $.ajax({
        type: "POST",
        url: base_url+"ajax/get_city",
        data:{id:state}, 
          beforeSend :function(){
   
      $("#city option:gt(0)").remove(); 
      $('#city').find("option:eq(0)").html(lg_please_wait);

        },  

        success: function (data) {
          /*get response as json */
            $('#city').find("option:eq(0)").html(lg_select_city);

          var obj=jQuery.parseJSON(data);
          $(obj).each(function()
          {
           var option = $('<option />');
           option.attr('value', this.value).text(this.label);
           $('#city').append(option);
         });  
          $('#city').val(city);
          /*ends */
          
        }
      });



    /*Get the state list */


    $('#country').change(function(){
      $.ajax({
        type: "POST",
        url: base_url+"ajax/get_state",
        data:{id:$(this).val()}, 
        beforeSend :function(){
      $("#state option:gt(0)").remove(); 
      $("#city option:gt(0)").remove(); 
      $('#state').find("option:eq(0)").html(lg_please_wait);

        },                         
        success: function (data) {
          /*get response as json */
           $('#state').find("option:eq(0)").html(lg_select_state);
          var obj=jQuery.parseJSON(data);
          $(obj).each(function()
          {
           var option = $('<option />');
           option.attr('value', this.value).text(this.label);           
           $('#state').append(option);
         });  

          /*ends */
          
        }
      });
    });




    /*Get the state list */


    $('#state').change(function(){
      $.ajax({
        type: "POST",
        url: base_url+"ajax/get_city",
        data:{id:$(this).val()}, 
          beforeSend :function(){
   
      $("#city option:gt(0)").remove(); 
      $('#city').find("option:eq(0)").html(lg_please_wait);

        },  

        success: function (data) {
          /*get response as json */
            $('#city').find("option:eq(0)").html(lg_select_city);

          var obj=jQuery.parseJSON(data);
          $(obj).each(function()
          {
           var option = $('<option />');
           option.attr('value', this.value).text(this.label);
           $('#city').append(option);
         });  
          
          /*ends */
          
        }
      });
    });

    if(pages=='doctor_profile' || pages=='doctors_search' || pages=='doctors_searchmap'){


      $.ajax({
        type: "GET",
        url: base_url+"ajax/get_specialization",
        data:{id:$(this).val()}, 
        beforeSend :function(){
          $('#specialization').find("option:eq(0)").html(lg_please_wait);
        },                         
        success: function (data) {
          /*get response as json */
          $('#specialization').find("option:eq(0)").html(lg_select_speciali1);
          var obj=jQuery.parseJSON(data);
          $('#specialization').append(obj);
          $('#specialization').val(specialization);

          /*ends */
          
        }
      });

      $.ajax({
        type: "GET",
        url: base_url+"ajax/get_spcategory",
        data:{id:$(this).val()}, 
        beforeSend :function(){
          $("#spcategory option:gt(0)").remove(); 
          $('#spcategory').find("option:eq(0)").html(lg_please_wait);
        },                         
        success: function (data) {
          /*get response as json */
          $('#spcategory').find("option:eq(0)").html(lg_category);
          var obj=jQuery.parseJSON(data);
          $('#spcategory').append(obj);
          $('#spcategory').val(specialization);

          /*ends */
          
        }
      });

      $('#spsubcategory').change(function(){

        if($(this).val() !=''){
          $.ajax({
            type: "GET",
            url: base_url+"ajax/get_spcategory",
            data:{id:$(this).val()}, 
            beforeSend :function(){
              $("#spservice option:gt(0)").remove(); 
              $('#spservice').find("option:eq(0)").html(lg_please_wait);
            },                         
            success: function (data) {
              /*get response as json */
              $('#spservice').find("option:eq(0)").html(lg_service_option);
              var obj=jQuery.parseJSON(data);
              $('#spservice').append(obj);
              $('#spservice').val(specialization);

              /*ends */
              
            }
          });
        }else{
          $("#spservice option:gt(0)").remove(); 
        }
      });

      $('#spcategory').change(function(){

        if($(this).val() !=''){
          $.ajax({
            type: "GET",
            url: base_url+"ajax/get_spcategory",
            data:{id:$(this).val()}, 
            beforeSend :function(){
              $("#spsubcategory option:gt(0)").remove(); 
              $('#spsubcategory').find("option:eq(0)").html(lg_please_wait);
            },                         
            success: function (data) {
              /*get response as json */
              $('#spsubcategory').find("option:eq(0)").html(lg_subcategory1);
              var obj=jQuery.parseJSON(data);
              $('#spsubcategory').append(obj);
              $('#spsubcategory').val(specialization);

              /*ends */
              
            }
          });
        }else{
          $("#spsubcategory option:gt(0)").remove(); 
        }
      });


      $.ajax({
        type: "GET",
        url: base_url+"ajax/get_doctors",
        data:{id:$(this).val()}, 
        beforeSend :function(){
          $('#sellers').find("option:eq(0)").html(lg_please_wait);
        },                         
        success: function (data) {
          /*get response as json */
          $('#sellers').find("option:eq(0)").html(lg_seller_details);
          var obj=jQuery.parseJSON(data);
          $(obj).each(function()
          {
             var option = $('<option />');
             option.attr('value', this.value).text(this.label);           
             $('#sellers').append(option);
          });  
          /*ends */
          
        }
      });
    
    }


    if(pages=='doctor_profile'){

      $(document).on('click','.project_delete',function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: base_url + 'profile/delete_project',
            data: {id: id},
            type: "POST",
            success: function (res) {
              var obj = JSON.parse(res);
              if (obj.status === 200)
              {
                toastr.success(obj.msg);
                $('#project_delete_'+id).remove();
                $('#project_'+id).remove();
              } else
              {
                toastr.error(lg_something_went_);
              }
            }
        });
      });

      $(document).on('click','.delete_image',function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: base_url + 'profile/delete_clinic_image',
            data: {id: id},
            type: "POST",
            success: function (res) {
              var obj = JSON.parse(res);
              if (obj.status === 200)
              {
                toastr.success(obj.msg);
                location.reload(true);
              } else
              {
                toastr.error(lg_something_went_);
              }
            }
        });

      });

    /*Get the country list */
     $("#doctor_profile_form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                mobileno: {
                    required: true,
                    minlength: 7,
                    maxlength: 12,
                    digits: true,
                    remote: {
                    url: base_url+"profile/check_mobileno",
                    type: "post",
                    data: {
                        mobileno: function(){ return $("#mobileno").val(); }
                    }
                  }
                },
                gender: "required",
                dob: "required",
               address1: "required",
               address2: "required",
               country: "required",
               state: "required",
               city: "required",
               postal_code: {
                required: true,
                    minlength: 4,
                    maxlength: 7,
                    digits: true,
               },
               price_type:"required",
               amount: {
                required: function (element) {
                  if($("input[name='price_type']:checked").val() === "Custom Price"){
                    return true;
                  }else {
                    return false;
                  }
                },
                digits: true,
                min: 1
              },
              services:"required",
              // specialization:"required",
              // "degree[]":"required",
              // "institute[]":"required",
              // "year_of_completion[]":"required",
                
                
               },
            messages: {
                first_name: lg_please_enter_yo,
                last_name: lg_please_enter_yo1,
                mobileno: {
                    required: lg_please_enter_mo,
                    maxlength: lg_please_enter_va,
                    minlength: lg_please_enter_va,
                    digits: lg_please_enter_va,
                    remote: lg_your_mobile_no_
                },
                gender: lg_please_select_g,
                dob: lg_please_enter_yo2,
                address1: lg_please_enter_yo3,
                address2: lg_please_enter_yo4,
                country: lg_please_select_c,
                state: lg_please_select_s,
                city: lg_please_select_c1,
               postal_code: {
                    required: lg_please_enter_po,
                    maxlength: lg_please_enter_va2,
                    minlength: lg_please_enter_va2,
                    digits: lg_please_enter_va2
                },
                price_type:lg_please_select_p,
                amount: {
                    required: lg_please_enter_am,
                    digits: lg_please_enter_va3,
                    min: lg_please_enter_va3
                },
                services:lg_please_enter_se,
                // specialization:lg_please_select_s1,
                // "degree[]":lg_please_enter_de,
                // "institute[]":lg_please_enter_in,
                // "year_of_completion[]":lg_please_enter_ye
                
            }
        });

        $(document).on('submit','#doctor_profile_form',function(e){
          e.preventDefault();
          $('#save_btn').attr('disabled',true);
          $('#save_btn').html('<div class="spinner-border text-light" role="status"></div>');
          $.ajax({
              url: base_url+'profile/update_doctor_profile',
              data: new FormData(this),
              type: "POST",
              processData: false,
              contentType: false,
              cache:false,
              success: function(res){
                $('#save_btn').attr('disabled',false);
                $('#save_btn').html(lg_save_changes);
                
                var obj = JSON.parse(res);
                    
                if(obj.status===200)
                { 
                  toastr.success(obj.msg);
                  setTimeout(function(){ window.location.href=base_url+'dashboard'; }, 5000);                             
                }
                else
                {
                  toastr.error(obj.msg);
                }   
              }
          });
          return false;
        });

          $(document).on('click','.days_check',function(){

          if($(this).is(':checked') == true){

              $('.eachdays').attr('disabled','disabled');
              $('.eachdayfromtime').attr('disabled','disabled');
              $('.eachdaytotime').attr('disabled','disabled');
              $('.eachdays').prop('checked', false);
              $('.eachdays').removeAttr('style');
              $('.eachdayfromtime').removeAttr('style');
              $('.eachdaytotime').removeAttr('style');

          }else{
              $('.eachdays').removeAttr('disabled');
              $('.eachdayfromtime').removeAttr('disabled');
              $('.eachdaytotime').removeAttr('disabled');
              $('.daysfromtime_check').val('');
              $('.daystotime_check').val('');
              $('.daysfromtime_check').removeAttr('style');
              $('.daystotime_check').removeAttr('style');
          }

      });

    }

    if(pages=='patient_profile'){
      var maxDate = $('#maxDate').val();
       $('#dob').datepicker({
          startView: 2,
          format: 'dd/mm/yyyy',
          autoclose: true,
          todayHighlight: true,
          endDate:maxDate
         });

       $("#patient_profile_form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                mobileno: {
                    required: true,
                    minlength: 7,
                    maxlength: 12,
                    digits: true,
                    remote: {
                    url: base_url+"profile/check_mobileno",
                    type: "post",
                    data: {
                        mobileno: function(){ return $("#mobileno").val(); }
                    }
                  }
                },
                gender: "required",
               dob: "required",
               // blood_group: "required",
               address1: "required",
               address2: "required",
               country: "required",
               state: "required",
               city: "required",
               postal_code: {
                required: true,
                    minlength: 4,
                    maxlength: 7,
                    digits: true,
               }
            },
            messages: {
                first_name: lg_please_enter_yo,
                last_name: lg_please_enter_yo1,
                mobileno: {
                    required: lg_please_enter_mo,
                    maxlength: lg_please_enter_va,
                    minlength: lg_please_enter_va,
                    digits: lg_please_enter_va,
                    remote: lg_your_mobile_no_
                },
                gender: lg_please_select_g,
                dob: lg_please_enter_yo2,
                // blood_group: lg_please_select_b,
                address1: lg_please_enter_yo3,
                address2: lg_please_enter_yo4,
                country: lg_please_select_c,
                state: lg_please_select_s,
                city: lg_please_select_c1,
               postal_code: {
                    required: lg_please_enter_po,
                    maxlength: lg_please_enter_va2,
                    minlength: lg_please_enter_va2,
                    digits: lg_please_enter_va2
                }         
            },
            submitHandler: function(form) {
       
                $.ajax({
                    url: base_url+'profile/update_patient_profile',
                    data: $("#patient_profile_form").serialize(),
                    type: "POST",
                    beforeSend: function(){
                        $('#save_btn').attr('disabled',true);
                        $('#save_btn').html('<div class="spinner-border text-light" role="status"></div>');
                       },
                    success: function(res){
                        $('#save_btn').attr('disabled',false);
                        $('#save_btn').html(lg_save_changes);
                        
                            var obj = JSON.parse(res);
                            
                            if(obj.status===200)
                            { 

                                toastr.success(obj.msg);
                                setTimeout(function(){ window.location.href=base_url+'dashboard'; }, 5000);
                                                                
                            }
                            else
                            {
                                toastr.error(obj.msg);
                            }   
                    }
                });
                return false;
            }
        });
    }
}

});

if(modules=='home')
{
  if(pages=='doctors_search' )
  {

    
    search_doctor(0);

    $(document).on('click','.cat-link',function(){
      var id = $(this).attr('data-id');
      $('#service_id').val(id);
      search_doctor(0);
    });

    function reset_doctor()
    {
      $('#orderby').val('');
      $('#keywords').val('');
    $('#appointment_type').val('');
    $('#gender').val('');
    $('#specialization').val('');
    $('#country').val('');
    $('#state').val('');
    $('#city').val('');
     // $('#search_doctor_form')[0].reset();
      search_doctor(0);
    }



        
      function search_doctor(load_more){

        if(load_more == 0){
         $('#page_no_hidden').val(1);
      }

       var service_id = $('#service_id').val();
       var specialization = $('#specialization').val();       
       var order_by = $('#orderby').val();
       var page = $('#page_no_hidden').val();        
       var gender = $("#gender").val();                 
       var appointment_type = $("#appointment_type").val(); 
       var city = $("#city").val(); 
       var state = $("#state").val(); 
       var country = $("#country").val(); 
       var keywords = $("#keywords").val();

       var location = $("#location").val();
       
       var spcategory = $("#spcategory").val();
       var spsubcategory = $("#spsubcategory").val();
       var spservice = $("#spservice").val();
       var sellers = $("#sellers").val();
       var budget = $("#budget").val();

       var result_key = '';

       if(keywords !=''){
          result_key = $("#keywords").val();
       }

       if(location !=''){
          result_key = $("#location").val();
       }

       if(spcategory !=''){
          result_key = $("#spcategory option:selected").text();
       }

       if(spsubcategory !=''){
          result_key = $("#spsubcategory option:selected").text();
       }

       if(spservice !=''){
          result_key = $("#spservice option:selected").text();
       }

       if(result_key !=''){
          $('.result-key').html('Result For '+result_key);
       }else{
        $('.result-key').html('');
       }

     //$('#search-error').html('');

     $.ajax({
       url:  base_url +'home/search_doctor',
       type: 'POST',
       data: {
        appointment_type : appointment_type,
        gender : gender,        
        specialization : specialization,
        order_by : order_by,
        page : page,
        keywords : keywords,
        city:city,
        citys:citys,
        state:state,
        country:country,
        spcategory:spcategory,
        spsubcategory:spsubcategory,
        spservice:spservice,
        sellers:sellers,
        service_id:service_id,
        budget:budget
      },
      beforeSend:function(){
       $('#doctor-list').css({"margin-left": "50%", "margin-top": "5%"});
       $('#doctor-list').html('<div class="spinner-border text-success text-center" role="status"></div>'); 
      },
      success: function(response){
        $('#doctor-list').css({"margin-left": "", "margin-top": ""});
        $('#doctor-list').html(''); 
        if(response){

          var obj = $.parseJSON(response);
          if(obj.data.length >=1) {
          var html = '';
          // html += '<div class="row">';
          $(obj.data).each(function(){ 
   
            var services = '';

          if(this.services.length!=0){
            var service=this.services.split(',');
           for(var i=0;i< service.length;i++){             
                services +='<span>'+service[i]+'</span>';                  
             }
          }

          html += '<div class="col-md-3 col-sm-6">'+

                    '<div class="card Ellipse-text" style="height: auto">'+
                    '<a href="'+base_url+'doctor-preview/'+this.username+'"">' +
                        '<img src="'+this.profileimage+'" alt="img" class="img-fluid mentors-img">'+
                        '</a>'+
                        '<div class="card-body">'+
                        '<a href="'+base_url+'doctor-preview/'+this.username+'"">' +
                    
                          '<h2 class="table-avatar"><span class="avatar"><img alt="" src="'+this.specialization_img+'"></span><span class="font-weight-bold rtl-text t-ellipse">  '+lg_dr+' '+this.first_name+' '+this.last_name+' <span class="role-em t-ellipse" style="color: '+this.color+'" >'+this.speciality+'</span></span></h2>'+
                           '<p class="card-text mb-2 f-12 text-left multi-line-truncate">'+this.biography+'</p>'+
                           '</a>'+
                              '<div class="rating">';
                                  for(var j=1;j<=5;j++){  
                                    if(j <= this.rating_value){                                        
                                      html +='<i class="fas fa-star filled"></i>';
                                    }else { 
                                      html +='<i class="fas fa-star"></i>';
                                    }            
                                  }
                          html +='<span class="d-inline-block average-rating">('+this.rating_count+')</span>'+
                              '</div><hr>'+
                              '<div>'+
                                  '<a href="javascript:;" id="favourities_'+this.user_id+'" onclick="search_favourities('+this.user_id+')" class="float-left"><i class="'+this.favourites+'"></i></a>'+
                                  '<span class="float-right"> '+lg_starting_at+' <b>'+this.amount+'</b></span>'+
                              '</div>'+
                        '</div>'+
                    '</div>'+
                  '</div>';
       
        });

        // html += '</div>';

          if(obj.current_page_no == 1){    
            $("#doctor-list").html(html);    
          }else{
            $("#doctor-list").append(html);    
          }  

        }
        else
        {
           var html='<div class="col-12"><div class="card">'+
                '<div class="card-body">'+
                  '<div class="doctor-widget">'+
                  '<p>'+lg_no_doctors_foun+'</p>'+
                  '</div>'+
                  '</div>'+
                  '</div></div>';

                  $("#doctor-list").html(html);    
        }

                 


          var minimized_elements = $('h4.minimize');
          minimized_elements.each(function() {
            var t = $(this).text();
            if (t.length < 100) return;
            $(this).html(
              t.slice(0, 100) + '<span>... </span><a href="#" class="more">'+lg_more+'</a>' +
              '<span style="display:none;">' + t.slice(100, t.length) + ' <a href="#" class="less">'+lg_less+'</a></span>'
              );
          });


          $(".search-results").html('<span>'+obj.count+' '+lg_services_availa+''+'</span>');

          if(obj.count == 0){
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }


          if(obj.current_page_no == 1 && obj.count < 5){
            $('page_no_hidden').val(1);
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }



          if(obj.total_page > obj.current_page_no && obj.total_page !=0 ){                               
            $('#load_more_btn').removeClass('d-none');
            $('#no_more').addClass('d-none');
          }else{                                
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
          }                

        }                     
      }

    });
}



$('#load_more_btn').click(function(){    
 var page_no = $('#page_no_hidden').val(); 
 var current_page_no =0;

 if(page_no == 1){
  current_page_no = 2;
}else{
  current_page_no = Number(page_no) + 1;
}        
$('#page_no_hidden').val(current_page_no);
    search_doctor(1);
});
  }
}


if(modules=='home')
{
  if(pages=='patients_search')
  {


    function reset_patient()
    {
      $('#orderby').val('');
      $('#search_patient_form')[0].reset();
      search_patient(0);
    }

        search_patient(0);
         function search_patient(load_more){

        if(load_more == 0){
         $('#page_no_hidden').val(1);
       }

       var order_by = $('#orderby').val();
       var keyword = $('#search_user').val(); 
       var page = $('#page_no_hidden').val();        
       var gender = $("#gender"). val();                 
       // var blood_group = $("#blood_group"). val(); 
       var city = $("#city"). val(); 
       var state = $("#state"). val(); 
       var country = $("#country"). val(); 
       

     //$('#search-error').html('');

     $.ajax({
       url:  base_url +'home/search_patient',
       type: 'POST',
       data: {
        gender : gender,        
        // blood_group : blood_group,
        order_by : order_by,
        page : page,
        keyword : keyword,
        city:city,
        state:state,
        country:country
      },
      beforeSend:function(){ 
       // $('#doctor-list').html('<div class="spinner-border text-success text-center" role="status"></div>'); 
      },
      success: function(response){
        //$('#doctor-list').html(''); 
        if(response){
          var obj = $.parseJSON(response);
          if(obj.data.length >=1) {
          var html = '';
          $(obj.data).each(function(){ 
   
            
          html +='<div class="col-md-6 col-lg-4 col-xl-3">'+
                  '<div class="card widget-profile pat-widget-profile">'+
                    '<div class="card-body">'+
                      '<div class="pro-widget-content">'+
                        '<div class="profile-info-widget">'+
                          '<a href="javascript:void(0)" class="booking-doc-img">'+
                            '<img src="'+this.profileimage+'" alt="User Image">'+
                          '</a>'+
                          '<div class="profile-det-info">'+
                            '<h3><a href="javascript:void(0)">'+this.first_name+' '+this.last_name+'</a></h3>'+
                            
                            '<div class="patient-details">'+
                              '<h5><b>'+lg_patient_id+' :</b> #PT00'+this.user_id+'</h5>'+
                              '<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> '+this.cityname+', '+this.countryname+'</h5>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                      '<div class="patient-info">'+
                        '<ul>'+
                          '<li>'+lg_phone+' <span>'+this.mobileno+'</span></li>'+
                          '<li>'+lg_age+' <span>'+this.age+', '+this.gender+'</span></li>'+
                          // '<li>'+lg_blood_group+' <span>'+this.blood_group+'</span></li>'+
                        '</ul>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>';
        });

          if(obj.current_page_no == 1){    
            $("#patients-list").html(html);    
          }else{
            $("#patients-list").append(html);    
          } 



          }
          else{

            var html='<div class="card" style="width:100%">'+
                '<div class="card-body">'+
                  '<div class="doctor-widget">'+
                  '<p>'+lg_no_patients_fou+'</p>'+
                  '</div>'+
                  '</div>'+
                  '</div>';

                  $("#patients-list").html(html); 

          }        


          var minimized_elements = $('h4.minimize');
          minimized_elements.each(function() {
            var t = $(this).text();
            if (t.length < 100) return;
            $(this).html(
              t.slice(0, 100) + '<span>... </span><a href="#" class="more">'+lg_more+'</a>' +
              '<span style="display:none;">' + t.slice(100, t.length) + ' <a href="#" class="less">'+lg_less+'</a></span>'
              );
          });

          
          $(".search-results").html('<span>'+obj.count+' '+lg_matches_for_you+''+'</span>');
          // $(".widget-title").html(obj.count+' Matches for your search');
          if(obj.count == 0){
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }


          if(obj.current_page_no == 1 && obj.count < 8){
            $('page_no_hidden').val(1);
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }



          if(obj.total_page > obj.current_page_no && obj.total_page !=0 ){                               
            $('#load_more_btn').removeClass('d-none');
            $('#no_more').addClass('d-none');
          }else{                                
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
          }                

        }                     
      }

    });
}



$('#load_more_btn').click(function(){    
 var page_no = $('#page_no_hidden').val(); 
 var current_page_no =0;

 if(page_no == 1){
  current_page_no = 2;
}else{
  current_page_no = Number(page_no) + 1;
}        
$('#page_no_hidden').val(current_page_no);
    search_patient(1);
});
  }
}

if(modules=='doctor')
{
  if(pages=='schedule_timings')
  {

    function add_slot(day_id,day_name){
      $('#day_id').val(day_id);
      $('#from_time').val('');
      $('#to_time').val('');
      $('#slot_modal_title').html(lg_add_time_slots+' - '+ucwords(day_name));
      $('#add_time_slot').modal('show');
    }

    function edit_slot(day_id,day_name,from_time,to_time){
      $('#day_id').val(day_id);
      $('#slot_modal_title').html(lg_edit_time_slots+' - '+ucwords(day_name));
      $('#from_time').val(from_time);
      $('#to_time').val(to_time);
      $('#add_time_slot').modal('show');
    }

    $('#slot_submit_form').validate({
      rules: {
        from_time: "required",
        to_time: "required", 
      },
      messages: {
        from_time: lg_please_select_f,
        to_time: lg_please_select_t,        
      },
      submitHandler: function(form) {

        var from_time_val = $('#from_time').val();
        var to_time_val = $('#to_time').val();
        from_time_val = convertTo24Hour(from_time_val);
        to_time_val = convertTo24Hour(to_time_val);
        if(from_time_val>=to_time_val){
          toastr.error(lg_wrong_time_form);
          return false;
        }

        $.ajax({
            url: base_url+'schedule_timings/add_schedule',
            data: $("#slot_submit_form").serialize(),
            type: "POST",
            beforeSend: function(){
              $('#slot-submit-btn').attr('disabled',true);
              $('#slot-submit-btn').html('<div class="spinner-border text-light" role="status"></div>');
            },
            success: function(res){
              $('#slot-submit-btn').attr('disabled',false);
              $('#slot-submit-btn').html(lg_save_changes);

              var day_name = '';
              var day_id = $('#day_id').val();
              if(day_id==1){
                day_name = 'sunday';
              }
              if(day_id==2){
                day_name = 'monday';
              }
              if(day_id==3){
                day_name = 'tuesday';
              }
              if(day_id==4){
                day_name = 'wednesday';
              }
              if(day_id==5){
                day_name = 'thursday';
              }
              if(day_id==6){
                day_name = 'friday';
              }
              if(day_id==7){
                day_name = 'saturday';
              }
              
              var obj = JSON.parse(res);
              
              if(obj.status===200)
              {
                $('#slot_'+day_name).html('');
                toastr.success(obj.msg);

                var message = '<h4 class="card-title d-flex justify-content-between">'+
                              '<span>'+lg_time_slots+'</span>'+ 
                              '<a class="edit-link" href="javascript:void(0)" onclick="edit_slot(\''+day_id+'\',\''+day_name+'\',\''+obj.from_time_2+'\',\''+obj.to_time_2+'\')"><i class="fa fa-edit mr-1"></i>'+lg_edit_slot+'</a>'+
                              '</h4>'+
                              '<div class="doc-times '+day_name+'">'+
                                '<div class="doc-slot-list">'+obj.from_time+' - '+obj.to_time+
                                  '<a href="javascript:void(0)" class="delete_schedule" data-id="'+obj.id+'">'+
                                    '<i class="fa fa-times"></i>'+
                                  '</a>'+
                                '</div>'+
                              '</div>';

                $('#slot_'+day_name).html(message);

                $('#add_time_slot').modal('hide');
                $('#slot_submit_form')[0].reset();

              }
              else
              {
                toastr.error(obj.msg);
              }   
            }
        });
        return false;

      }

    });

    function convertTo24Hour(time) {
      var hours = parseInt(time.substr(0, 2));
      if(time.indexOf('am') != -1 && hours == 12) {
          time = time.replace('12', '0');
      }
      if(time.indexOf('pm')  != -1 && hours < 12) {
          time = time.replace(hours, (hours + 12));
      }
      return time.replace(/(am|pm)/, '');
    }

    $(document).on('click','.delete_schedule',function(){
      var id = $(this).attr('data-id');
      $('#delete_id').val(id);
      $('#delete_title').html(lg_time_slots);
      $('#delete_modal').modal('show');
    });

    $(document).on('click','#delete_btn',function(){

      var id = $('#delete_id').val();

      $.ajax({
        url: base_url+'schedule_timings/remove_schedule',
        data: {'id':id},
        type: "POST",
        beforeSend: function(){
          $('#delete_btn').attr('disabled',true);
          $('#delete_btn').html('<div class="spinner-border text-light" role="status"></div>');
        },
        success: function(res){

          $('#delete_btn').attr('disabled',false);
          $('#delete_btn').html(lg_yes);

          $('#delete_modal').modal('hide');

          var obj = JSON.parse(res);
          var message = '';

          if(obj.status===200)
          {
            toastr.success(obj.msg);

            $('#slot_'+obj.day_name).html('');

            message = '<h4 class="card-title d-flex justify-content-between">'+
                        '<span>'+lg_time_slots+'</span>'+
                        '<a class="edit-link" href="javascript:void(0)" onclick="add_slot(\''+obj.day_id+'\',\''+obj.day_name+'\')"><i class="fa fa-plus-circle"></i> '+lg_add_slot+'</a>'+
                      '</h4>'+
                      '<p class="text-muted mb-0">'+lg_not_available+'</p>';

            $('#slot_'+obj.day_name).html(message);

          }
          else
          {
            toastr.error(obj.msg);
          }   
        }
      });
      return false;

    });

    $(".price-info").on('click','.trash', function () {
      $(this).closest('.price-cont').remove();
      var price_datas = $('#price_datas').val();
      price_datas = Number(price_datas) - 1;
      $('#price_datas').val(price_datas);
      return false;
    });

    $(document).on('click','.add-price', function () {

        var price_datas = $('#price_datas').val();
        price_datas = Number(price_datas) + 1;
        console.log();
        var pricecontent = '<div class="row price-cont">' +
                              '<div class="col-3">' +
                                '<div class="form-group">' +
                                  '<label for="slot_time_'+price_datas+'">'+lg_slot_time+' ( '+lg_mins+' ) <span class="text-danger">*</span></label>' +
                                  '<input type="text" id="slot_time_'+price_datas+'" name="slots[]" class="form-control" onkeypress="return isNumber(event);">' +
                                '</div>' +
                              '</div>' +
                              '<div class="col-3">' +
                                '<div class="form-group">' +
                                  '<label for="slot_price_'+price_datas+'">'+lg_price2+' <span class="text-danger">*</span></label>' +
                                  '<input type="text" id="slot_price_'+price_datas+'" name="price[]" class="form-control"onkeypress="return isNumber(event);">' +
                                '</div>' +
                              '</div>' +
                              '<div class="col-3">' +
                                '<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
                                '<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
                              '</div>' +
                            '</div>';
        $('#price_datas').val(price_datas);
        $(".price-info").append(pricecontent);
        return false;
    });

    $('#price-form').validate({
      rules: {
        "slots[]": {
          required : true
        },
        "price[]": {
          required : true
        },
      },
      messages: {
        "slots[]": "slot time required",
        "price[]": "price required",        
      },
      submitHandler: function(form) {
        $.ajax({
            url: base_url+'schedule_timings/price_update',
            data: $("#price-form").serialize(),
            type: "POST",
            beforeSend: function(){
              $('#price-btn').attr('disabled',true);
              $('#price-btn').html('<div class="spinner-border text-light" role="status"></div>');
            },
            success: function(res){
              $('#price-btn').attr('disabled',false);
              $('#price-btn').html(lg_save_changes);
              
              var obj = JSON.parse(res);
              
              if(obj.status===200)
              {
                toastr.success(obj.msg);
                window.location.reload();
              }
              else
              {
                toastr.error(obj.msg);
                window.location.reload();
              }   
            }
        });
        return false;

      }

    });

  }

}

if(modules=='patient')
{

  if(pages=="book_appoinments"){

    $(document).on('click','.business_hr',function(){

      var service_slot = $(this).attr('data-value');
      var username = $('#username').val();
      if ($(".business_hr").hasClass("active")) {
        if(service_slot !='')
          $('.ser1_btn').attr('href',base_url+'booking/'+username+'/'+service_slot);
        else
          $('.ser1_btn').attr('href','javascript:;');
      }else{
        $('.ser1_btn').attr('href','javascript:;');
      }
    });

    $(document).on('click','.ser1_btn',function(e){
      var btn_val = $('.ser1_btn').attr('href');
      if(btn_val=='javascript:;'){
        toastr.error(lg_please_select_a);
        $('.ser1_btn').attr('disabled',false);
        $('.ser1_btn').html();
        e.preventDefault();
        e.stopPropagation();
        return false;
      }
      $('.ser1_btn').attr('disabled',true);
      $('.ser1_btn').html('<div class="spinner-border text-light" role="status"></div>');
    });

  }

  if(pages=="booking"){

    $(document).on('click','.available_slot',function(){
        
      if($(this).hasClass( "selected-date")){
          $(this).removeClass('selected-date');
      }else{
          $(this).addClass('selected-date');
      }
      var selected_count = $('.selected-date').length;
      // alert(selected_count);
      // $('#selected_count').val(selected_count);
      //  if(selected_count == 1 || selected_count == 0){
      //     $('.bookingconfirmation strong').html(selected_count+' slot');    
      // }else{
      //     $('.bookingconfirmation strong').html(selected_count+' slots');
      // }
      
      if(selected_count == 0){
          $('.bookingconfirmation a').addClass('disabled');
      }else{
       $('.bookingconfirmation a').removeClass('disabled');
      }
  
    });

    $(document).on('click','.bookingconfirmation a',function(){

      var selected_count = $('.selected-date').length;

      if(selected_count <=0)
      {
        toastr.warning(lg_please_select_a);
        return false;
      }

      var doctor_id = $('#doctor_id').val();
      var doctor_username= $('#doctor_username').val();
      var hourly_rate = $('#hourly_rate').val();
      var appointment_data = [];
      $('.selected-date').each(function(index,value){

          appointment_data.push({'date_value':$(this).attr('data-date'),
              'day_id':$(this).attr('data-day-id'),
              'day_name':$(this).attr('data-day'),
              'start_time':$(this).attr('data-start-time'),
              'end_time':$(this).attr('data-end-time'),
              'time_zone':$(this).attr('data-timezone'),
              'type':$(this).attr('data-type'),
              'hour':'1'
          });
      });

      if(appointment_data.length <=0)
      {
        toastr.warning(lg_please_select_a);
        return false;
      }
      var appointment_details = JSON.stringify(appointment_data);

      $('.bookingconfirmation a').addClass('disabled');
      $('.bookingconfirmation a').html('<div class="spinner-border text-light" role="status"></div>');
      
      $.post(base_url+'book_appoinments/set_booked_session',{
            doctor_username:doctor_username,
            appointment_details:appointment_details,
            price_type:$('#slot').val()
            
        },function(res){

          var obj = JSON.parse(res);
          if(obj.status===200)
          {
              setTimeout(function(){ window.location=base_url+'checkout'; },1000);
          }
          else
          {
              toastr.success(lg_appoinment_requ);
              setTimeout(function() {
                 window.location.href=base_url+"dashboard";
               }, 3000);

          }   
      });

    });

    $(document).on('change','#schedule_date',function(){
      var date = $('#schedule_date').val();
      var slot = $('#slot').val();
      $('.morning').empty();
      $('.morning').append('<tr>'+
                            '<td><div class="spinner-border" style="color: #ffc600" role="status"></div></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');
      $('.afternoon').empty();
      $('.afternoon').append('<tr>'+
                            '<td><div class="spinner-border" style="color: #ffc600" role="status"></div></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');
      $('.evening').empty();
      $('.evening').append('<tr>'+
                            '<td><div class="spinner-border" style="color: #ffc600" role="status"></div></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');
      $.post(base_url+'book_appoinments/get_slots',{date:date,slot:slot},function(res){
        var obj = JSON.parse(res);
        $('.morning').empty();
        $('.afternoon').empty();
        $('.evening').empty();
        if($.isEmptyObject(obj.morning)){

          $('.morning').append('<tr>'+
                            '<td><span>'+lg_no_slots_availa+'</span></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');

        }else{

          $.each(obj.morning, function(idx, result){ 
            $.each(result, function(key, value){
              if(key=='label'){
                $('.morning').append('<tr>'+
                            '<td><span class="available_slot" data-date="'+result.date+'" data-type="'+result.type+'" data-day="'+result.day_name+'" data-day-id="'+result.day_id+'" data-start-time="'+result.start_time+'" data-end-time="'+result.end_time+'" data-slot="'+result.slot+'" data-timezone="'+result.time_zone+'">'+result.label+'</span></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');
              }

            });
          });

        }

        if($.isEmptyObject(obj.afternoon)){

          $('.afternoon').append('<tr>'+
                            '<td><span>'+lg_no_slots_availa+'</span></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');

        }else{

          $.each(obj.afternoon, function(idx, result){ 
            $.each(result, function(key, value){
              if(key=='label'){
                $('.afternoon').append('<tr>'+
                            '<td><span class="available_slot" data-date="'+result.date+'" data-type="'+result.type+'" data-day="'+result.day_name+'" data-day-id="'+result.day_id+'" data-start-time="'+result.start_time+'" data-end-time="'+result.end_time+'" data-slot="'+result.slot+'" data-timezone="'+result.time_zone+'">'+result.label+'</span></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');
              }
            });
          });

        }

        if($.isEmptyObject(obj.evening)){

          $('.evening').append('<tr>'+
                            '<td><span>'+lg_no_slots_availa+'</span></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');

        }else{

          $.each(obj.evening, function(idx, result){ 
            $.each(result, function(key, value){
              if(key=='label'){
                $('.evening').append('<tr>'+
                            '<td><span class="available_slot" data-date="'+result.date+'" data-type="'+result.type+'" data-day="'+result.day_name+'" data-day-id="'+result.day_id+'" data-start-time="'+result.start_time+'" data-end-time="'+result.end_time+'" data-slot="'+result.slot+'" data-timezone="'+result.time_zone+'">'+result.label+'</span></td>'+
                            '<td></td>'+
                            '<td></td>'+
                          '</tr>');
              }
            });
          });

        }

      });

    });

  }

}

if(modules=='patient')
{
  if(pages=='checkout')
  {

    $('.OTP').hide();
    $('#resendotp').hide();

    

    $("#reset_password").validate({
        rules: {
       
            resetemail: {
              required: true,
              email: true,
              remote: {
                url: base_url+"signin/check_resetemail",
                type: "post",
                data: {
                    resetemail: function(){ return $("#resetemail").val(); }
                }
              }
            }
           },
        messages: {
            resetemail: {
                required: lg_please_enter_em,
                email: lg_please_enter_va1,
                remote: lg_your_email_addr
            }                 
        },
        submitHandler: function(form) {
            $.ajax({
                url: base_url+'signin/reset_password',
                data: $("#reset_password").serialize(),
                type: "POST",
                beforeSend: function(){
                    $('#reset_pwd').attr('disabled',true);
                    $('#reset_pwd').html('<div class="spinner-border text-light" role="status"></div>');
                   },
                success: function(res){
                    $('#reset_pwd').attr('disabled',false);
                    $('#reset_pwd').html(lg_reset_password);
                    
                    var obj = JSON.parse(res);
                    
                    if(obj.status===200)
                    {
                        $('#reset_password')[0].reset();
                        toastr.success(obj.msg);
                        $('#forgot_password_modal').modal('hide');
                        $('#login_modal').modal('show');
                    }
                    else
                    {
                        toastr.error(obj.msg);
                    }   
                }
            });
            return false;
        }
    });

    $("#sendotp").on('click', function() {
      
     var mobileno=$('#mobileno').val();
     var country_code=$('#country_code').val();
     if(mobileno=="")
      {
        toastr.error(lg_please_enter_va4);
      }
      else{
        $.ajax({
          url:base_url +'Signin/sendotp',
          data: {
            mobileno : mobileno,country_code:country_code,otpcount:'1'
          },
          
          dataType: "text",
          method:"post",
          beforeSend: function(){
            $('.otp_load').html('<div class="spinner-border text-light" role="status"></div>');
          },
          success:function(res){

            $('.otp_load').html('<a class="forgot-link" onclick="resend_otp()"  href="javascript:void(0);" id="resendotp">'+lg_resend_otp+'</a>');
      
            var obj = JSON.parse(res);
                
            if(obj.status===200)
            {
     
              $('.OTP').show();
              $('#resendotp').show();
              toastr.success(obj.msg);
    
            }
            else if(obj.status===500)
            {
              toastr.error(obj.msg);
            }
            else
            {
              toastr.error(obj.msg);
            }  
          }  
        });
      }
    });

 


    $("#register_form").validate({
      rules: {
        first_name: "required",
        last_name: "required",
        mobileno: {
            required: true,
            minlength: 7,
            maxlength: 12,
            digits: true,
            remote: {
            url: base_url+"signin/check_mobileno",
            type: "post",
            data: {
                mobileno: function(){ return $("#mobileno").val(); }
            }
          }
        },
        email: {
          required: true,
          email: true,
          remote: {
            url: base_url+"signin/check_email",
            type: "post",
            data: {
                email: function(){ return $("#register_email").val(); }
            }
          }
        },
        password: {
            required: true,
            minlength: 6
        },
        confirm_password: {
             required: true,
             equalTo: "#register_password"
        }
          
      },
      messages: {
        first_name: lg_please_enter_yo,
        last_name: lg_please_enter_yo1,
        mobileno: {
            required: lg_please_enter_mo,
            maxlength: lg_please_enter_va,
            minlength: lg_please_enter_va,
            digits: lg_please_enter_va,
            remote: lg_your_mobile_no_
        },
        email: {
            required: lg_please_enter_em,
            email: lg_please_enter_va1,
            remote: lg_your_email_addr1
        },
        password: {
            required: lg_please_enter_pa,
            minlength: lg_your_password_m
        },
        confirm_password: {
            required: lg_please_enter_co,
            equalTo: lg_your_password_d
        }
          
      },
      
      submitHandler: function(form) {
       
        $.ajax({
          url: base_url+'signin/signup',
          data: $("#register_form").serialize(),
          type: "POST",
          beforeSend: function(){
            $('#register_btn').attr('disabled',true);
            $('#register_btn').html('<div class="spinner-border text-light" role="status"></div>');
          },
          success: function(res){
            $('#register_btn').attr('disabled',false);
            $('#register_btn').html(lg_signup);
            var obj = JSON.parse(res);
            
            if(obj.status===200)
            {
              $('#register_form')[0].reset();
              toastr.success(obj.msg);
              $('#register_modal').modal('hide');
              $('#login_modal').modal('show');            
            }
            else
            {
              toastr.error(obj.msg);
            }   
          }
        });
        return false;
      }
    });


    $("#signin_form").validate({
      rules: {
          email: "required",
          password: {
             required: true,
              minlength: 6
          },
      },
      messages: {
          email: lg_please_enter_em,
          password: {
              required: lg_please_enter_pa,
              minlength: lg_your_password_m
          },
                          
      },
      submitHandler: function(form) {
        $.ajax({
            url: base_url+'signin/is_valid_login',
            data: $("#signin_form").serialize(),
            type: "POST",
            beforeSend: function(){
              $('#signin_btn').attr('disabled',true);
              $('#signin_btn').html('<div class="spinner-border text-light" role="status"></div>');
            },
            success: function(res){
              $('#signin_btn').attr('disabled',false);
              $('#signin_btn').html(lg_signin);
              
              var obj = JSON.parse(res);
              
              if(obj.status===200)
              {
                $('#login_modal').modal('hide');
                toastr.success(lg_logged_in_succe);
                window.location.reload();
              }
              else
              {
                toastr.error(obj.msg);
              }   
            }
        });
        return false;
      }
  });
  
  var google_token = $('#google_token').val();
  
  function appoinment_payment(type)
  {
     var terms_accept=$("input[name='terms_accept']:checked").val();
      // var terms_accept=1;
      if(terms_accept=='1')
      {
          if(type=='paypal')
          {
            $('#payment_formid').submit();
           
          }
          else if(type=='razorpay')
          {
            razorpay();
           
          }
          else
          {
              var payment_method=$("input[name='payment_methods']:checked").val();
              if(payment_method!='Card Payment')
              {
                $("#my_book_appoinment").click();
              }
              return false;
          }
      }
      else
      {
        toastr.warning(lg_please_accept_t); 
      }
  }

  function razorpay()
  {
    $('#razor_pay_btn').attr('disabled',true);
     $('#razor_pay_btn').html('<div class="spinner-border text-light" role="status"></div>');
    var amount=$('#amount').val();
    $.post(base_url+'book_appoinments/create_razorpay_orders',{amount:amount},function(data){

      $('#razor_pay_btn').attr('disabled',false);
      $('#razor_pay_btn').html(lg_confirm_and_pay2);
        var obj = jQuery.parseJSON(data);
          var options = {
              "key": obj.key_id, 
              "amount": obj.amount, 
              "currency": obj.currency,
              "name": obj.sitename,
              "description": "Booking Slot",
              "image": obj.siteimage,
              "order_id": obj.order_id, 
              "handler": function (response){
                  razorpay_appoinments(response.razorpay_payment_id,response.razorpay_order_id,response.razorpay_signature);
              },
              "prefill": {
                  "name": obj.patientname,
                  "email": obj.email,
                  "contact": obj.mobileno
              },
              "notes": {
                  "address": "Razorpay Corporate Office"
              },
              "theme": {
                  "color": "#F37254"
              }
          };

      var rzp1 = new Razorpay(options);
      rzp1.open();
      

    });
  }

  function razorpay_appoinments(payment_id,order_id,signature)
  {

    $('#payment_id').val(payment_id);
    $('#order_id').val(order_id);
    $('#signature').val(signature);

      $.ajax({

      url: base_url+'book_appoinments/razorpay_appoinments',

      data: $('#payment_formid').serialize(),      

      type: 'POST',

      dataType: 'JSON',

      beforeSend: function(){
              $('#razor_pay_btn').attr('disabled',true);
              $('#razor_pay_btn').html('<div class="spinner-border text-light" role="status"></div>');
            },

      success: function(response){
       // $('.overlay').hide();
        if(response.status=='200')
        {
          
           toastr.success(lg_transaction_suc);
           if(google_token == 'true'){
              setTimeout(function() {
                window.location.href=base_url+'book_appoinments/send_alerts';
              }, 1500);
           }else{
              setTimeout(function() {
                $('#google_calendar').modal('show');
              }, 1500);
           }

        }
        else
        {
            toastr.error(lg_transaction_fai1);
            setTimeout(function() {
              window.location.href=base_url+'dashboard';
            }, 2000);
        }

        

      },

      error: function(error){

        console.log(error);

      }

    });
  }

  var stripe = Stripe(stripe_api_key);

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Stripe Focusing Elements

var inputs = document.querySelectorAll('.doccure .input');
Array.prototype.forEach.call(inputs, function(input) {
  input.addEventListener('focus', function() {
    input.classList.add('focused');
  });
  input.addEventListener('blur', function() {
    input.classList.remove('focused');
  });
  input.addEventListener('keyup', function() {
    if (input.value.length === 0) {
      input.classList.add('empty');
    } else {
      input.classList.remove('empty');
    }
  });
});

var elementStyles = {
  base: {
    color: '#32325D',
    fontWeight: 500,
    fontSize: '16px',
    '::placeholder': {
      color: '#CFD7DF',
    },
    ':-webkit-autofill': {
      color: '#e39f48',
    },
  },
  invalid: {
    color: '#E25950',

    '::placeholder': {
      color: '#FFCCA5',
    },
  },
};

var elementClasses = {
  focus: 'focused',
  empty: 'empty',
  invalid: 'invalid',
};

var cardNumber = elements.create('cardNumber', {
  style: elementStyles,
  classes: elementClasses,
});
cardNumber.mount('#doccure-card-number');

var cardExpiry = elements.create('cardExpiry', {
  style: elementStyles,
  classes: elementClasses,
});
cardExpiry.mount('#doccure-card-expiry');

var cardCvc = elements.create('cardCvc', {
  style: elementStyles,
  classes: elementClasses,
});
cardCvc.mount('#doccure-card-cvc');

// Create an instance of the card Element.
// var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
// card.mount('#card-element');

// Handle real-time validation errors from the card Element.
cardNumber.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-number-error');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
cardExpiry.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-expiry-error');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
cardCvc.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-cvc-error');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
$('#card_name').on('keyup', function() {
  var displayError = document.getElementById('card-name-error');
  if ($('#card_name').val() == '') {
    document.getElementById("card_name").style.borderColor = "red";
    $( "#card_name" ).focus();
    displayError.textContent = "Name on Card is required";
  } else {
    document.getElementById("card_name").style.borderColor = "#dbdbdb";
    displayError.textContent = "";
  }
});
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  var displayError = document.getElementById('card-name-error');
  document.getElementById("card_name").style.borderColor = "#dbdbdb";
  displayError.textContent = '';
  if($('#card_name').val() == ''){
    document.getElementById("card_name").style.borderColor = "red";
    $( "#card_name" ).focus();
    displayError.textContent = "Name on Card is required";
    return false;
  }
  var terms_accept=$("input[name='terms_accept']:checked").val();
  $('#stripe_pay_btn').attr('disabled',true);
  $('#stripe_pay_btn').html('<div class="spinner-border text-light" role="status"></div>');
  stripe.createToken(cardNumber).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      $('#stripe_pay_btn').attr('disabled',false);
      $('#stripe_pay_btn').html(lg_confirm_and_pay1);
      // var errorElement = document.getElementById('card-errors');
      // errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      if(terms_accept==1){
        stripeTokenHandler(result.token);
      }else{
        $('#stripe_pay_btn').attr('disabled',false);
        $('#stripe_pay_btn').html(lg_confirm_and_pay1);
        toastr.warning(lg_please_accept_t); 
      }
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  
  $('#access_token').val(token.id);

    $.ajax({

      url: base_url+'book_appoinments/stripe_pay',

      data: $('#payment_formid').serialize(),      

      type: 'POST',

      dataType: 'JSON',

      beforeSend: function(){
              
            },

      success: function(response){
       // $('.overlay').hide();
        if(response.status=='200')
        {
          
           toastr.success(lg_transaction_suc);
           if(google_token == 'true'){
              setTimeout(function() {
                window.location.href=base_url+'book_appoinments/send_alerts';
              }, 1500);
           }else{
              setTimeout(function() {
                $('#google_calendar').modal('show');
              }, 1500);
           }

        }
        else
        {
            toastr.error(lg_transaction_fai1);
            setTimeout(function() {
              window.location.href=base_url+'dashboard';
            }, 2000);
        }

        

      },

      error: function(error){

        console.log(error);

      }

    });
}
$(document).ready(function(){

  $('#my_book_appoinment').click(function(e) {

 $.ajax({

      url: base_url+'book_appoinments/clinic_appoinments',

      data: $('#payment_formid').serialize(),      

      type: 'POST',

      dataType: 'JSON',

      beforeSend: function(){
              
            $('#pay_button').attr('disabled',true);
            $('#pay_button').html('<div class="spinner-border text-light" role="status"></div>');

      },success: function(response){

        if(response.status=='200')
        {
          
           toastr.success(lg_transaction_suc);
           if(google_token == 'true'){
              setTimeout(function() {
                window.location.href=base_url+'book_appoinments/send_alerts';
              }, 1500);
           }else{
              setTimeout(function() {
                $('#google_calendar').modal('show');
              }, 1500);
           }

        }
        else
        {
            toastr.error(lg_transaction_fai1);
            setTimeout(function() {
              window.location.href=base_url+'dashboard';
            }, 2000);
        }

        

      },

      error: function(error){

        console.log(error);

      }

    });

  e.preventDefault();

});

});

  $(document).ready(function(){
    $('input[type=radio][name=payment_methods]').change(function() {
  if (this.value == 'Card Payment') {
      $('.stripe_payment').show();
      $('.paypal_payment').hide();
      $('.clinic_payment').hide();
      $('.razorpay_payment').hide();
      $('#payment_method').val('Card Payment');
      
  }
  else if (this.value == 'PayPal') {
       $('.stripe_payment').hide();
       $('.paypal_payment').show();
       $('.clinic_payment').hide();
       $('.sslc_payment').hide();
       $('.razorpay_payment').hide();
        $('#payment_method').val('Card Payment');
       
  }
  else if (this.value == 'Pay on Arrive') {
       $('.stripe_payment').hide();
       $('.paypal_payment').hide();
       $('.clinic_payment').show();
       $('.sslc_payment').hide();
       $('.razorpay_payment').hide();
       $('#payment_method').val('Pay on Arrive');
       
  }
  else if (this.value == 'Razorpay') {
       $('.stripe_payment').hide();
       $('.paypal_payment').hide();
       $('.clinic_payment').hide();
       $('.sslc_payment').hide();
       $('.razorpay_payment').show();
       $('#payment_method').val('Card Payment');
       
  }
  else if (this.value == 'sslc') {
       $('.stripe_payment').hide();
       $('.paypal_payment').hide();
       $('.clinic_payment').hide();
       $('.razorpay_payment').hide();
       $('.sslc_payment').show();
       $('#payment_method').val('Card Payment');
       
  }
  else{
      $('.stripe_payment').hide();
       $('.paypal_payment').hide();
       $('.clinic_payment').hide();
       $('.razorpay_payment').hide();
       $('.sslc_payment').hide();
       $('#payment_method').val('');
  }
});
  });

}
}

if(modules=='doctor' || modules=='patient'){

  if(pages=='doctor_dashboard' || pages=='patient_dashboard'){
    function email_verification()
    {
      $.get(base_url+'dashboard/send_verification_email',function(data){
        toastr.success(lg_activation_mail);
      });
    }
  }
  if(pages=='doctor_dashboard'){

     var appoinment_table;
     
        appoinment_table = $('#appoinments_table').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // "language":{
            //   "url" : current_language_url,
            // },
            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'dashboard/appoinments_list',
                "type": "POST",
                "data": function ( data ) {
                   data.type =$('#type').val();
                },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });
    

     function appoinments_table(type)
     {
        $('#type').val(type);
        appoinment_table.ajax.reload(null,false); //reload datatable ajax 
     }

     appoinments_table(1);

     function show_appoinments_modal(app_date,book_date,amount,type) {
      $('.app_date').html(app_date);
      $('.book_date').html(book_date);
      $('.amount').html(amount);
      $('.type').html(type);
      $('#appoinments_details').modal('show');
   
  }

 }

if(pages=='my_patients'){
  my_patient(0);
         function my_patient(load_more){

        if(load_more == 0){
         $('#page_no_hidden').val(1);
       }

        var page = $('#page_no_hidden').val();        
             

     //$('#search-error').html('');

     $.ajax({
       url:  base_url +'my_patients/patient_list',
       type: 'POST',
       data: {page : page},
      beforeSend:function(){ 
       // $('#doctor-list').html('<div class="spinner-border text-success text-center" role="status"></div>'); 
      },
      success: function(response){
        //$('#doctor-list').html(''); 
        if(response){
          var obj = $.parseJSON(response);
          if(obj.data.length >=1) {
          var html = '';
          $(obj.data).each(function(){ 
   
            
          html +='<div class="col-md-6 col-lg-4 col-xl-3">'+
                  '<div class="card widget-profile pat-widget-profile">'+
                    '<div class="card-body">'+
                      '<div class="pro-widget-content">'+
                        '<div class="profile-info-widget">'+
                          '<a href="'+base_url+'mypatient-preview/'+this.userid+'" class="booking-doc-img">'+
                            '<img src="'+this.profileimage+'" alt="User Image">'+
                          '</a>'+
                          '<div class="profile-det-info">'+
                            '<h3><a href="'+base_url+'mypatient-preview/'+this.userid+'">'+this.first_name+' '+this.last_name+'</a></h3>'+
                            
                            '<div class="patient-details">'+
                              '<h5><b>'+lg_patient_id+' :</b> #PT00'+this.user_id+'</h5>'+
                              '<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> '+this.cityname+', '+this.countryname+'</h5>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                      '<div class="patient-info">'+
                        '<ul>'+
                          '<li>'+lg_phone+' <span>'+this.mobileno+'</span></li>'+
                          '<li>'+lg_age+' <span>'+this.age+', '+this.gender+'</span></li>'+
                          // '<li>'+lg_blood_group+' <span>'+this.blood_group+'</span></li>'+
                        '</ul>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>';
        });

          if(obj.current_page_no == 1){    
            $("#patients-list").html(html);    
          }else{
            $("#patients-list").append(html);    
          }         


       
          if(obj.count == 0){
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }


          if(obj.current_page_no == 1 && obj.count < 8){
            $('page_no_hidden').val(1);
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }



          if(obj.total_page > obj.current_page_no && obj.total_page !=0 ){                               
            $('#load_more_btn').removeClass('d-none');
            $('#no_more').addClass('d-none');
          }else{                                
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
          } 

          }
          else{
            var html='<div class="appointment-list">'+
                        '<div class="profile-info-widget">'+
                        '<p>'+lg_no_patients_fou+'</p>'+
                        '</div>'+
                        '</div>';
              $("#patients-list").html(html); 
          }               

        }                     
      }

    });
}



$('#load_more_btn').click(function(){    
 var page_no = $('#page_no_hidden').val(); 
 var current_page_no =0;

 if(page_no == 1){
  current_page_no = 2;
}else{
  current_page_no = Number(page_no) + 1;
}        
$('#page_no_hidden').val(current_page_no);
    my_patient(1);
});
}

if(pages=='mypatient_preview' || pages=='patient_dashboard'){
  
    var appoinment_table; 
    appoinment_table= $('#appoinment_table').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
            // "language":{
            //   "url" : current_language_url,
            // },
            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'my_patients/appoinments_list',
                "type": "POST",
                "data": function ( data ) {
                  data.patient_id =$('#patient_id').val();
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });
    

  function appoinments_table()
  {
      appoinment_table.ajax.reload(null,false);
  }

   var prescription_table; 
    prescription_table= $('#prescription_table').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'my_patients/prescriptions_list',
                "type": "POST",
                "data": function ( data ) {
                  data.patient_id =$('#patient_id').val();
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });
     

  function prescriptions_table()
  {
      prescription_table.ajax.reload(null,false);
  }

  function view_prescription(pre_id){
        $('.overlay').show();
        $.post(base_url+'my_patients/get_prescription_details',{pre_id:pre_id},function(res){        
          var obj = jQuery.parseJSON(res);
          var table = '<table class="table table-bordered table-hover">'+
          '<thead>'+
          '<tr>'+
          '<th>'+lg_sno+'</th>'+
          '<th>'+lg_drug_name+'</th>'+
          '<th>'+lg_quantity+'</th>'+
          '<th>'+lg_type+'</th>'+
          '<th>'+lg_days+'</th>'+
          '<th>'+lg_time+'</th>'+
          '</tr>'+
          '<tbody>';
          var i=1;
          $(obj).each(function(){
            var j = i++;
 
            table +='<tr>'+
            '<td>'+j+'</td>'+
            '<td>'+this.drug_name+'</td>'+
            '<td>'+this.qty+'</td>'+
            '<td>'+this.type+'</td>'+
            '<td>'+this.days+'</td>'+
            '<td>'+this.time+'</td>'+
            '</tr>'; 
          });   
          table +='</tbody>'+
          '</table>'+             
          '<div class="float-right">'+
          '<img src="'+base_url+obj[0].img+'" style="width:150px"><br>'+
          '( '+obj[0].doctor_name.charAt(0).toUpperCase() + obj[0].doctor_name.slice(1)+' ) <br>'+
          '<div>Doctor Signature</div><br>'+
          '</div>'; 
          $('#patient_name').text(obj[0].patient_name);    
          $('#view_date').text(obj[0].prescription_date); 
          $('.view_title').text(lg_prescription);   
          $('.view_details').html(table);
          $('#view_modal').modal('show');
          $('.overlay').hide();
        });

      }

      function delete_prescription(id)
      {
        $('#delete_id').val(id);
        $('#delete_table').val('prescription');
         $('#delete_title').text(lg_prescription);
         $('#delete_modal').modal('show');
      }


  var billing_table; 
    billing_table= $('#billing_table').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'my_patients/billing_list',
                "type": "POST",
                "data": function ( data ) {
                  data.patient_id =$('#patient_id').val();
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });
     

  function billings_table()
  {
      billing_table.ajax.reload(null,false);
  }

  function view_billing(id){
        $('.overlay').show();
        $.post(base_url+'my_patients/get_billing_details',{id:id},function(res){       
          var obj = jQuery.parseJSON(res);
          var table = '<table class="table table-bordered table-hover">'+
          '<thead>'+
          '<tr>'+
          '<th>'+lg_sno+'</th>'+
          '<th>'+lg_name+'</th>'+
          '<th>'+lg_amount+'</th>'+                
          '</tr>'+
          '<tbody>';
          var i=1;
          $(obj).each(function(){
            var j = i++;
            table +='<tr>'+
            '<td>'+j+'</td>'+
            '<td>'+this.name+'</td>'+
            '<td>'+this.amount+'</td>'+             
            '</tr>'; 
          });   
          table +='</tbody>'+
          '</table>'+             
          '<div class="float-right">'+
          '<img src="'+base_url+obj[0].img+'" style="width:150px"><br>'+
          '( '+obj[0].doctor_name.charAt(0).toUpperCase() + obj[0].doctor_name.slice(1)+' ) <br>'+
          '<div>Doctor Signature</div><br>'+
          '</div>';
          $('#patient_name').text(obj[0].patient_name);    
          $('#view_date').text(obj[0].billing_date); 
          $('.view_title').text(lg_doctor_billing);   
          $('.view_details').html(table);
          $('#view_modal').modal('show');
        });

      }



  function delete_billing(id)
  {
    $('#delete_id').val(id);
    $('#delete_table').val('billing');
     $('#delete_title').text(lg_bill4);
     $('#delete_modal').modal('show');
  }


  $('#medical_records_form').submit(function(e){
     e.preventDefault();
     var oFile = document.getElementById("user_files_mr").files[0];
     if(!document.getElementById("user_files_mr").files[0]){
      toastr.warning(lg_please_upload_m);         
            return false;
     }
     if(oFile){

          if (oFile.size > 25097152){ // 25 mb for bytes.   

            toastr.warning(lg_file_size_must_);         
            return false;
          }
        }

        var formData = new FormData($('#medical_records_form')[0]);
        $.ajax({
          url: base_url+'my_patients/upload_medical_records',
          type: 'POST',
          data: formData,
          beforeSend :function(){
            if(oFile){
             $('#medical_btn').attr('disabled',true);
             $('#medical_btn').html('<div class="spinner-border text-light" role="status"></div>');
           }
         },
         success: function(res) {
          $('#medical_btn').attr('disabled',false);
          $('#medical_btn').html(lg_submit);
          $('#add_medical_records').modal('hide');
          var obj = jQuery.parseJSON(res);
          if(obj.status===500){
             toastr.warning(obj.msg);
            $('#user_files_mr').val('');
            
          } else{
            $('#medical_records_form')[0].reset();
            toastr.success(obj.msg);
            medical_records_table();
          }              

        },
        error: function(data){
         //alert('error');

       },
       cache: false,
       contentType: false,
       processData: false
     });
        return false
  });

  var medical_record_table; 
    medical_record_table= $('#medical_records_table').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'my_patients/medical_records_list',
                "type": "POST",
                "data": function ( data ) {
                  data.patient_id =$('#patient_id').val();
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });
     

  function medical_records_table()
  {
      medical_record_table.ajax.reload(null,false);
  }

   function delete_medical_records(id)
    {
      $('#delete_id').val(id);
      $('#delete_table').val('medical_records');
       $('#delete_title').text(lg_medical_records);
       $('#delete_modal').modal('show');
    }

  

   function delete_details()
    {
      var id=$('#delete_id').val();
      var delete_table=$('#delete_table').val();
      $('#delete_btn').attr('disabled',true);
      $('#delete_btn').html('<div class="spinner-border text-light" role="status"></div>');
      $.post(base_url+'my_patients/delete_details',{id:id,delete_table,delete_table},function(res){

        if(delete_table=='prescription');
        {
          prescriptions_table();
        }

        if(delete_table=='medical_records');
        {
          medical_records_table();
        }

        if(delete_table=='billing');
        {
          billings_table();
        }

        $('#delete_btn').attr('disabled',false);
        $('#delete_btn').html(lg_yes);
        $('#delete_modal').modal('hide');
        

      });
    }

}

if(pages=='add_prescription' || pages=='edit_prescription' || pages=='add_billing' || pages=='edit_billing'){

  var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    saveButton = wrapper.querySelector("[data-action=save]"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;


    function resizeCanvas() {

      var ratio =  window.devicePixelRatio || 1;
      canvas.width = canvas.offsetWidth * ratio;
      canvas.height = canvas.offsetHeight * ratio;
      canvas.getContext("2d").scale(ratio, ratio);
    }

    signaturePad = new SignaturePad(canvas);
    clearButton.addEventListener("click", function (event) {
      signaturePad.clear();
    });

    saveButton.addEventListener("click", function (event) {

      if (signaturePad.isEmpty()) {
        console.log('You should sign!')
      }
      else {       
        $.ajax({
          type: "POST",
          url: base_url+'my_patients/insert_signature',
          data: {'image': signaturePad.toDataURL(),'rowno':$('#rowno').val()},
          beforeSend: function(){
                $('#save2').attr('disabled',true);
                $('#save2').html('<div class="spinner-border text-light" role="status"></div>');
               },
          success: function(res){ 
          $('#save2').attr('disabled',false);
          $('#save2').html('Save');           
            signaturePad.clear();
            $('#sign-modal').modal('hide');
            $('.doctor_signature').html('');
            $('.doctor_signature').html(res);
            $('.doctor_signature').removeClass('doctor_signature');

          }
        });
      }
    }); 

    $('.doctor_signature').click(function(){
      show_modal();
    });

    function show_modal(){
      $('#sign-modal').modal('show');
      $('#edit').addClass('doctor_signature');
    }


    function delete_row(id){
    $('#delete_'+id).remove();    
        //console.log(row_count);
    }

     function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

  }

if(pages=='add_prescription' || pages=='edit_prescription'){


    function add_more_row(){
      var hidden_count = $('#hidden_count').val();
      var total  = Number(hidden_count) + 1;
      $('#hidden_count').val(total);


      var append_rows = '<tr id="delete_'+total+'">'+               
      '<td><input type="text" name="drug_name[]" id="drug_name'+total+'" class="form-control filter-form"></td>'+
      '<td style="min-width: 100px; max-width: 100px;"><input type="text" onkeypress="return isNumberKey(event)" name="qty[]" id="qty'+total+'" class="form-control filter-form" maxlength="4"></td>'+
      '<td><select class="form-control filter-form" name="type[]" id="type'+total+'">'+
      '<option value="">'+lg_select_type+'</option>'+
      '<option value="Before Food">'+lg_before_food+'</option>'+
      '<option value="After Food">'+lg_after_food+'</option>'+
      '</select>'+
      '</td>'+
      '<td style="min-width: 100px; max-width: 100px;"><input onkeypress="return isNumberKey(event)" type="text" name="days[]" id="days'+total+'" class="form-control filter-form text" maxlength="4" autocomplete="off"></td>'+
      '<td>'+
        '<div class="row">'+
          '<div class="col-md-6">'+
            '<input type="checkbox" name="time'+total+'[]" value="Morning" id="morning'+total+'"><label for="morning'+total+'">&nbsp;&nbsp;'+lg_morning+'</label>'+
          '</div>'+
          '<div class="col-md-6">'+
            '<input type="checkbox" name="time'+total+'[]" value="Afternoon" id="afternoon'+total+'"><label for="afternoon'+total+'">&nbsp;&nbsp;'+lg_afternoon+'</label>'+
          '</div>'+
        '</div>'+
        '<div class="row">'+
          '<div class="col-md-6">'+
            '<input type="checkbox" name="time'+total+'[]" value="Evening" id="evening'+total+'"><label for="evening'+total+'">&nbsp;&nbsp;'+lg_evening+'</label>'+
          '</div>'+
          '<div class="col-md-6">'+
            '<input type="checkbox" name="time'+total+'[]" value="Night" id="night'+total+'"><label for="night'+total+'">&nbsp;&nbsp;'+lg_night+'</label>'+
          '</div>'+
        '</div>'+    
      '</td>'+
      '<td>'+
      '<a href="javascript:void(0)" class="btn bg-danger-light trash" onclick="delete_row('+total+')"><i class="far fa-trash-alt"></i></a>'+
      '</td>'+
      '</tr>';


      $('#add_more_rows').append(append_rows);
 
    }

   

    $(document).ready(function(){
      $("#add_prescription").validate({
    rules: {
      "drug_name[]": "required",
      "qty[]": "required",
      "type[]": "required",
      "days[]": "required",
      "time[]": "required"
    },
    messages: {
      "drug_name[]": lg_please_enter_dr,
      "qty[]": lg_please_enter_qt,
      "type[]": lg_please_select_t1,
      "days[]": lg_please_enter_da,
      "time[]": lg_please_select_t2          
    },
    submitHandler: function(form) {
      var signature_id = $('#signature_id').val();
      if(signature_id == 0){ /* Signature validation */
        toastr.error(lg_please_sign_to_);
      return false;
       }
        $.ajax({
            url: base_url+'my_patients/save_prescription',
            data: $("#add_prescription").serialize(),
            type: "POST",
            beforeSend: function(){
                $('#prescription_save_btn').attr('disabled',true);
                $('#prescription_save_btn').html('<div class="spinner-border text-light" role="status"></div>');
               },
            success: function(res){
                $('#prescription_save_btn').attr('disabled',false);
                $('#prescription_save_btn').html(lg_save);
                
                    var obj = JSON.parse(res);
                    
                    if(obj.status===200)
                    {
                      toastr.success(obj.msg);
                      setTimeout(function(){ window.location.href=base_url+'mypatient-preview/'+obj.patient_id; }, 3000);

                    }
                    else
                    {
                        toastr.error(obj.msg);
                    }   
            }
        });
        return false;
    }
});

      $("#update_prescription").validate({
    rules: {
      "drug_name[]": "required",
      "qty[]": "required",
      "type[]": "required",
      "days[]": "required",
      "time[]": "required"
    },
    messages: {
      "drug_name[]": lg_please_enter_dr,
      "qty[]": lg_please_enter_qt,
      "type[]": lg_please_select_t1,
      "days[]": lg_please_enter_da,
      "time[]": lg_please_select_t2           
    },
    submitHandler: function(form) {
      var signature_id = $('#signature_id').val();
      if(signature_id == 0){ /* Signature validation */
        toastr.error(lg_please_sign_to_);
      return false;
       }
        $.ajax({
            url: base_url+'my_patients/update_prescription',
            data: $("#update_prescription").serialize(),
            type: "POST",
            beforeSend: function(){
                $('#prescription_update_btn').attr('disabled',true);
                $('#prescription_update_btn').html('<div class="spinner-border text-light" role="status"></div>');
               },
            success: function(res){
                $('#prescription_update_btn').attr('disabled',false);
                $('#prescription_update_btn').html(lg_save);
                
                    var obj = JSON.parse(res);
                    
                    if(obj.status===200)
                    {
                      toastr.success(obj.msg);
                      setTimeout(function(){ window.location.href=base_url+'mypatient-preview/'+obj.patient_id; }, 3000);

                    }
                    else
                    {
                        toastr.error(obj.msg);
                    }   
            }
        });
        return false;
    }
});


    });



}

if(pages=='add_billing' || pages=='edit_billing'){

    function add_more_row(){
      var hidden_count = $('#hidden_count').val();
      var total  = Number(hidden_count) + 1;
      $('#hidden_count').val(total);
        var append_rows = '<tr id="delete_'+total+'">'+               
        '<td>'+
        '<input name="name[]" id="name'+total+'" class="form-control filter-form" >'+
        '<td>'+                 
        '<input name="amount[]" onkeypress="return isNumberKey(event)" id="amount'+total+'" class="form-control filter-form" >'+           
        '</td>'+
        '<td><a href="javascript:void(0)" class="btn bg-danger-light trash" onclick="delete_row('+total+')"><i class="far fa-trash-alt"></i></a></td>'+
        '</tr>';

    $('#add_more_rows').append(append_rows);

    }

     $(document).ready(function(){
      $("#add_billing").validate({
    rules: {
      "name[]": "required",
      "amount[]": "required"
      },
    messages: {
      "name[]": lg_please_enter_na,
      "amount[]": lg_please_enter_am
      },
    submitHandler: function(form) {
      var signature_id = $('#signature_id').val();
      if(signature_id == 0){ /* Signature validation */
        toastr.error(lg_please_sign_to_);
      return false;
       }
        $.ajax({
            url: base_url+'my_patients/save_billing',
            data: $("#add_billing").serialize(),
            type: "POST",
            beforeSend: function(){
                $('#bill_save_btn').attr('disabled',true);
                $('#bill_save_btn').html('<div class="spinner-border text-light" role="status"></div>');
               },
            success: function(res){
                $('#bill_save_btn').attr('disabled',false);
                $('#bill_save_btn').html(lg_save);
                
                    var obj = JSON.parse(res);
                    
                    if(obj.status===200)
                    {
                      toastr.success(obj.msg);
                      setTimeout(function(){ window.location.href=base_url+'mypatient-preview/'+obj.patient_id; }, 3000);

                    }
                    else
                    {
                        toastr.error(obj.msg);
                    }   
            }
        });
        return false;
    }
});

      $("#update_billing").validate({
    rules: {
      "name[]": "required",
      "amount[]": "required"
      },
    messages: {
      "name[]": lg_please_enter_na,
      "amount[]": lg_please_enter_am
      },
    submitHandler: function(form) {
      var signature_id = $('#signature_id').val();
      if(signature_id == 0){ /* Signature validation */
        toastr.error(lg_please_sign_to_);
      return false;
       }
        $.ajax({
            url: base_url+'my_patients/update_billing',
            data: $("#update_billing").serialize(),
            type: "POST",
            beforeSend: function(){
                $('#billing_update_btn').attr('disabled',true);
                $('#billing_update_btn').html('<div class="spinner-border text-light" role="status"></div>');
               },
            success: function(res){
                $('#billing_update_btn').attr('disabled',false);
                $('#billing_update_btn').html(lg_update);
                
                    var obj = JSON.parse(res);
                    
                    if(obj.status===200)
                    {
                      toastr.success(obj.msg);
                      setTimeout(function(){ window.location.href=base_url+'mypatient-preview/'+obj.patient_id; }, 3000);

                    }
                    else
                    {
                        toastr.error(obj.msg);
                    }   
            }
        });
        return false;
    }
});


    });
}



}

if(modules=='doctor' || modules=='patient'){
  if(pages=='change_password'){
    $(document).ready(function(){

         $("#change_password").validate({
            rules: {
                currentpassword: {
                  required: true,
                  remote: {
                    url: base_url+"profile/check_currentpassword",
                    type: "post",
                    data: {
                        currentpassword: function(){ return $("#currentpassword").val(); }
                    }
                  }
                },
               
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                     required: true,
                     equalTo: "#password"
                },
               },
            messages: {
                currentpassword: {
                    required: lg_please_enter_cu,
                    remote: lg_your_current_pa
                },
                password: {
                    required: lg_please_enter_pa,
                    minlength: lg_your_password_m
                },
                confirm_password: {
                    required: lg_please_enter_co,
                    equalTo: lg_your_password_d
                },
                
            },
            submitHandler: function(form) {
                $.ajax({
                    url: base_url+'profile/password_update',
                    data: $("#change_password").serialize(),
                    type: "POST",
                    beforeSend: function(){
                      $('#change_password_btn').attr('disabled',true);
                      $('#change_password_btn').html('<div class="spinner-border text-light" role="status"></div>');
                       },
                    success: function(res){
                        $('#change_password_btn').attr('disabled',false);
                        $('#change_password_btn').html(lg_change_password);
                        var obj = JSON.parse(res);
                           
                            if(obj.status===200)
                            {
                                $('#change_password')[0].reset();
                                toastr.success(obj.msg);
                            }
                            else
                            {
                                toastr.error(obj.msg);
                            }   
                    }
                });
                return false;
            }
        });

    });
  }
}

if(modules=='doctor'){
  if(pages=='appoinments'){
    setInterval(function() { my_appoinments(0); }, 3000);
  
         function my_appoinments(load_more){

        if(load_more == 0){
         $('#page_no_hidden').val(1);
       }

        var page = $('#page_no_hidden').val();        
             

     //$('#search-error').html('');

     $.ajax({
       url:  base_url +'appoinments/doctor_appoinments_list',
       type: 'POST',
       data: {page : page},
      beforeSend:function(){ 
       // $('#doctor-list').html('<div class="spinner-border text-success text-center" role="status"></div>'); 
      },
      success: function(response){
        //$('#doctor-list').html(''); 
        if(response){
          var obj = $.parseJSON(response);

        
          if(obj.current_page_no == 1){    
            $("#appointment-list").html(obj.data);    
          }else{
            $("#appointment-list").append(obj.data);    
          }         

         
          if(obj.count == 0){
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }


          if(obj.current_page_no == 1 && obj.count < 8){
            $('page_no_hidden').val(1);
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }



          if(obj.total_page > obj.current_page_no && obj.total_page !=0 ){                               
            $('#load_more_btn').removeClass('d-none');
            $('#no_more').addClass('d-none');
          }else{                                
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
          }

         
                

        }                     
      }

    });
}

$('#load_more_btn').click(function(){    
 var page_no = $('#page_no_hidden').val(); 
 var current_page_no =0;

 if(page_no == 1){
  current_page_no = 2;
}else{
  current_page_no = Number(page_no) + 1;
}        
$('#page_no_hidden').val(current_page_no);
    my_appoinments(1);
});



function show_appoinments_modal(app_date,book_date,amount,type) {
      $('.app_date').html(app_date);
      $('.book_date').html(book_date);
      $('.amount').html(amount);
      $('.type').html(type);
      $('#appoinments_details').modal('show');
   
  }

function conversation_status(id,status)
{
  if(status==1)
  {
    $('.app-modal-title').html(lg_accept);
    $('#app-modal-title').html(lg_accept);
    $('#appoinments_status').val('1');
    $('#appoinments_id').val(id);
   }

   if(status==0)
  {
    $('.app-modal-title').html(lg_cancel);
    $('#app-modal-title').html(lg_cancel);
    $('#appoinments_status').val('0');
    $('#appoinments_id').val(id);
   }
  
  $('#appoinments_status_modal').modal('show');
 
}
    function change_status()
    {
      var appoinments_id=$('#appoinments_id').val();
      var appoinments_status=$('#appoinments_status').val();
      $('#change_btn').attr('disabled',true);
      $('#change_btn').html('<div class="spinner-border text-light" role="status"></div>');
      $.post(base_url+'appoinments/change_status',{appoinments_id:appoinments_id,appoinments_status,appoinments_status},function(res){

         my_appoinments(0);

        $('#change_btn').attr('disabled',false);
        $('#change_btn').html(lg_yes);
        $('#appoinments_status_modal').modal('hide');
        

      });
    }

}

}
if(modules=='patient'){
if(pages=='appoinments'){
  setInterval(function() { my_pappoinments(0); }, 1000);
         function my_pappoinments(load_more){

        if(load_more == 0){
         $('#page_no_hidden').val(1);
       }

        var page = $('#page_no_hidden').val();        
             

     //$('#search-error').html('');

     $.ajax({
       url:  base_url +'appoinments/patient_appoinments_list',
       type: 'POST',
       data: {page : page},
      beforeSend:function(){ 
       // $('#doctor-list').html('<div class="spinner-border text-success text-center" role="status"></div>'); 
      },
      success: function(response){
        //$('#doctor-list').html(''); 
        if(response){
          var obj = $.parseJSON(response);
          
          if(obj.current_page_no == 1){    
            $("#appointment-list").html(obj.data);    
          }else{
            $("#appointment-list").append(obj.data);    
          }         

         
          if(obj.count == 0){
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }


          if(obj.current_page_no == 1 && obj.count < 8){
            $('page_no_hidden').val(1);
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
            return false;
          }



          if(obj.total_page > obj.current_page_no && obj.total_page !=0 ){                               
            $('#load_more_btn').removeClass('d-none');
            $('#no_more').addClass('d-none');
          }else{                                
            $('#load_more_btn').addClass('d-none');
            $('#no_more').removeClass('d-none');
          }

        }                     
      }

    });
}

$('#load_more_btn').click(function(){    
 var page_no = $('#page_no_hidden').val(); 
 var current_page_no =0;

 if(page_no == 1){
  current_page_no = 2;
}else{
  current_page_no = Number(page_no) + 1;
}        
$('#page_no_hidden').val(current_page_no);
    my_pappoinments(1);
});

function show_appoinments_modal(app_date,book_date,amount,type) {
      $('.app_date').html(app_date);
      $('.book_date').html(book_date);
      $('.amount').html(amount);
      $('.type').html(type);
      $('#appoinments_details').modal('show');
   
  }


}
}

if(pages=='invoice')
{

    $(document).ready(function() {
        //datatables
        var invoice_table;
     
        invoice_table = $('#invoice_table').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'invoice/invoice_list',
                "type": "POST",
                "data": function ( data ) {
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });


    });
}

if(pages=='accounts')
{

if(modules=='doctor'){


      //datatables
        var accounts_table;
     
        accounts_table = $('#accounts_table').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'accounts/doctor_accounts_list',
                "type": "POST",
                "data": function ( data ) {
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });



     function account_table()
    {
        accounts_table.ajax.reload(null,false);
    }


    var patient_refund_request_table;
     
        patient_refund_request_table = $('#patient_refund_request').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'accounts/patient_refund_request',
                "type": "POST",
                "data": function ( data ) {
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });


         function patient_refund_request()
        {
            patient_refund_request_table.ajax.reload(null,false);
        }

    function send_request(id,status)
    {
     
      $.post(base_url+'accounts/send_request',{id:id,status:status},function(res){

       account_table();
       patient_refund_request();
      });
    }

}



if(modules=='patient'){


  
      //datatables
        var doctor_request_table;
     
        doctor_request_table = $('#doctor_request').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'accounts/doctor_request',
                "type": "POST",
                "data": function ( data ) {
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });



     function doctor_request()
    {
        doctor_request_table.ajax.reload(null,false);
    }

    //datatables
        var paccounts_table;
     
        paccounts_table = $('#accounts_table').DataTable({
            'ordering':false,
            "processing": true, //Feature control the processing indicator.
            'bnDestroy' :true,
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                 "url": base_url+'accounts/patient_accounts_list',
                "type": "POST",
                "data": function ( data ) {
                   },
                error:function(){
                      
                    }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
            { 
                "targets": [ 0 ], //first column / numbering column
                "orderable": false, //set not orderable
            },
            ],

        });

function register(){

      $('#login_modal').modal('hide');
      $('#register_modal').modal('show');

    }

    function login(){

      $('#register_modal').modal('hide');
      $('#forgot_password_modal').modal('hide');
      $('#login_modal').modal('show');

    }

    function forgot_password(){

      $('#login_modal').modal('hide');
      $('#forgot_password_modal').modal('show');

    }

     function paccount_table()
    {
        paccounts_table.ajax.reload(null,false);
    }


    function send_request(id,status)
    {
      
      $.post(base_url+'accounts/send_request',{id:id,status:status},function(res){

       paccount_table();
       doctor_request();
      });
    }

}


function add_account_details()
{
        $.ajax({
             url : base_url+"accounts/get_account_details",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
               
                $('[name="bank_name"]').val(data.bank_name);
                $('[name="branch_name"]').val(data.branch_name);
                $('[name="account_no"]').val(data.account_no);
                $('[name="account_name"]').val(data.account_name);
                

                 // show bootstrap modal when complete loaded
               

            }


        });

        $('#account_modal').modal('show');
}

function payment_request(type)
{
       $('#payment_type').val(type);
       $('#payment_request_modal').modal('show');
}

function amount()
{
   var a=$('#request_amount').val();
   if(a!='')
   {
     $('#request_amount').val(parseInt(a));
   }
   
 }


$(document).ready(function (e){
            $("#accounts_form").on('submit',(function(e){
                e.preventDefault();

                
                 var bank_name= $('[name="bank_name"]').val();
                 var branch_name= $('[name="branch_name"]').val();
                 var account_no= $('[name="account_no"]').val();
                 var account_name= $('[name="account_name"]').val();
                

                if(bank_name==''){
                    toastr.error(lg_please_enter_ba);
                    return false;
                }
                if(branch_name==''){
                    toastr.error(lg_please_enter_br);
                    return false;
                }
                if(account_no==''){
                    toastr.error(lg_please_enter_ac1);
                    return false;
                }
                if(account_name==''){
                    toastr.error(lg_please_enter_ac2);
                    return false;
                }

                              
                 $.ajax({
                    url: base_url+'accounts/add_account_details',
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend:function() { 

                        $('#acc_btn').html('<div class="spinner-border text-light" role="status"></div>');
                        $('#acc_btn').attr('disabled',true);
                  
                    },
                    success: function(data){

                      $('#acc_btn').html(lg_save);
                      $('#acc_btn').attr('disabled',false);
                              
                       var obj=jQuery.parseJSON(data);
                        if(obj.result=='true')
                        {
                            
                            toastr.success(obj.status);

                              $('#account_modal').modal('hide');
                              $('#bank_name').html(bank_name);
                              $('#branch_name').html(branch_name);
                              $('#account_no').html(account_no);
                              $('#account_name').html(account_name);
                              
                        }
                         else
                        {
                             toastr.error(obj.status);
                        }
                    }

                });
            }));



            $("#payment_request_form").on('submit',(function(e){
                e.preventDefault();

                
                 var request_amount= $('[name="request_amount"]').val();
                 
                if(request_amount==''){
                    toastr.error(lg_please_enter_am);
                    return false;
                }
                       
                 $.ajax({
                    url: base_url+'accounts/payment_request',
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend:function() { 

                        $('#request_btn').html('<div class="spinner-border text-light" role="status"></div>');
                        $('#request_btn').attr('disabled',true);
                  
                    },
                    success: function(data){

                      $('#request_btn').html(lg_request);
                      $('#request_btn').attr('disabled',false);
                              
                       var obj=jQuery.parseJSON(data);
                        if(obj.result=='true')
                        {
                            
                            toastr.success(obj.status);

                              $('#payment_request_modal').modal('hide');
                              $('#payment_request_form')[0].reset();

                              window.location.reload();
                        }
                         else
                        {
                             toastr.error(obj.status);
                        }
                    }

                });
            }));


        });




}

