
<script type="text/javascript">
  function Mychangecompanystatus(thisdata){
    var retailid=$('#retailid').val();
     if ($(thisdata).is(':checked')) {
       retailid++;
       $('#retailid').val(retailid);
       thisdata.setAttribute("checked", "checked");
     }
     else{
          retailid--;
         $('#retailid').val(retailid);
         thisdata.removeAttribute("checked", "checked");
     }

  }
$( document ).ready(function() {
  
//tab active and deactive script  
 $('#collapseOne23').on('click',function(){
          $("#collapseOne").show();
          $("#collapseTwo").hide();  
     
          $("#collapseOne23").addClass('active');
          $('.collapseclient').removeClass('active');

                 
    });
   $('.collapseclient').on('click',function(){
          $("#collapseOne").hide();
          $("#collapseTwo").show();

          $('.collapseclient').addClass('active')
          $("#collapseOne23").removeClass('active'); 
        
    });

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
          emailcheckvalue=$("#companyemailid").val();
          if (emailcheckvalue ==  null || emailcheckvalue ==  "")
          {
                  toastr.error('Please fill up Company Email');
                  return false;
          }
          //company type validation
          if($('#retailid').val()==0){
              toastr.error(' Please Select Company Type');
              return false;
          }
          //company state required validation
          statevalue=$("#stateid").val();  
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
           //company source validation
           var clientsourceval=$('#clientsourceid').val();
           if(clientsourceval == ""){
            toastr.error('Please Select Company Source field');
            return false;
           }
 
           //client firstname
           $("input[class *= 'addfname']").each(function(){
              var firstclientnameempty=$(this).val(); 
                if(firstclientnameempty == ""){
            
                  toastr.error("Please fill up Client First Name Field."); 
                   event.preventDefault(); 
                   return false;
                } 

            }); 
         //client first name validation
         $("span[class *= 'clientfirstnameerror']").each(function(){
              var firstclientname=$(this).text(); 
                if(firstclientname != ""){
            
                  toastr.error("Please Check Client First Name Field."); 
                   event.preventDefault(); 
                   return false;
                } 

            });  
          //client last name validation
          $("span[class *= 'clientlastnameerror']").each(function(){
              var lastclientname=$(this).text(); 
                if(lastclientname != ""){
            
                  toastr.error("Please Check Client Last Name Field.");  
                   event.preventDefault();
                   return false;
                } 

          });  
         //company email validation and duplicatin
          $("span[class *= 'companyemailerror']").each(function(){
              var companyemail=$(this).text(); 
                if(companyemail != ""){
            
                  toastr.error("Please Check Company Email Field");  
                   event.preventDefault();
                   return false;
                } 

          }); 
         //client email validation and duplication
          $("span[class *= 'clientemailerror']").each(function(){
              var companyemail=$(this).text(); 
                if(companyemail != ""){
            
                  toastr.error("Please Check Client Email Field");  
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
         //client phone validation
          $("span[class *= 'clientphoneerror']").each(function(){
              var companyphone=$(this).text(); 
                if(companyphone != ""){
            
                  toastr.error("Please Check Client Phone Field");  
                  event.preventDefault();
                  return false;
                } 

          });
          //company country required vlaidation
          var scountryvalue=$("#scountryid").val();
          if (scountryvalue ==  null || scountryvalue ==  "")
          {
                  toastr.error('Please Select Company Country');
                  $("#scountryid").focus();
                  return false;
          }
          
         
    
      
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

  var urlregex = /^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.)/ ;
  
  if (!urlregex.test(websiteval)) {
       $(".website_error").text("Not Valid Url");
  }
  else {    
          $(".website_error").text("");
          $(".website_success").text("Success");
          $(".website_success").fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
         
  }

});

    var rowNum = 0;
   $("#addclientrow").on("click",function () {
      rowNum++;
        $("#addclient").append('<div class="mt-2 pl-2"><a href="JavaScript:void(0);" class="delteclient mt-1 pr-3 btn btn-danger btn-outline">Delete Client</a><div  class="row mt-1 pr-3 pl-2 "><div class="col-md-3 pr-1"><div class="form-group"><label for="first_name">First Name<span style="color: red">*</span></label><input type="text" name="first_name['+rowNum+']"  class=" form-control addfname"value=""  required="required"  onfocusout="myClifirstnamecheck(this,'+rowNum+')"><span class="first_name_error'+rowNum+' text-danger spantext clientfirstnameerror" for="first_name"></span><span  class="first_name_success'+rowNum+' text-success spantext" for="first_name"></span></div></div><div class="col-md-2 px-1"><div class="form-group"><label for="last_name">Last Name</label><input type="text" name="last_name['+rowNum+']" value="" class="form-control addlname" required="required" "myClilastnamecheck(this,'+rowNum+')"><span class="last_name_error'+rowNum+' text-danger spantext clientlastnameerror" for="last_name"></span><span  class="last_name_success'+rowNum+' text-success spantext" for="last_name"></span></div></div><div class="col-md-2 px-1"><div class="form-group"><label for="designation">DESIGNATION</label><input type="text" name="designation['+rowNum+']"  value=" " class="form-control" ></div></div><div class="col-md-3 px-1 cemail" ><div id="emailtextboxclient" class="form-group-sm"><label for="client_email_primary">Email</label><input type="email" name="client_email_primary['+rowNum+'][]"  value="" class=" form-control emptyemail'+rowNum+'   emailcheck cliemail" required="required" onfocusout="myCliemailcheck(this,'+rowNum+'0)"><span id="client_email_primary_error" class="client_perror'+rowNum+'0 text-danger spantext clientemailerror"></span><span id="client_email_primary_success" class="success client_perrorsuccess'+rowNum+'0 text-success spantext" for="client_email_primary"></span></div><a href="JavaScript:void(0);" class="btn btn-sm btn-primary btn-outline addclientemail mt-1"> <i class="fa fa-plus" aria-hidden="true"></i></a><input type="hidden" value="'+rowNum+'"></div><div class="col-md-2 pl-1" id=""><div id="phonetextboxclient" class="form-group-sm"><label for="client_contact_1">Contact</label><input type="text" name="client_contact_1['+rowNum+'][]"  value="" class="form-control emptyphone'+rowNum+' cliphone" required="required" onfocusout="myCliphonecheck(this,'+rowNum+'0)"><span  class="client_phoneerror'+rowNum+'0 text-danger spantext clientphoneerror"></span><span  class="client_phonesuccess'+rowNum+'0 text-success spantext" ></span></div><a href="JavaScript:void(0);" class="btn btn-sm btn-primary btn-outline addclientphone mt-1"> <i class="fa fa-plus" aria-hidden="true"></i></a><input type="hidden" value="'+rowNum+'"></div><div class="col-md-2 pr-1"><div class="form-group"><label class="">linkedin URL</label><input type="text"  class="form-control mt-0"  name="linkedin_url['+rowNum+']" placeholder="" value="" ><h5 class="text-left mt-4">Client Address</h5></div></div><div class="col-md-6 px-1"><div class="form-group"><label for="client_note">Client Description / Note</label><textarea name="client_note['+rowNum+']" value="" class="form-control form-control2"></textarea></div></div><div class="col-md-4 pl-1"><label>Client Special Details</label><textarea name="self_client_specification['+rowNum+']" class="form-control form-control2 client_specific"></textarea></div><div class="col-md-1 pr-1"><label>Unit NO</label><input type="text" name="cunitno['+rowNum+']" class="form-control"></div><div class="col-md-3 px-1"><label>Street Name</label><input type="text" name="cstreet['+rowNum+']" class="form-control"></div><div class="col-md-2 px-1"><label>Country</label><select class="form-control mt-0 scountryclient" name="ccountry['+rowNum+']"><option value="">Select country</option><option value="US">US</option><option value="UK">UK</option><option value="CANADA">CANADA</option><option value="AUSTRALIA">AUSTRALIA</option><option value="NEW ZEALAND">NEW ZEALAND</option><option value="Other">Other</option></select></div><div class="col-md-2 px-1"><label>State</label><select class="form-control mt-0 clientsstate" id="clientstateid" name="cstate['+rowNum+']"><!--  <option>none</option> --></select><input name="clientother_state['+rowNum+']" class="clienteditstate" style="display:none;" placeholder="Text" value=""></div><div class="col-md-2 px-1"><label>city/county</label><select class="form-control mt-0 clientscounty" id="clientcountyid" name="ccounty['+rowNum+']"></select><input name="clientother_county['+rowNum+']" class="clienteditcounty" style="display:none;" placeholder="Text " value=""></div><div class="col-md-2 pl-1"><label>Zip Code</label><input type="text" name="czipcode['+rowNum+']" class="form-control"></div></div></div>');
   });

    $( "#addclient" ).on( "click", '.delteclient',  function() {
      Swal.fire({
          title: 'Are you sure?',
          text: "Do you want to Delete Client!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            Swal.fire(
              'Deleted!',
              'Client has been deleted.',
              'success'
            )
            $(this).closest('div').remove();
          }
          else{
             Swal.fire(
              'You canceled delete operation.',
            )
          }
        })
         
    });

   
    $(".compinfo").on("click", function() {
        $('#comp').toggle();
    });
    
