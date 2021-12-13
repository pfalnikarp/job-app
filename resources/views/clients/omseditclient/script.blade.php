
<script type="text/javascript">

$( document ).ready(function() {
    // alert("hello");
// prevent enter key on any text box  added on 14/01/2020
   $("input:text").keypress(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });

   $('textarea').keypress(function(event) {

          if ((event.keyCode || event.which) == 13) {

          event.preventDefault();
          return false;

          }

   });
//click on submit button than check error code
    $(".chkerror").click(function(event) {

         
         //company name validation
          value=$("#client_company").val();
          
           if (value ==  null || value ==  "")
           {
              toastr.error('Please fill up Company field');
              return false;
           }
          var iChars = "`~!$%^*()+=[]\\\';,/{}|\":<>?";

            for (var i = 0; i < value.length; i++) {
                if (iChars.indexOf(value.charAt(i)) != -1) {
                       toastr.error ("Special characters are not allowed in Company Name field.");
                          event.preventDefault();
                       return false;
                 
                    }
            }
          //check validate fields are not empty
          // emailcheckvalue=$("#companyemailid").val();
          // if (emailcheckvalue ==  null || emailcheckvalue ==  "")
          // {
          //         toastr.error('Please fill up Company Email');
          //         return false;
          // }
          statevalue=$("#stateid").val();
              //state field
          otherstatevalue=$("#otherstateid").val();
           if (statevalue ==  null || statevalue ==  "")
           {
             if(otherstatevalue == null && otherstatevalue == ""){
              toastr.error('Please Select Company State field');
              return false;
            }
           }
           if(otherstatevalue != ""){
            //add state
            $('#stateid').empty().append('<option value="'+otherstatevalue+'">'+otherstatevalue+'</option>').find('option:first').attr("selected","selected");

            //add conty
            var othercountyvlaue=$('#othercountyid').val();
            $('#County').empty().append('<option value="'+othercountyvlaue+'">'+othercountyvlaue+'</option>').find('option:first').attr("selected","selected");
            
              //add time zone
             var othertimezonevalue=$('#othertimezoneid').val();
              $('#time_zone').empty().append('<option value="'+othertimezonevalue+'">'+othertimezonevalue+'</option>').find('option:first').attr("selected","selected");
           }
         //company email validation and duplicatin
          $("span[class *= 'companyemailerror']").each(function(){
              var companyemail=$(this).text(); 
                if(companyemail != ""){
            
                  toastr.error("Please Check Company Email Field");  
                   event.preventDefault();
                   return false;
                } 

          }); 
      
         //company phone validation
         $("span[class *= 'companyphoneerror']").each(function(){
              var companyphone=$(this).text(); 
                if(companyphone != ""){
            
                  toastr.error("Please Check Company Phone Field");  
                   event.preventDefault();
                   return false;
                } 

          });
       
    });

});



$(".addaddr").focusout(function(event) {
 
  $(".addaddr").css("text-transform", "capitalize");
  if($(".addaddr").val()=="") {
      return false;
  }
 
});

//check website syntax
$(".addwebsite").focusout(function(event) {
 
  var websiteval =  $(this).val();
  if(websiteval == ""){
     $(".website_error").text("");
     return false;
  }

  var urlregex = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/gi;
  
  if (!urlregex.test(websiteval)) {
       $(".website_error").text("Not Valid Url");
  }
  else {    
          $(".website_error").text("");
          $(".website_success").text("Success");
          $(".website_success").fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
         
  }

});

  $(".compinfo").on("click", function() {
        $('#comp').toggle();
  });
    
