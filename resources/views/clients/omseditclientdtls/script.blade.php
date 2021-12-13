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
                       toastr.error ("Please Check Company Name Field.");
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
     
      //if country name is other
      if(countryname == "Other"){
         $('.editstate').show();  
         $('.editstate').focus();
         $('.editcounty').show();    
      }
      else{
         $('.editstate').hide(); 
         $('.editcounty').hide(); 
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
      }
      else{
        $('.editstate').hide(); 
         $('.editcounty').hide();  
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
   //add client phone script
v=0;
 $(".addclientphone").on("click",function () {

      var did=$(this).next().val();
      var a=0;
      $("input[class *= 'emptyphone"+did+"']").each(function(){
        var phone=$(this).val();
      
        if(phone == ""){
           a=1;
          toastr.error('Client Phone field is empty.');
        }
      });
      if(a != 1){ 
       v++;
       var rowno=$(this).next().val();
       var num = rowno+v;
       num= "'"+num+"'";
      $(this).parent('div').find("#phonetextboxclient").append('<div class="input-group input-group-unstyled mt-1 mb-1"><input type="text" id="client_contact_1['+v+']" class="form-control phno  emptyphone'+rowno+' cliphone"  placeholder="" name="client_contact_1[]" value=""  required="" onfocusout="myCliphonecheck(this,'+num+')"><a href="JavaScript:void(0);" class="remove_phonefield btn3">X</a></div> <span  class="client_phoneerror'+rowno+v+' text-danger spantext clientphoneerror"></span><span  class="client_phonesuccess'+rowno+v+' text-success spantext" ></span>');
       document.getElementById('client_contact_1['+v+']').focus();  
     }
  });
  //remove client phone script
  $("#phonetextboxclient").on("click","a.remove_phonefield.btn3",function () {
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to Delete this Contact!",
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
  //delete phone number
  $('.deletephone').on('click',function(){
      Swal.fire({
          title: 'Are you sure?',
          text: "You want to Delete this Contact!",
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
  //add client email script
  v=0;
  $(".addclientemail").on("click",function () {
       var a=0;
       $("input[class *= 'emptyemail']").each(function(){
        var email=$(this).val();

        if(email == ""){
           a=1;
          toastr.error('Client Email field is empty.');
        }
      });
      if(a != 1){ 
      v++;
      var rowno=$(this).next().val();
      var num = rowno+v;
      num= "'"+num+"'";
   
      $(this).parent('div').find('#emailtextboxclient').append('<div class="input-group input-group-unstyled mt-1 mb-1"><input type="email" id="cliemail['+v+']"  class="form-control emailid emptyemail cliemail"  placeholder="" name="client_email_primary[]" value="" required="" onfocusout="myCliemailcheck(this,'+num+')"><a href="JavaScript:void(0);" class="remove_emailfield btn3 ">X</a></div> <span id="client_email_primary_error" class="client_perror'+rowno+v+' text-danger spantext clientemailerror"></span><span id="client_email_primary_success" class="success client_perrorsuccess'+rowno+v+' text-success spantext" for="client_email_primary"></span>');
         document.getElementById('cliemail['+v+']').focus(); 
      } 
  });
  //delete client email
  $('#emailtextboxclient').on("click","a.remove_emailfield.btn3", function(){ //user click on remove text
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to Delete this Contact!",
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




//check client email syntax function
function myCliemailcheck(thisclientemail,clientclassbackvalue){

      var cliemailval =  $(thisclientemail).val();
    
      //avoid client email self duplicatin code
      var alredycheckcliemailvalue=$(thisclientemail).next().val();
    
      if(cliemailval == alredycheckcliemailvalue && alredycheckcliemailvalue!= ""){

           return false;
      }
      var climailmatchcheck=0;
      if(cliemailval == ""){

        if(clientclassbackvalue == '00'){
            $(".client_perror"+clientclassbackvalue).text("");
            return false;
        }
        else{
            $(".client_perror"+clientclassbackvalue).text("Email is required");
             return false;
        }
      }
      //check duplicate client email in form
       $("input[class *= 'cliemail']").each(function(){
            var climatchemail=$(this).val();
            if(cliemailval == climatchemail){
              climailmatchcheck++;
            }
          });
        if(climailmatchcheck >= 2){ 
            Swal.fire({
                        type: 'warning',
                        title: 'Oops...',
                        text: ''+$(thisclientemail).val()+' email already inserted in form',
                       
            })
      
             $(thisclientemail).val("");
          $(".client_perror"+clientclassbackvalue).text("Email is required.");
                return false;
        }

       var urlregex =/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      if (!urlregex.test(cliemailval)) {
           $(".client_perror"+clientclassbackvalue).text("Not Valid email");
      }
      else{

         $(".client_perror"+clientclassbackvalue).text("");
          // $(".email_success"+classbackvalue).text("Success");
          // $(".email_success"+classbackvalue).fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
  
                  $.ajax({
                          type: "post",
                          cache: false,
                          async: true,
                          datatype: "json",
                          url: "{{ URL::to('clients/getemail') }}",
                          data: {  "_token": "{{ csrf_token() }}", cliemail:cliemailval},
                          beforesend : function(data) {  console.log(data) ;},
                          error       : function(err) { alert("Could not connect to the registration server."); },
                          success: function(response)
                          { 
                            console.log(response) ; 
                            
                           
                             if (response == 0) {

                                $(".client_perrorsuccess"+clientclassbackvalue).text("Success");
                                $(".client_perrorsuccess"+clientclassbackvalue).fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
  
                                 
                             
                               }

                              else
                              {
                                 Swal.fire({
                                    type: 'warning',
                                    title: 'Oops...',
                                    text: ''+$(thisclientemail).val()+' Duplicate Email Id, Already used',
                       
                                 })
                                 $(thisclientemail).val("");
                                  $(".client_perror"+clientclassbackvalue).text("Email is required.");

                               
                              }
        
                            }
                        });

      }
     

} 
//check client phone duplication function
function myCliphonecheck(thisclientphone,clientclassbackvalue){
      var cliphoneval =  $(thisclientphone).val();
      //avoid client email self duplicatin code
      var alredycheckcliphonevalue=$(thisclientphone).next().val();
      if(cliphoneval == alredycheckcliphonevalue && alredycheckcliphonevalue != ""){
        
           return false;
      }
      var cliphonematchcheck=0;
      if(cliphoneval == ""){
        if(clientclassbackvalue == '00'){
            $(".client_phoneerror"+clientclassbackvalue).text("");
            return false;
        }
      
        else{
            $(".client_phoneerror"+clientclassbackvalue).text("Contact is required");
             return false;
        }
      }
      //check duplicate client phone in form
       $("input[class *= 'cliphone']").each(function(){
            var climatchphone=$(this).val();
            if(cliphoneval == climatchphone){
              cliphonematchcheck++;
            }
          });
        if(cliphonematchcheck >= 2){ 
              Swal.fire({
                          type: 'warning',
                          title: 'Oops...',
                          text: ''+$(thisclientphone).val()+' Contact already inserted in form',
                       
                        })
              $(thisclientphone).val();
          $(".client_phoneerror"+clientclassbackvalue).text("Contact is required.");
            return false;
        }
        $(".client_phoneerror"+clientclassbackvalue).text("");
    
                  $.ajax({
                          type: "post",
                          cache: false,
                          async: true,
                          datatype: "json",
                          url: "{{ URL::to('clients/getphone') }}",
                          data: {  "_token": "{{ csrf_token() }}", cliphone:cliphoneval},
                          beforesend : function(data) {  console.log(data) ;},
                          error       : function(err) { alert("Could not connect to the registration server."); },
                          success: function(response)
                          { 
                            console.log(response) ; 
                            
                           
                             if (response == 0) {

                                $(".client_phonesuccess"+clientclassbackvalue).text("Success");
                                $(".client_phonesuccess"+clientclassbackvalue).fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
  
                                 
                             
                               }

                              else
                              {
                                 Swal.fire({
                                    type: 'warning',
                                    title: 'Oops...',
                                    text: ''+$(thisclientphone).val()+' Duplicate Contact, Already used',
                       
                                 })
                                 $(thisclientphone).val("");
                                 $(".client_phoneerror"+clientclassbackvalue).text("Contact is required");

                               
                              }
        
                            }
                        });
  }
function myChangerevblock(thisdata,stausonoff){

  var lastClass = $(thisdata).attr('class').split(' ').pop();
   //alert( $('#blacklist'+eventvalue).val());

if(lastClass == "bypassclass"){
        $(thisdata).removeClass(lastClass);
}   
else{
if(lastClass == "open"){

  if ($(thisdata).is(':checked')) {
        //switchStatus = $(thisdata).is(':checked')

        Swal.fire({
          title: 'Are you sure?',
          text: "You want to block this client!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
               $('#blacklist').val('Y');
               $('#clientblockmodal').modal('show');
               
              
          }
          else{
             
                 $(thisdata).removeClass(lastClass);
                 $(thisdata).addClass('close');
                 $(thisdata).bootstrapToggle('off');
                 $('#blacklist').val('N');

          }
      })
       
      
    }
    else{
        Swal.fire({
          title: 'Are you sure?',
          text: "You want to unblock this Client!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
            
                $('#blacklist').val('N');
              
           
          }
          else{
         
               $(thisdata).removeClass(lastClass);
               $(thisdata).addClass('close');
               $(thisdata).bootstrapToggle('on');
               $('#blacklist').val('Y');
                 
             
          }
      })
    }
   }
   else{
     $(thisdata).removeClass(lastClass);
     $(thisdata).addClass('open');
   }
  }
 }
 $(document).on('click', '#writeclientblockreason', function(e) {
    var companytext=$('#clientblocktext').val();
    $('#blacklistreason').val(companytext);
    $( "#clientblockmodal" ).modal("hide");
 });
</script>
