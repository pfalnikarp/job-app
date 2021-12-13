<script src="http://malsup.github.io/jquery.form.js"></script> 
<script type="text/javascript">
  //company client table 
$(function () {
     var table = $('#clientrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
       // stateSave: true,
       // stateDuration: -1,
       // bStateSave: true,
       // fixedColumns: false,
       // autowidth: false,
       // scrollX: false,
       // bAutoWidth: true,
       // scrollY: '400px',//scroll vertically
        //lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],

        //fixedHeader: {
        ///    header: true,
        //    footer: true
       // },
       //  scrollX: true,//scroll horizontally

        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          lengthMenu: [[50,-1], [50,"All"]],
        "language": {
                    @permission('client.create')
                    "lengthMenu": '<a href="JavaScript:void(0);"class="btn btn-outline btn-success rightdiv" id="newclientid">Add Client</a>'
                    @endpermission
                    },
          //Import data in datatable
        ajax: "{{ route('company.relatedclients',['id'=>$client->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
              
          ],
          columns: [   
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'client_name', name:'client_name'}, 
          @permission('show.primary-email')
            {data:'client_email_primary',name:'client_email_primary',"render":function(data,type,full,meta){

                 if(data == null || data == "")
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                        var i;
                        var text1="";
                
                        for (i = 0; i < obj.length; i++) {
        
                          text1 += '<span>'+obj[i]+'</span><br>';
                        }
                          return  text1; 
                    }
                 }
            },
          @endpermission
          @permission('contact1.show')
            {data: 'client_contact_1', name:'client_contact_1',"render":function(data,type,full,meta){
              if(data == null || data == "")
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                        var i;
                        var text1="";
                
                        for (i = 0; i < obj.length; i++) {
        
                          text1 += '<span>'+obj[i]+'</span><br>';
                        }
                          return  text1; 
                    }
              }
            },
          @endpermission 
            {data:'designation',name:'designation'},
            {data:'client_note',name:'client_note'},
            {data:'black_list',name:'black_list'},
            {data:'action',name:'action',class:'dt-center',"render":function(data,type,full,meta){
                  urlclient="{{route('workseat.showclientdtloperations',':id')}}";
                                    urlclient = urlclient.replace(':id',full.id);

                                    data= '<a href="'+urlclient+'" class="btn btn-sm btn-outline btn-info mt-1"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                                    return data;
                  
            }},
 
           ], 
         
      });
  });
//company work seat 
@permission('show.virtual.assistant')
   var urlclient="{{route('workseat.createworkseat',['id'=>$client->id])}}";
   
 
$(function () {
     var table = $('#worksheetrecords').DataTable({
        processing: true,
        serverSide: true,
        async: true,
        responsive: true,
        //scrollCollapse: true, 
       // stateSave: true,
       // stateDuration: -1,
       // bStateSave: true,
       // fixedColumns: false,
       // autowidth: false,
       // scrollX: false,
       // bAutoWidth: true,
       // scrollY: '400px',//scroll vertically
        //lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],

        //fixedHeader: {
        ///    header: true,
        //    footer: true
       // },
       //  scrollX: true,//scroll horizontally

        //fix column table it must be true and add css word-break:break-word;
         paging:  true,//give pagination in bottom
          lengthMenu: [[50,-1], [50,"All"]],

        "language": {
                     @permission('create.virtual.assistant') 
                    "lengthMenu": '<a href="'+urlclient+'" class="btn btn-outline btn-success rightdiv" id="addworkseatid">Add Virtual Assistant</a>'
                      @endpermission
                    },

          //Import data in datatable
        ajax: "{{ route('company.relatedworkseat',['id'=>$client->id]) }}",
        columnDefs: [
               {className: "dt-center", targets: "_all"},
              
          ],
          columns: [   
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          
            {data: 'department', name:'department',"render":function(data,type,full,meta){
              if(data == null || data == "")
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                        var i;
                        var text1="";
                     
                        for (i = 0; i < obj.length; i++) {
        
                          text1 += '<span>'+obj[i]+'</span><br>';
                        }
                          return  text1; 
                    }
              }}, 
          
            {data: 'wcountry', name:'wcountry'}, 
            {data: 'days', name:'days',"render":function(data,type,full,meta){
              if(data == null || data == "")
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                        var i;
                        var text1="";
                
                        for (i = 0; i < obj.length; i++) {
        
                          text1 += '<span>'+obj[i]+'</span><br>';
                        }
                          return  text1; 
                    }
              }}, 
            {data:'hours',name:'hours',"render":function(data,type,full,meta){
              if(data == null || data == "")
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                        var i;
                        var text1="";
                
                        for (i = 0; i < obj.length; i++) {
                         if(obj[i] != ""){
                          text1 += '<span>'+obj[i]+' hours</span><br>';
                         }
                        }
                          return  text1; 
                    }
              }
            },
            {data: 'worktime', name:'worktime',"render":function(data,type,full,meta){
              if(data == null || data == "")
                    {
                          return "-";
                    }
                    else{
                    var obj=data.split(",");
                        var i;
                        var text1="";
                
                        for (i = 0; i < obj.length; i++) {
                            if(obj[i] != ""){
                          text1 += '<span>'+obj[i]+'</span><br>';
                         }
                        
                        }
                          return  text1; 
                    }
              }}, 
            {data:'resource1',name:'resource1'},
            {data:'handler1',name:'handler1'},
           @permission('show.amont')
            {data:'revenue',name:'revenue'},
           @endpermission
            {data: 'wcountry', name:'wcountry',"render":function(data,type,full,meta){
              data=data+"<br>("+full.wtimezone+")";
              return data;
            }}, 
            {data:'action',name:'action',class:'editdata dt-center',"render":function(data,type,full,meta){
                  urlclient="{{route('workseat.showworkseatoperations',':id')}}";
                                    urlclient = urlclient.replace(':id',full.id);
                  urlworkedit="{{route('workseat.showworkseatoperations',':id')}}";
                                    urlworkedit=urlworkedit.replace(':id',full.id);

                                    data= '<a href="'+urlclient+'" class="btn btn-sm btn-outline btn-info mt-1"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                                    data+= '<a href="'+urlworkedit+'" class="btn btn-sm btn-outline btn-info mt-1"><i class="fa fa-edit" aria-hidden="true"></i></a>';

                                    return data;
                  
            }},
           
 
           ], 
         
      });
  });