//already company in database checked
 $('.compinput').on('focusout', function() {
      
     var value =  $.trim($(this).val());
     var alreadyvalue= $.trim($('#allredycompanynameid').val());
     $(this).val(value);
     $(this).css("text-transform", "capitalize");

       if (value  == "") { 
             $(".client_company_error").text("This field is required");
             $("input#client_company").focus();
             return false;
       }
       else{
         $(".client_company_error").text("");
       }
       if(value == alreadyvalue){
          return false;
       }
       var thisval=$(this);
       $.ajax({
            type: "post",
            cache: false,
            async:false,
            datatype: "json",
            url: "{{ URL::to('clients/compdtl') }}",
            data: {"search":value,"_token": "{{ csrf_token() }}"},
            success:function(data)
                {
                    if(data != "not match"){

                         Swal.fire({
                                          type: 'info',
                                          title: 'Company already exist',
                                          html: data+' to continue with '+value+'',
                                          confirmButtonColor: 'red',
                                          confirmButtonText: 'Cancel'
                                          
                                     }).then(function(dismiss) {
                                        if (dismiss != 'ok') {
                                             $(thisval).val("");
                                             $(thisval).focus();

                                         }
                                      })
                         

                    }
                    else{
                       Swal.fire({
                         type:'warning',
                         title:'Are you sure?',
                         text:'Confirm Change of Company Name, Related Orders will be changed',

                       })
                     
                    }
                   

                }
        
        });
 
});
// avoid this routine as no company help required on 02-dec-16(on text change check name and give matching name in dropdown box)
$('.compinput').on("focus", function(e) {
     var value = this.value ;
     //debugger;

     if (value  == "") {
             
            e.preventDefault();
            return false;
           
       }

    var comp = $("#client_company").val() ;
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
  

    var token = $('meta[name="csrf-token"]').attr('content');
    $(this).autocomplete({
        
        //source: "{{ URL::to('gmails/fetchcomp') }}",
       source: function(request, response) {
      $.post("{{ URL::to('gmails/fetchcomp') }}", {_token:token, term: request.term, comp1: comp},
         response, "json");
    },

        minLength: 1 ,
      
    
    select: function(event, ui) {
            //var $itemrow = $(this).closest('tr');
                   
          
          $('#client_company').val(ui.item.client_company);
                    
          //$('#client_company').focus();

            return false;
      }
    
      }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
  return $( "<li>" )
    .data( "ui-autocomplete-item", item )
    .append( "<a>" +  item.client_company  +  "</a>" )
    .appendTo( ul );
};


});

//prevent copy paste content
$(document).ready(function(){
   $("input").not(".addaddr").on("cut copy paste",function(e) {
      e.preventDefault();
   });
});
//select country name get state name  
  $(document).on("change", ".scountry", function(e){    
      var countryname =  this.value ;
    
      $('#stateid').empty().append('<option value="">none</option>').find('option:first').attr("selected","selected");
       $('#time_zone').empty();
      //if country name is other
      if(countryname == "Other"){
         $('.editstate').show();  
         $('.editstate').focus();
         $('.editcounty').show();   
         $('.edittimezone').show();  
         $('#time_zone').empty();
         $('#County').empty();    
      }
      else{

        $('#otherstateid').val("");
        $('#othertimezoneid').val("");
        $('#othercountyid').val("");
        $('.editstate').hide(); 
        $('.editcounty').hide(); 
        $('.edittimezone').hide();    
      // console.log(countryid);
       var myselect = $('<select>');
         $.ajax({
                type: "post",
                url: "{{route('get.statename')}}",
                data: {
                             "_token": "{{ csrf_token() }}",
                             "countryname":countryname,     
                       },
                 
                 success: function(data){    
                  
                       var state=data;
                       $.each(state, function(index, key) {
                           myselect.append( $('<option></option>').val(key).html(key) );
                       });    
                        $('#stateid').append(myselect.html());      
                             
                 },
                   
                });
       }

  });
