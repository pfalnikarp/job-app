<script type="text/javascript">
   window.onload=function(){
  var yy=document.getElementById("decisionid").value;
  if(yy == 1){
         Swal.fire({
          type:'success',
          title: 'Updated Successfully',
          text: "Do you want to update another time?",
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'NO',
          cancelButtonText: 'Yes',
        }).then((result) => {
          if (result.value) {
            document.getElementById("btncancelid").click();       
          }
          else{
             
             
          }
      })
  }
  
};
$( document ).ready(function() {
//decision button
$("#decsionid").on('change',function(){
  alert('hi');
});
//click on seat slot than textbox show
$("#seatslotid").on('change',function(){
     var seatslot=$(this).val();
     if(seatslot == "Custom"){
       $('.seatslotclass').css('display','block');
     }
     else{
      $('.seatslotclass').css('display','none');
     }
     
});
//click on other tomezone than show textbox
$("#worktimezoneid").on('change',function(){
     var timezone=$(this).val();
     if(timezone == "Other"){
       $('.othertimezoneclass').css('display','block');
      
     }
     else{
      $('.othertimezoneclass').css('display','none');
      $('#othertimezoneid').val('');
     }
     
});
//click on submit button than check error code
$(".chkerror").click(function(event) {
     //select department validation
     var department="";
      $.each($("input[name='department[]']:checked"), function(){
                department+=$(this).val();
      });
      if(department == ""){
          toastr.error('Please Select Department');
        
          return false;
     }
     //country validation
     var country=$('#workcountryid').val();
     var othercountry=$('#othercountryid').val();
     if(country == ""){
          toastr.error('Please Select Country');
          $('#workcountryid').focus();
          return false;
     }
     else if(country == "Other"){
        if(othercountry == ""){
          toastr.error('Please Enter Country');
          $('#othercountryid').focus();
          return false;
        }
      }
      //worktimezone validation
     var worktimezone=$('#worktimezoneid').val();
     var othertimezone=$('#othertimezoneid').val();
     if(worktimezone == ""){
        toastr.error('Please Select Time Zone');
        $('#worktimezoneid').focus();
        return false;
     }
     else if(worktimezone == "Other"){
        if(othertimezone == ""){
          toastr.error('Please Enter Time Zone');
          $('#othertimezoneid').focus();
          return false;
        }
     }
     //if select day then two input field required  
      var hourtimevalue=0;
      $.each($("input[name='day[]']:checked"), function(){
                day=$(this).val();
             
                if($('#'+day+'hour').val() == "" || $('.'+day+'time').val() == ""){
                    hourtimevalue++;    
                }
      });
      if(hourtimevalue !=0 ){
          toastr.error('Some Mismatch in Seat Timing');
          return false;
      }
     //csr1 validation 
     var csr1=$('#csr1id').val();
     if(csr1 == ""){
          toastr.error('Please Select HANDLER 1');
          $('#csr1id').focus();
          return false;
     }
     //emp1 validation 
     var emp1=$('#emp1id').val();
     if(emp1 == ""){
          toastr.error('Please Select RESOURCE 1');
          $('#emp1id').focus();
          return false;
     }        
       
      
    });
  $('#addportalid').on('click',function(){
      $('#portalid').append('<div class="row  ml-1"><div class="col-md-2 pr-1"><label>Portal Name</label><input type="text" class="form-control" name="media_type[]" value="" ></div> <div class="col-md-2 px-1"><label>Portal Url</label><input type="text" class="form-control" name="portal_url[]" value="" ></div><div class="col-md-2 px-1"><label>User Name</label><input type="text" class="form-control" name="username[]" value="" ></div><div class="col-md-2 px-1"><label>Password</label><input type="text" class="form-control" name="password[]" value=""></div><div class="col-md-3 px-1"><label>Deatail</label><textarea class="form-control form-control2" name="portaldetail[]"></textarea></div><div class="col-md-1 pl-1"><a href="javascript:void(0)" class="btn btn-outline btn-danger btn-sm mt-4 delportal"><i class="fa fa-trash" aria-hidden="true"></i></a></div></div>');
  });
  $('#portalid').on('click','.delportal',function(){
       $(this).parent().parent('div').remove();
  });
  //select country show timezone accordingly
  $('#workcountryid').on('click',function(){
      $('#worktimezoneid').empty();
      $('.othercountryclass').css('display','none');
      $('.othertimezoneclass').css('display','none');
      if($('#workcountryid').val() == 'US'){
         $('#worktimezoneid').append('<option value="CDT">CDT</option><option value="MDT">MDT</option><option value="EST" selected="selected">EST</option><option value="PDT">PDT</option><option value="Other">Other</option>');
        }
      else if($('#workcountryid').val() == 'UK'){
            $('#worktimezoneid').append('<option value="BST">BST</option><option value="GMT">GMT</option><option value="Other">Other</option>');
      }
      else if($('#workcountryid').val() == 'CANADA'){
            $('#worktimezoneid').append('<option value="PT">PT</option><option value="MT">MT</option><option value="CT">CT</option><option value="ET">ET</option><option value="AT">AT</option><option value="Other">Other</option>');
      }
      else if($('#workcountryid').val() == 'AUSTRALIA'){
            $('#worktimezoneid').append('<option value="ACST">ACST</option><option value="AEST">AEST</option><option value="AWST">AWST</option><option value="Other">Other</option>');
      }
      else if($('#workcountryid').val() == 'NEW ZEALAND'){
            $('#worktimezoneid').append('<option value="NZDT">NZDT</option><option value="CHADT">CHADT</option><option value="Other">Other</option>');
      }
      else{
            $('.othercountryclass').css('display','block');
            $('.othertimezoneclass').css('display','block');
            $('#worktimezoneid').append('<option value="Other">Other</option>');
      }



    });
  //selct days alltextfield enable
  $('.daysclass').on('click',function(){
    var daysv=$(this).val();

          //$(this).prop('checked',true);
   
       if ($(this).is(':checked')) {
             
             
       }
       else{
              $('#'+daysv+'hour').val("");
              $('.'+daysv+'time').val("");
              
       }
      
  });
});
   
//prevent copy paste content
//$(document).ready(function(){
//   $("input").not(".addaddr").on("cut copy paste",function(e) {
//      e.preventDefault();
//   });
//});


</script>