//already company in database checked
 $('.compinput').on('focusout', function() {
      
     var value =  $.trim($(this).val());
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
//$(document).ready(function(){
 //  $("input").not(".addaddr").on("cut copy paste",function(e) {
 //     e.preventDefault();
 //  });
//});
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
//select client conuntry name
   $(document).on("change", ".scountryclient", function(e){ 
       var countryname =  this.value ;
        // $('.clientsstate').empty().append('<option value="">none</option>').find('option:first').attr("selected","selected");
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
                        $('.clientsstate').append(myselect.html());      
                             
                 },
                   
                });

    });
//select client city name and time zone from state selection
    $(document).on("change", ".clientsstate", function(e){ 
         var statename =  this.value ;
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
                              $.each(city1, function(index, key) {
                             myselectcity.append( $('<option></option>').val(key).html(key) );

                         });    
                          $('.clientscounty').append(myselectcity.html()); 
                        
                      
                       
                               
                   },
                     
                  });
    });

     var i=0;
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
       i++;
      $("#emailtextboxcompany").append('<div class="input-group input-group-unstyled mt-1"><input type="email" id="comemail['+i+']" class="form-control coemail"  placeholder="" name="company_email[]" value="" required="" onfocusout="myComemailcheck(this,'+i+')"><a href="JavaScript:void(0);" class="removecompanyemailfield btn3">X</a></div><span id="email_error" class="email_error'+i+' text-danger spantext companyemailerror" for="email"></span><span id="email_success" class="email_success'+i+' text-success spantext" for="email"></span>');
         document.getElementById('comemail['+i+']').focus();
       }
    });
    //multiple company email delete
    $('#emailtextboxcompany').on("click",".removecompanyemailfield", function(){ 
       
         $(this).parent().next("span").remove();
         $(this).parent('div').remove();

    });

  //multiple phone company
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
       i++;

      $("#phonetextboxcompany").append('<div class="input-group input-group-unstyled mt-1"><input type="text" id="comphone['+i+']"  class="form-control cophone" name="company_phone[]" value="" pattern="[1-9]{1}[0-9]{9}" required=""  onfocusout="myComephonecheck(this,'+i+')"><a href="#" class="remove_companyphonefield btn3">X</a></div> <span id="phone_error" class="phone_error'+i+' text-danger spantext companyphoneerror" for="phone"></span><span id="phone_success" class="phone_success'+i+' text-success spantext" for="phone"></span>');
         document.getElementById('comphone['+i+']').focus();
      }  
    });
   //multiple company phone delete
    $('#phonetextboxcompany').on("click",".remove_companyphonefield", function(){ 
         $(this).parent().next("span").remove(); 
         $(this).parent('div').remove();

    });



 //add client phone script
      v=0;
 $("#addclient").on("click","a.addclientphone",function () {
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
      $(this).parent('div').find("#phonetextboxclient").append('<div class="input-group input-group-unstyled mt-1"><input type="text" id="client_contact_1['+v+']" class="form-control phno  emptyphone'+rowno+' cliphone"  placeholder="" name="client_contact_1['+rowno+'][]" value="" pattern="[1-9]{1}[0-9]{9}" required="" onfocusout="myCliphonecheck(this,'+num+')"><a href="JavaScript:void(0);" class="remove_phonefield btn3">X</a></div> <span  class="client_phoneerror'+rowno+v+' text-danger spantext clientphoneerror"></span><span  class="client_phonesuccess'+rowno+v+' text-success spantext" ></span>');
       document.getElementById('client_contact_1['+v+']').focus();  
     }
  });
  //remove client phone script
  $("#addclient").on("click","a.remove_phonefield.btn3",function () {
             $(this).parent().next("span").remove(); 
             $(this).parent('div').remove();
  });

  //add client email script
  $("#addclient").on("click","a.addclientemail",function () {
       
      // alert($(this).next().val());
       var did=$(this).next().val();
       var a=0;
       $("input[class *= 'emptyemail"+did+"']").each(function(){
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
   
      $(this).parent('div').find('#emailtextboxclient').append('<div class="input-group input-group-unstyled mt-1"><input type="email" id="cliemail['+v+']"  class="form-control emailid emptyemail'+rowno+' cliemail"  placeholder="" name="client_email_primary['+rowno+'][]" value="" required="" onfocusout="myCliemailcheck(this,'+num+')"><a href="JavaScript:void(0);" class="remove_emailfield btn3 ">X</a></div> <span id="client_email_primary_error" class="client_perror'+rowno+v+' text-danger spantext clientemailerror"></span><span id="client_email_primary_success" class="success client_perrorsuccess'+rowno+v+' text-success spantext" for="client_email_primary"></span>');
         document.getElementById('cliemail['+v+']').focus(); 
      } 
  });
  //delete client email
  $('#addclient').on("click","a.remove_emailfield.btn3", function(){ //user click on remove text
        $(this).parent().next("span").remove(); 
        $(this).parent('div').remove();
  });

//check company email syntax function
function myComemailcheck(thisemail,classbackvalue){
  var coemailval =  $(thisemail).val();
   var comailmatchcheck=0;
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
//check client email syntax function
function myCliemailcheck(thisclientemail,clientclassbackvalue){
 
      var cliemailval =  $(thisclientemail).val();
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
            $(".client_perror"+clientclassbackvalue).text("This Email already inserted in form.");
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
                                 
                                  $(".client_perror"+clientclassbackvalue).text("Duplicate Email Id, Already used");

                               
                              }
        
                            }
                        });

      }
     

} 
//check company phone validation function
function myComephonecheck(thisphone,classbackvalue){

      var comphoneval =  $(thisphone).val();

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
//check client phone duplication function
function myCliphonecheck(thisclientphone,clientclassbackvalue){
      var cliphoneval =  $(thisclientphone).val();
      var cliphonematchcheck=0;
      if(cliphoneval == ""){
        if(clientclassbackvalue == '00'){
            $(".client_phoneerror"+clientclassbackvalue).text("");
            return false;
        }
      
        else{
            $(".client_phoneerror"+clientclassbackvalue).text("This field is required");
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
          $(".client_phoneerror"+clientclassbackvalue).text("This Contact already inserted in form.");
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
                                 
                                  $(".client_phoneerror"+clientclassbackvalue).text("Duplicate Phone Number, Already used");

                               
                              }
        
                            }
                        });

      
     

} 
//check client first name validation
function myClifirstnamecheck(thisclientname,clientclassbackvalue){
    var iChars = "`~!@#$%^&*()+=[]\\\';,/{}|\":<>?";
    for (var i = 0; i < thisclientname.value.length; i++) {
      if (iChars.indexOf(thisclientname.value.charAt(i)) != -1) {
          Swal.fire("Your First Name has special characters. \nThese are not allowed.\n Please remove them and try again.");
           $(".first_name_error"+clientclassbackvalue).text("Special characters not allow");
            return false;

      }
    }
      var value =  $.trim($(thisclientname).val());
      var value =  $.trim(thisclientname.value);
      $(thisclientname).val(value);
      if (value  == "") {
          $(".first_name_error"+clientclassbackvalue).text("This field is required"); 
      }
      else {
          $(thisclientname).css("text-transform", "capitalize");
          $(".first_name_error"+clientclassbackvalue).text("");
          $(".first_name_success"+clientclassbackvalue).text("Success"); 
          $(".first_name_success"+clientclassbackvalue).fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
      }
}
//check client last name validation
function myClilastnamecheck(thisclientname,clientclassbackvalue){
     var value =  $.trim($(thisclientname).val());
     $(thisclientname).val(value);
     $(thisclientname).css("text-transform", "capitalize");
     var iChars = "`!@#$%^&*()+=[]\\\';,/{}|\":<>?";

     for (var i = 0; i < thisclientname.value.length; i++) {
       if (iChars.indexOf(thisclientname.value.charAt(i)) != -1) {
          Swal.fire("Your Last Name has special characters. \nThese are not allowed.\n Please remove them and try again.");
           $(".last_name_error"+clientclassbackvalue).text("Special characters not allow");
            return false;

       }
      }
      if (value  == "") {
        
      }
      else {
          $(thisclientname).css("text-transform", "capitalize");
          $(".last_name_error"+clientclassbackvalue).text("");
          $(".last_name_success"+clientclassbackvalue).text("Success"); 
          $(".last_name_success"+clientclassbackvalue).fadeIn('fast').animate({opacity: 1.0}, 1500).effect("pulsate", { times: 2 }, 800).fadeOut('slow');
      }
    
  
}

</script>
