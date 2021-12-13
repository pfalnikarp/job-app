<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patterns Invoice</title>

    <style type="text/css">

        @media print {
  footer {page-break-after: always;}
}

    @media screen {
  footer {page-break-after: always;}
}


       body, html {
 
              /*      margin: 0;*/
            }

/*.bg {
 
  background-image: url("img/pdf-converted.jpg");


  height: 90%; 

 
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}*/

        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
            margin-left: 25px !important;
             margin-right: 25px !important;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
       /* table {
            font-size: x-small;
        }*/
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

         
        .invoice-first-page {
            height: 250px;
        }
        .invoice-first-page table {
            margin: 15px;
           
        }

      
        .invoice-first-page h3 {
            margin-left: 15px;
        }


        .styled-table {
    border-collapse: collapse;
    margin: 25px 0;
   /* font-size: 0.9em;*/
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    table-layout: fixed;
     font-size: x-small;

}

.table-header {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
   font-size: x-small;
}

   /* table {
            font-size: x-small;
        }*/


.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

        .invoice table {
            margin: 15px;
            font-family: Times, Times New Roman, Georgia, serif;

        }
        .invoice h3 {
            margin-left: 15px;
        }

        /*.information1 {
            margin-top: 180px;
        }
*/
        .information {
            background-color: #60A7A6;
            color: #FFF;

        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }

        /*  newly added css  on 05-05-21 */


.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}



/*  added css for table */

.detail  {
    position: relative;
  vertical-align: middle;
  
  text-overflow: ellipsis !important;
  clear: both;
  border-collapse: collapse;
    word-wrap: break-word;
    font-size: 0.9em;
    font-family: sans-serif;
}

 .detail th, td {
    padding: 5px 5px;
}

.detail tbody tr {
    border-bottom: 1px solid black;
}

/*   added below for fixed  header and footr */
/** Define the header rules **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 0.02cm;

                /** Extra personal styles 
                background-color: #03a9f4; 
                color: white;  **/
                text-align: center;
               /* line-height: 1.5cm;*/
            }

            /** Define the footer rules **/
            footer {
                position: absolute; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 1cm;

                /** Extra personal styles 
                background-color: #03a9f4; 
                color: white;  **/
                text-align: center;
               /* line-height: 1.5cm;*/
            }
               
             main {
              height: 600px;
             } 

    </style>

</head>
<body>

<header>
            <!--  <img src="img/pdf-converted.jpg" width="100%" height="100%"/> -->
</header>

<main>

<div class="information1">
    <table width="100%" class="table-header" >
        <thead >
            <tr  align="center">
                <img src="img/pdf-converted.jpg" alt="Logo" width="100%" class="logo"/>
            </tr>
           
        </thead>
        
    </table>
  

   <div class="row">
       <div class="column"> 
          <h2> Billing From</h2>
          <hr>
         <table >

        <tr>
            <td align="left" style="width: 40%;">
               
                <h3>Patterns</h3>
                <pre>
info@patternsindia.com
630-246-6028
www.patterns247.com
<br /><br />
Date: 

</pre>


            </td>
        </tr>
    </table>
       </div>
       <div class="column">
          <h2> Billing To</h2>
          <hr>
           <table>
            <tr>
            <td align="right" style="width: 40%;">
                
                 @foreach ($invoiceInfo as $key )

                <h3>{{ $key->client_company  }} </h3>
                <pre>
                   {{ $key->client_address1  }}

                     {{ $key->client_state  }}
                      {{ $key->client_country  }}
                  
                </pre>

                @endforeach
            </td>
        </tr>

    </table>

       </div>
   </div>
    
          
            
</div>


<br/>

<div class="invoice-first-page">
    <table width="100%"  class="styled-table" >
        <thead >
             <tr>
            <th>Description</th>
            <th></th>
            <th>Total</th>
        </tr>
        </thead>

        <tbody>
            <tr> <td>Photoshop</td><td></td><td align="right">40</td></tr>
               <tr><td>Vector</td><td></td><td align="right">30</td></tr>
                  <tr><td>Digitizing</td><td></td><td align="right">10</td></tr>
                     <tr><td></td><td></td><td></td></tr>
                      <tr><td>Total</td><td></td><td align="right">80</td></tr>

           
        </tbody>

    </table>
    
