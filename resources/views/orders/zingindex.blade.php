<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>ZingGrid: Docs Getting Started</title>
    <!--Script Reference[1]-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.zinggrid.com/zinggrid.min.js" defer></script>
  </head>
  <body>
    <!--Grid Component Placement[2]-->
   <zing-grid id="myGrid" caption="Hello Doggos"></zing-grid>
  </body>

  <script type="text/javascript">
    
    $(document).ready(function() {
  const $gridRef = $('#myGrid');
  let datastore = "{{ route('orders.zingindex') }}" ;
  $gridRef.attr('data', JSON.stringify(datastore));
});
  </script>
</html>