@endpermission

function validatemyform() {

//debugger;
 
 value=$("#client_company").val();



 if (value ==  null )
 {
    //alert('error in company');
     Swal.fire({
              icon: 'error',
              title: 'Error',
              text: "Error in Company"
                                          
          })
    return  1

 }

  if (value == '' )
 {
    return  1

 }

   var iChars = "`~!$%^*()+=[]\\\';,/{}|\":<>?";

    for (var i = 0; i < value.length; i++) {
        if (iChars.indexOf(value.charAt(i)) != -1) {
              alert ("Company Name has special characters. \nThese are not allowed.\n Please remove them and try again.");
              return 1;
         
            }
    }


 

 $email = [];
 var proceed = 0 ;
 $('input[name^="client_email_primary"]').each(function(e) {
          ///debugger;
           var $email1 = this.value;
           //  alert($email1);
           var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
     
            //var v1 = $(this).val();
            var v1 = this.value;
          // alert(v1);
            if (!filter.test(v1)) {
                $(this).closest("tr").find(".client_perror").text("Invalid Email Id "); 
                //alert("invalid");
                proceed  = 1 ;
                return false;

            }
       $email.push($email1);

   });   

   if (proceed == 1)
   {
    return 1 ;
   }
         
       // alert($email.length);
       for (var i = 0; i < $email.length; i++) 
        {
            for (var j = i+1; j < $email.length; j++) 
            {                  
                    if ($email[i] == $email[j]) 
                    {
                        //$(this).closest("tr").find(".client_perror").show();
                        $(this).closest("tr").find(".client_perror").text("Duplicate Email Id");
                        $(this).closest('tr').find('.emailcheck').focus();
                       // alert("duplicate email id");
                        // e.preventDefault();
                       
                        return 1; // means there are duplicate values
                    }

            }
        }
    
      return 0;


}



