<template>
        <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <div class="container-fluid">
                <!-- <router-link to="/" class="navbar-brand" href="#">Home</router-link> -->
               
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <!-- <router-link exact-active-class="active" to="/" class="nav-item nav-link">Home</router-link> -->
                         
                        <router-link exact-active-class="active" to="/group" class="nav-item nav-link"> List Groups</router-link>
                        <router-link exact-active-class="active" to="/group/add" class="nav-item nav-link"> Create Group</router-link>
                         <!--  <router-link exact-active-class="active" to="/groupnotification" class="nav-item nav-link"> Group Notification</router-link> -->
                       
                    </div>
                </div>
              
            </div>
        </nav>
       
        <div class="container mt-5">
            <router-view></router-view>
            
        </div> 
    </main> 
    <!--  <router-view></router-view> -->
  
  
</template>
 
<script>

    export default {}
</script>