//select city name and time zone from state selection
    $(document).on("change", ".sstate", function(e){    
      var statename =  this.value ;
      if(statename == "Other"){
         $('.editstate').show();  
         $('.editcounty').show();  
         $('.editstate').focus(); 
         $('.edittimezone').show();  
              
      }
      else{
        $('.editstate').hide(); 
         $('.editcounty').hide();  
        $('.edittimezone').hide();    
      }
        $('#County').empty().append('<option value="">none</option>').find('option:first').attr("selected","selected");
        $('#time_zone').empty();
   
         var myselectcity = $('<select>');
         var myselecttime= $('<select>');
           $.ajax({
                  type: "post",
                  url: "{{route('get.cityname')}}",
                  data: {
                               "_token": "{{ csrf_token() }}",
                               "statename":statename,     
                         },
                   
                   success: function(data){    
                              console.log(data.time); 
                              var city1=data.city;
                              var timezone=data.time;
                              $.each(city1, function(index, key) {
                             myselectcity.append( $('<option></option>').val(key).html(key) );

                         });    
                          $('#County').append(myselectcity.html()); 
                        
                        myselecttime.append( $('<option></option>').val(timezone).html(timezone) );  
                        $('#time_zone').append(myselecttime.html());   
                               
                   },
                     
                  });
       

      });


     var i=0;
     var lastemailidvalue=$('#lastemailvalueid').val();
    //multiple email  company
    $("#addcompanyemail").on("click",function () {    
      var a=0;
      $("input[class *= 'coemail']").each(function(){
        var email=$(this).val();
        if(email == ""){
           a=1;
          toastr.error('Company Email field is empty.');
        }
      });
      if(a != 1){ 
       lastemailidvalue++;
      
      $("#emailtextboxcompany").append('<div class="input-group input-group-unstyled mt-1 mb-1"><input type="email" id="comemail['+lastemailidvalue+']" class="form-control coemail"  placeholder="" name="company_email[]" value="" required="" onfocusout="myComemailcheck(this,'+lastemailidvalue+')"><a href="JavaScript:void(0);" class="removecompanyemailfield btn3">X</a></div><span id="email_error" class="email_error'+lastemailidvalue+' text-danger spantext companyemailerror" for="email"></span><span id="email_success" class="email_success'+lastemailidvalue+' text-success spantext" for="email"></span>');
         document.getElementById('comemail['+lastemailidvalue+']').focus();
       }
    });
    //multiple company email delete
    $('#emailtextboxcompany').on("click",".removecompanyemailfield", function(){ 
         Swal.fire({
          title: 'Are you sure?',
          text: "You want to Delete this Email!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            $(this).parent().next("span").remove();
            $(this).parent('div').remove();      
          }
          else{
             
             
          }
      })
       
    });

  //multiple phone company
    var lastphoneidvalue=$('#lastphonevalueid').val();
    $("#addcompanyphone").on("click",function (e) {
      var a=0;
      $("input[class *= 'cophone']").each(function(){
        var phone=$(this).val();
        if(phone == ""){
           a=1;
          toastr.error('Company Phone field is empty.');
        }
      });
      if(a != 1){ 
       lastphoneidvalue++;

      $("#phonetextboxcompany").append('<div class="input-group input-group-unstyled mt-1 mb-1"><input type="text" id="comphone['+lastphoneidvalue+']"  class="form-control cophone" name="company_phone[]" value="" required=""  onfocusout="myComephonecheck(this,'+lastphoneidvalue+')"><a href="#" class="remove_companyphonefield btn3">X</a></div> <span id="phone_error" class="phone_error'+lastphoneidvalue+' text-danger spantext companyphoneerror" for="phone"></span><span id="phone_success" class="phone_success'+i+' text-success spantext" for="phone"></span>');
         document.getElementById('comphone['+lastphoneidvalue+']').focus();
      }  
    });
   //multiple company phone delete
    $('#phonetextboxcompany').on("click",".remove_companyphonefield", function(){ 
          Swal.fire({
          title: 'Are you sure?',
          text: "You want to Delete this Phone!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            $(this).parent().next("span").remove(); 
            $(this).parent('div').remove();
                 
          }
          else{
             
             
          }
      })
        

    });

