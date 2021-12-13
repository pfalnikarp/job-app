<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link active">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>

   <li class="nav-item">
    <a href="{{route('orders.index')}}" class="nav-link">
    	<i class="nav-icon fas fa-bookmark"></i>
    	<p>Orders</p>

    </a>
</li>
<li class="nav-item">
                        <a class="nav-link" href="{{route('clients.index')}}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Clients
                             
                            </p>
                        </a>
                    </li>
<li class="nav-item">
    <a href="{{route('user.index')}}" class="nav-link">
    	<i class="nav-icon fas fa-id-card"></i>
        <p>Users </p>

    </a>
</li>

<li class="nav-item">
    <a href="/groupmenu" class="nav-link">
      <i class="nav-icon fas fa-id-card"></i>
        <p>Groups </p>

    </a>
</li>

<li class="nav-item">
    <a href="{{route('groupnotification.index')}}" class="nav-link">
      <i class="nav-icon fas fa-id-card"></i>
        <p>Group Notification </p>

    </a>
</li>
@permission('user.summary.show')
                    <li class="nav-item">
                    <a class="nav-link" href="{{route('workseat.userworkseatsummary')}}">
                            <i class="nav-icon far fa-id-card"></i>
                            <p>Users Summary</p>
                    </a>
                    </li>
@endpermission
<li class="nav-item">
     <a class="nav-link" href="{{route('role.index')}}">
     	<i class="nav-icon fas fa-user-secret" aria-hidden="true"></i>
            <p>Roles</p>
     </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('permission.index')}}">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>Permission</p>
    </a>                    
</li>
<li class="nav-item has-treeview">
              

              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                  Invoice
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              
                <ul class="nav nav-treeview" style="display: none;">
                
                  
                  <li class="nav-item">
                    <a href="{{ url('/invoiceyrmonth') }}" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Generate Invoice for Month</p>
                    </a>
                  </li>
                
                  
                  <li class="nav-item">
                    <a href="{{ url('/invoice-summary') }}" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Invoice Summary</p>
                    </a>
                  </li>
                
                  
                  <li class="nav-item">
                    <a href="{{ url('/invoice-summary1') }}" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Invoice Summary-1</p>
                    </a>
                  </li>
                
                  
                  <li class="nav-item">
                    <a href="{{ url('/payments') }}" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Payments</p>
                    </a>
                  </li>
                
                  
                  <li class="nav-item">
                    <a href="{{ url('/payments/create') }}" class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Payments Create</p>
                    </a>
                  </li>
                              
                </ul>
              
            </li>
            <li class="nav-item has-treeview">
              

              <a href="#" class="nav-link ">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                  Reports
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>

              
                <ul class="nav nav-treeview" style="display: none;">
                 
                 </ul>               
     
                
</li>
