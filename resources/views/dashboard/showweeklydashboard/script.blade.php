<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
window.onload=function(){
  document.getElementById("graphid").click();
};
$(document).ready(function () {

  $("#graphid").on('click',function(){

     google.charts.load('current', {'packages':['corechart', 'bar']});
    // $('.modal').modal('show');
    var type=$('#selecttype').val();
    var week=$('#graphyearid').val();
    $.ajax({
                type: "get",
                url: "{{route('monthdashboard.graphweeklydashboard')}}",
                data: {
                            
                             "type":type,
                             "week":week
                         
                       },            
                 success: function(data){     
                   
                      // $('.modal').modal('hide');
                       var dd=$.parseJSON(data[0]);
                    
                     
                        var datadv= google.visualization.arrayToDataTable(dd);
                        
      
                       // Optional; add a title and set the width and height of the chart
                       var options = {
      chart: {
        title: 'Company Performance',
        subtitle: 'Type : '+data[1]+', and Week : '+data[2]+'',
      },
      bars: 'vertical', // Required for Material Bar Charts.
        vAxis: {minValue: 0},
          height: 400,
          colors: ['#1b9e77', '#d95f02']
    };

    var chart = new google.charts.Bar(document.getElementById('barchart_material'));
    chart.draw(datadv, google.charts.Bar.convertOptions(options));
                    
                            
                 },
                   
      });


  });
 $(".selectyear").on("change",function () {

	var year=$(this).val();
 $('.modal').modal('show');
		 $.ajax({
                type: "get",
                url: "{{route('monthdashboard.ajaxmonthdashboard')}}",
                data: {
                            
                             "year":year,
                            
                       },            
                 success: function(data){     
                       console.log(data);
                       $('.monthlytable').empty()
                       $('.monthlytable').append(data);  
                       $('.modal').modal('hide');
                             
                 },
                   
      });
 });
 //show weekly data in dasboard when select week
 $("#weekid").on("change",function () {

  var week=$(this).val();

     $.ajax({
                type: "get",
                url: "{{route('monthdashboard.ajaxweekdashboard')}}",
                data: {
                            
                             "week":week,
                            
                       },            
                 success: function(data){     
                       console.log(data);
                       $('.weeklytable').empty()
                       $('.weeklytable').append(data);  
                
                             
                 },
                   
      });
 });
 
});

jQuery('#firstdateid').datepicker({dateFormat:"yy-mm-dd"});
jQuery('#seconddateid').datepicker({dateFormat:"yy-mm-dd"});
	// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
// Draw the chart and set the chart values
function drawChart() {
 

  
}
</script>