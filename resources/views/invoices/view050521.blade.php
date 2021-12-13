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
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

         
        .invoice-first-page {
            height: 600px;
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
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    table-layout: fixed;

}


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
        }
        .invoice h3 {
            margin-left: 15px;
        }

     /*   .information1 {
            margin-top: 100px;
        }*/

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
    </style>

</head>
<body>

<div class="bg">
<div class="information1">
    <table width="100%">
        <thead >
            <tr  align="center">
                <img src="img/pdf-converted.jpg" alt="Logo" width="100%" class="logo"/>
            </tr>
           
        </thead>
        
    </table>
   <!--  <hr> -->
    <table width="100%">

        <tr>
            <td align="left" style="width: 40%;">
               
                <h3>John Doe</h3>
                <pre>
Street 15
123456 City
United Kingdom
<br /><br />
Date: 2018-01-01
Identifier: #uniquehash
Status: Paid
</pre>


            </td>
          
            <td align="right" style="width: 40%;">
                
                 
                <h3>CompanyName</h3>
                <pre>
                    https://company.com

                    Street 26
                    123456 City
                    United Kingdom
                </pre>
            </td>
        </tr>

    </table>
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

<div class="information" style="position: absolute; bottom: 0;">
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

<div class="invoice">
    <h3>ORDER  DETAILS</h3>
    <table width="100%">
        <thead  style="background-color: lightblue;">
        <tr>
            <th>Description</th>
            <th>Quantity</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Item 1</td>
            <td>1</td>
            <td align="left">€15,-</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>

        <tfoot>
        <tr>
            <td colspan="1"></td>
            <td align="left">Total</td>
            <td align="left" class="gray">€15,-</td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="information" style="position: absolute; bottom: 0;">
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

</div> <!-- class bg ended-->
</body>
</html>