</div>

<br/>

<!-- <div class="information" style="position: absolute; bottom: 0;"> -->
  <div class="information"  style="position: absolute; bottom: 0;">
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Company Slogan
            </td>
        </tr>

    </table>
</div>

@php
$subtotal = 0;
$total = 0;
@endphp

<div class="invoice">
    <h3>ORDER  DETAILS</h3>
    <table width="100%" class="detail">
        <thead >
        <tr>
            <th>Order ID</th>
            <th>File Name</th>
           
             <th>Order Date</th>
             <th>File Price</th>
        </tr>
        </thead>
        <tbody>
            
              @php  $client_name = ''; $order_id =1; $n=1; $fileno=1; @endphp

            @foreach ($orderlist as $key )

                  
                      @if($client_name != $key->client_name )
                         

                            @if ($subtotal >0 )
                                 <tr><td>


                                </td><td> </td><td>SubTotal  </td><td style="text-align: right;font-weight: bold;">{{  number_format($subtotal,2) }} </td></tr>

                            @endif

                           
                         @php $subtotal = 0 ; $client_name  =  $key->client_name; $n++ @endphp  

                          <tr><td colspan="2">
                            <b> {{  $client_name }}  </b>   
                        
                          
                           </td><td> </td><td> </td></tr> 

                      @endif

                        
                         <tr><td>
                 
                @php      
                         $order_id  =  $key->order_id;
                         $files1    =  explode(',', $key->file_name);
                                                 
                         $filetype = $key->file_type;
                         $doctype = '';
                         $filecount = $key->file_count;
                         $stiches = $key->stiches_count;
                         $fileprice = $key->file_price;
                         $orderdate =$key->order_us_date;
                         $discount = 0 ;
                         $total =    number_format($total ,2)+ number_format($fileprice,2); 
                         $subtotal =  number_format($subtotal,2) + number_format($fileprice,2); 
                @endphp
                 
                        {{   $order_id  }}    </td><td >

                        @foreach($files1 as $file1)   

                            @php  $length1 = strlen($file1);  @endphp

                             <b> {{  $fileno  }}  </b> 


                           @php
                             for ($x = 0; $x <= $length1; $x++)
                             {
                                 echo substr($file1, $x , 50 ) ."\n";
                                $x= $x+50; $n= $n+ 1; 
                             }

                          @endphp
                              <br>

                               @php    $fileno++; @endphp

                    
                         

                       @endforeach

                       @php  $fileno=1; @endphp

                      </td><td>
                
                   
                        {{   $orderdate  }}          </td><td style="text-align: right;">
                        {{   $fileprice  }}            </td></tr>
                
                      <!--       
                      @if ( $n > 25 )
                        <div style="page-break-after:always;"> </div>
                        
                    @endif -->


                     
                     
                  

         @endforeach
        
        </tbody>

        <tfoot>
        <tr>
            <td colspan="2"></td>
            <td align="left">Total</td>
            <td align="right" class="gray">{{ number_format($total,2) }}</td>
        </tr>
        </tfoot>
    </table>
</div>

</main>

 
<!-- <div class="information" style="position: fixed; bottom: 0;"> -->
 <footer>
 <div class="information"  > 
    <table width="100%">
        <tr>
            <td align="left" style="width: 50%;">
                &copy; {{ date('Y') }} {{ config('app.url') }} - All rights reserved.
            </td>
            <td align="right" style="width: 50%;">
                Company Slogan
            </td>
        </tr>

    </table>
</div>
</footer> 

 <!--  </div>  remove  class bg ended-->

 <script type="text/php">
    if (isset($pdf)) {
        $pdf->page_script('
             if ($PAGE_COUNT > 1) {

                 $font = $fontMetrics->getFont("Lato", "regular");
                 $pdf->page_text(522, 770, "Page {PAGE_NUM} / {PAGE_COUNT}", $font, 8, array(.5,.5,.5));
            }
        ');
   }
</script>



</body>

</html>