$( document ).ready(function() {
 //delete workseat code 
  $('#worksheetrecords').on('click','.delva',function(){

     var wvalue=$(this).next().val();
     //alert(wvalue);
      Swal.fire({
          title: 'Are you sure?',
          text: "You want to Delete this Virtual Assistant!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
           
            $.ajax({
                    type: "post",
                    cache: false,
                    async:false,
                    datatype: "json",
                    url: "{{route('workseat.deleteworkseat')}}",
                    data: {"wasearch":wvalue,"_token": "{{ csrf_token() }}"},
                    success:function(data)
                        {
                             var tablework = $('#worksheetrecords').DataTable();
                             tablework.ajax.reload();
                           

                        }
        
            });
                 
          }
          else{
          
             
          }
      })
  });
//delete clientdtl(sub client) code 
  $('#clientrecords').on('click','.delclient',function(){
  
     var cvalue=$(this).next().val();
     
      Swal.fire({
          title: 'Are you sure?',
          text: "You want to Delete this Client!",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ok'
        }).then((result) => {
          if (result.value) {
           
            $.ajax({
                    type: "post",
                    cache: false,
                    async:false,
                    datatype: "json",
                    url: "{{route('workseat.deleteworkseat')}}",
                    data: {"clisearch":cvalue,"_token": "{{ csrf_token() }}"},
                    success:function(data)
                        {
                             var tablecli = $('#clientrecords').DataTable();
                             tablecli.ajax.reload();
                           

                        }
        
            });
                 
          }
          else{
          
             
          }
      })
  });
  //pop up add client modal
  $('#newclientid').on('click',function(){
    //clear field in modal
       $("#theClientForm").find('input:text').val('');
       $("#theClientForm").find('.emptyemail').val('');
       $("#theClientForm").find('.scountryclient').val('');
       $("#theClientForm").find('.clientsstate').val('');
       $("#theClientForm").find('.clientscounty').val('');
       
       $("#theClientForm").find('span').text('');
       
      $('#addclientmodal').modal({
                  backdrop: 'static',
                  keyboard: false,
          });
      $('#addclientmodal').modal('show'); 
     
      $("#addclientmodal").on('shown.bs.modal', function(){
       
        $(this).find('#newaddfnameid').focus();
      });
        

  });

  $('#addsubmitclient').on('click',function(){
  //first name validation  
    var firstname=$('#newaddfnameid').val();
    if(firstname == ""){
          
      toastr.error('Please Fill up First Name');
      $('#newaddfnameid').focus();
      return false;
    }
  //first email validation(check empty or not)
     var firstclientemail=$('#firstclientemailid').val();
     if(firstclientemail == ""){
      toastr.error('Email is required');
      $('#firstclientemailid').focus();
      return false;
    }

  //client email validation
   var checkclientemailerror=0;
    $("span[class *= 'clientemailerror']").each(function(){
      var clientemail=$(this).text(); 
        if(clientemail != ""){
               checkclientemailerror++;        
        } 

    });   
    if(checkclientemailerror !=0){
       toastr.error("Please Check Client Email Field");  
       return false;
    }
    //client phone validation
    var checkclientphoneerror=0;
    $("span[class *= 'clientphoneerror']").each(function(){
      var clientphone=$(this).text(); 
        if(clientphone != ""){
               checkclientphoneerror++;        
        } 

    });   
    if(checkclientphoneerror !=0){
       toastr.error("Please Check Client Phone Field");  
       return false;
    }

    $("#theClientForm").ajaxSubmit({url: "{{route('clients.addnewclient')}}", type: 'post',success:function(data) { 
      console.log(data);
         if(data == "formerror"){
                toastr.error('Please Check form');  
         }
         else if(data.exception == null){

              toastr.success('Successfully Client Added'); 
              $('#addclientmodal').modal('hide'); 
              var table = $('#clientrecords').DataTable();
               table.ajax.reload();

         }
         else{
                toastr.warning('Retry Again'); 
         }
   
      
    } })

  });


    // alert("hello");
  $("Form").validate();


  
  
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
          emailcheckvalue=$("#companyemailid").val();
          if (emailcheckvalue ==  null || emailcheckvalue ==  "")
          {
                  toastr.error('Please fill up Company Email');
                  return false;
          }
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
               //client firstname
           $("input[class *= 'addfname']").each(function(){
              var firstclientnameempty=$(this).val(); 
                if(firstclientnameempty == ""){
            
                  toastr.error("Please fill up Client First Name Field."); 
                   event.preventDefault(); 
                   return false;
                } 

            }); 

               //client email
            $("input[class *= 'cliemail']").each(function(){
              var firstclientemailempty=$(this).val(); 
                if(firstclientemailempty == ""){
            
                  toastr.error("Please fill up Client Email Field."); 
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
//   $("input").not(".addaddr").on("cut copy paste",function(e) {
//      e.preventDefault();
//   });
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
      }
      else{
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
       
         $(this).parent().next("span").remove();
         $(this).parent('div').remove();

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

      $("#phonetextboxcompany").append('<div class="input-group input-group-unstyled mt-1 mb-1"><input type="text" id="comphone['+lastphoneidvalue+']"  class="form-control cophone" name="company_phone[]" value="" pattern="[1-9]{1}[0-9]{9}" required=""  onfocusout="myComephonecheck(this,'+lastphoneidvalue+')"><a href="#" class="remove_companyphonefield btn3">X</a></div> <span id="phone_error" class="phone_error'+lastphoneidvalue+' text-danger spantext companyphoneerror" for="phone"></span><span id="phone_success" class="phone_success'+i+' text-success spantext" for="phone"></span>');
         document.getElementById('comphone['+lastphoneidvalue+']').focus();
      }  
    });
   //multiple company phone delete
    $('#phonetextboxcompany').on("click",".remove_companyphonefield", function(){ 
         $(this).parent().next("span").remove(); 
         $(this).parent('div').remove();

    });



 //add client phone script
      v=0;
 $("#theClientForm").on("click","a.addclientphone",function () {

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
      $(this).parent('div').find("#phonetextboxclient").append('<div class="input-group input-group-unstyled mt-1 mb-1"><input type="text" id="client_contact_1['+v+']" class="form-control phno  emptyphone'+rowno+' cliphone"  placeholder="" name="client_contact_1[]" value="" pattern="[1-9]{1}[0-9]{9}" required="" onfocusout="myCliphonecheck(this,'+num+')"><a href="JavaScript:void(0);" class="remove_phonefield btn3">X</a></div> <span  class="client_phoneerror'+rowno+v+' text-danger modalspantext clientphoneerror"></span><span  class="client_phonesuccess'+rowno+v+' text-success modalspantext" ></span>');
       document.getElementById('client_contact_1['+v+']').focus();  
     }
  });
  //remove client phone script
  $("#theClientForm").on("click","a.remove_phonefield.btn3",function () {
             $(this).parent().next("span").remove(); 
             $(this).parent('div').remove();
  });

  //add client email script
  $("#theClientForm").on("click","a.addclientemail",function () {
       var did=$(this).next().val();
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
   
      $(this).parent('div').find('#emailtextboxclient').append('<div class="input-group input-group-unstyled mt-1 mb-1"><input type="email" id="cliemail['+v+']"  class="form-control emailid emptyemail cliemail"  placeholder="" name="client_email_primary[]" value="" required="" onfocusout="myCliemailcheck(this,'+num+')"><a href="JavaScript:void(0);" class="remove_emailfield btn3 ">X</a></div> <span id="client_email_primary_error" class="client_perror'+rowno+v+' text-danger modalspantext clientemailerror"></span><span id="client_email_primary_success" class="success client_perrorsuccess'+rowno+v+' text-success modalspantext" for="client_email_primary"></span>');
         document.getElementById('cliemail['+v+']').focus(); 
      } 
  });
  //delete client email
  $('#theClientForm').on("click","a.remove_emailfield.btn3", function(){ //user click on remove text
        $(this).parent().next("span").remove(); 
        $(this).parent('div').remove();
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
//submit work seat detail using ajax
$(document).on("click", "#submitworksheet", function(e){ 
       var department = [];
            $.each($("input[name='department[]']:checked"), function(){
                department.push($(this).val());
            });
       var seat_type=$("#seat_typeid").val();
       var workcountry=$('#workcountryid').val();
       var worktimezone=$('#timezoneid').val();
       var resourcebilling=$('#resourcebillingid').val();
       var resourceinvoicing=$('#resourceinvoicingid').val();
       var currency=$('#currencyid').val();
       var amount=$('#amountid').val();
       var days = [];
           $.each($("input[name='day[][]']:checked"), function(){
                days.push($(this).val());
            });
       var hours=[];
           $.each($("input[name='hour[][]']"), function(){
              if($(this).val() != ""){
                hours.push($(this).val());
              }
            });
       var worktime=[];
           $.each($("input[name='time[][]']"), function(){
               if($(this).val() != ""){
                worktime.push($(this).val());
               }
            });
       var csr1=$('#csr1id').val();
       var csr2=$('#csr2id').val();
       var emp1=$('#emp1id').val();
       var emp2=$('#emp2id').val();
       var compid=$('#companyidwork').val();

        $.ajax({

           type:'POST',

           url:'{{route("workseat.workseatstore")}}',

           data:{department:department, seat_type:seat_type, workcountry:workcountry,worktimezone:worktimezone,resourcebilling:resourcebilling,resourceinvoicing:resourceinvoicing,currency:currency,amount:amount,days:days,hours:hours,worktime:worktime,csr1:csr1,csr2:csr2,emp1:emp1,emp2:emp2,compid:compid,"_token":"{{csrf_token()}}"},

           success:function(data){

              // alert(data.success);

           }

        });
 
});
//show client popup
function showClient(thisclient){

   

}
</script>
