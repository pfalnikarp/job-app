<template>
       <!--  <main>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <div class="container-fluid">
                <router-link to="/" class="navbar-brand" href="#">Laravel Vue Crud App</router-link>
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        <router-link exact-active-class="active" to="/" class="nav-item nav-link">Home</router-link>
                          <router-link exact-active-class="active" to="/bell" class="nav-item nav-link">Bell</router-link>
                        <router-link exact-active-class="active" to="/group" class="nav-item nav-link">Group</router-link>
                         <router-link exact-active-class="active" to="/jobinvoice" class="nav-item nav-link">Job-Invoice</router-link>
                    </div>
                </div>
            </div>
        </nav> -->
       
       <!--  <div class="container mt-5">
            <router-view></router-view>
            
        </div> 
    </main>  -->
    <!--  <router-view></router-view> -->

    <div id='note'>
        


    <li class="notification-box"   v-for="noteMsg in notifications ">
<div class="row">
<!-- <div class="col-lg-3 col-sm-3 col-3 text-center">
<img src="/demo/man-profile.jpg" class="w-50 rounded-circle">
</div> -->
<div class="col-lg-12 col-sm-12 col-12">
<strong class="text-info">{{ noteMsg.title }}</strong>
<div>   <a href="javascript:void(0)"
                             v-on:click="updateNote(noteMsg.id)">
{{  noteMsg.detail }}      </a>
    {{ noteMsg.id }}
</div>
<small class="text-warning">{{ noteMsg.footer }}</small>
</div>
</div>
</li>
    </div>
  
  
</template>
 
<script>

    export default {
        name:"Note",
    data(){
        return {
            notifications:[]
        }
    },
    mounted(){
        this.getnotifications()
    },
    methods:{
        async getnotifications(){
            await this.axios.get('/api/notifications').then(response=>{
                this.notifications = response.data
            }).catch(error=>{
                console.log(error)
                this.notifications = []
            })
        },
        deleteGroup(id){
            if(confirm("Are you sure to delete this group ?")){
                this.axios.delete(`/api/notifications/${id}`).then(response=>{
                    this.getnotifications()
                }).catch(error=>{
                    console.log(error)
                })
            }
        },

        
        updateNote(id){
             if(confirm("Are you sure to remove this message ?")){
                this.axios.put('/api/notifications/${id}', {id1:id}).then(response=>{
                    this.getnotifications()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
    }
</script>
