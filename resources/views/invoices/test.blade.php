<html>
<head>
  <style>
    @page { margin: 100px 25px; }
    header { position: fixed; top: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
  </style>
</head>
<body>
  <header>header on each page</header>
  <footer>footer on each page</footer>
  <main>

    @php  $n= 1; @endphp

    @foreach($orderlist as $key)

        <table>
        <thead>
        <th> @php echo  $n ; $n++ @endphp </th>
        </thead>
        <tbody>
          <tr>
            <td>
              {{  $key->order_id }}
                @php echo  $n ; $n++ @endphp 
             
            </td>
          </tr>
        </tbody>
        

      </table>


    @if($n % 20 == 0)
    <p>
      
     

    page1</p>

    @endif
    @endforeach
    <p>page2></p>
  </main>
</body>
</html>