//check company email syntax function
function myComemailcheck(thisemail,classbackvalue){
  var coemailval =  $(thisemail).val();
  var comailmatchcheck=0;
  //avoid email self duplicatin code
  var alredycheckemailvalue=$(thisemail).next().val();

  if(coemailval == alredycheckemailvalue && alredycheckemailvalue != ""){
 
       return false;
  }
  //check blank email field
   if(coemailval == ""){
   
        $(".email_error"+classbackvalue).text("This field is required");
         return false;
    
   }
   //check duplicate email in form
   $("input[class *= 'coemail']").each(function(){
        var comatchemail=$(this).val();
        if(coemailval == comatchemail){
          comailmatchcheck++;
        }
      });
    if(comailmatchcheck >= 2){ 
           $(".email_error"+classbackvalue).text("This Email already inserted in form.");
            return false;
    }
   
   var urlregex =/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!urlregex.test(coemailval)) {
       $(".email_error"+classbackvalue).text("Not Valid email");
  }
  else {    
          $(".email_error"+classbackvalue).text("");
          // $(".email_success"+classbackvalue).text("Success");
          // $(".email_success"+classbackvalue).fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
  
                  $.ajax({
                          type: "post",
                          cache: false,
                          async: true,
                          datatype: "json",
                          url: "{{ URL::to('clients/getemail') }}",
                          data: {  "_token": "{{ csrf_token() }}", coemail:coemailval},
                          beforesend : function(data) {  console.log(data) ;},
                          error       : function(err) { alert("Could not connect to the registration server."); },
                          success: function(response)
                          { 
                            console.log(response) ; 
                            
                           
                             if (response == 0) {

                                   $(".email_success"+classbackvalue).text("Success");
                                   $(".email_success"+classbackvalue).fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
  
                                 
                             
                               }

                              else
                              {
                                 
                                  $(".email_error"+classbackvalue).text("Duplicate Email Id, Already used");

                               
                              }
        
                            }
                        });
 

         
  }


}

//check company phone validation function
function myComephonecheck(thisphone,classbackvalue){

      var comphoneval =  $(thisphone).val();
      //avoid phone self duplicatin code
      var alredycheckphonevalue=$(thisphone).next().val();
      if(comphoneval == alredycheckphonevalue && alredycheckphonevalue != ""){

           return false;
      }

      var cophonematchcheck=0;
      //blank phone validation more added phone
      if(comphoneval == ""){
             if(classbackvalue == '0'){
            $(".phone_error"+classbackvalue).text("");
            return false;
        }
        else{
            $(".phone_error"+classbackvalue).text("This field is required");
             return false;
        }
      }
      //check duplicate company phone in form
       $("input[class *= 'cophone']").each(function(){
            var comatchphone=$(this).val();
            if(comphoneval == comatchphone){
              cophonematchcheck++;
            }
          });
        if(cophonematchcheck >= 2){ 
               $(".phone_error"+classbackvalue).text("This Phone already inserted in form.");
                return false;
        }
         $.ajax({
                          type: "post",
                          cache: false,
                          async: true,
                          datatype: "json",
                          url: "{{ URL::to('clients/getphone') }}",
                          data: {  "_token": "{{ csrf_token() }}", cophone:comphoneval},
                          beforesend : function(data) {  console.log(data) ;},
                          error       : function(err) { alert("Could not connect to the registration server."); },
                          success: function(response)
                          { 
                            console.log(response) ; 
                            
                           
                             if (response == 0) {

                                $(".phone_success"+classbackvalue).text("Success");
                                $(".phone_success"+classbackvalue).fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
                                $(".phone_error"+classbackvalue).text("");
                                 
                             
                               }

                              else
                              {
                                 
                                  $(".phone_error"+classbackvalue).text("Duplicate Phone Number, Already used");

                               
                              }
        
                            }
                        });

}
 function Mychangecompany(thisdata){

 var lastClass = $(thisdata).attr('class').split(' ').pop();
  
if(lastClass == "open"){
  if ($(thisdata).is(':checked')) {
        //switchStatus = $(thisdata).is(':checked')
     
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to block this Company!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
          
               $("#blacklistcompany").val("Y");

               $("#companyblockmodal" ).modal("show");

             
          }
          else{
          
                 $(thisdata).removeClass(lastClass);
                 $(thisdata).addClass('close');
                 $(thisdata).bootstrapToggle('off');
                 $('#blacklistcompany').val('N');
          }
      })
        
    }
        else{
      
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to unblock this Company!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            
                $('#blacklistcompany').val('N');
               
           
          }
          else{
              
               $(thisdata).removeClass(lastClass);
               $(thisdata).addClass('close');
               $(thisdata).bootstrapToggle('on');
               $('#blacklistcompany').val('Y');
             
          }
      })
    }
    }
   else{
     $(thisdata).removeClass(lastClass);
     $(thisdata).addClass('open');
   }
 }
 $(document).on('click', '#writecompanyblockreason', function(e) {
    var companytext=$('#companyblocktext').val();
    $('#blacklistcompanyreason').val(companytext);
    $( "#companyblockmodal" ).modal("hide");
 });
</script>
