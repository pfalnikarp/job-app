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
      <button id="close-btn" v-on:click="updateNote(noteMsg.id)">X</button>

<strong class="text-info">{{ noteMsg.title }}</strong>
<div>   
  <span>{{  noteMsg.detail }} </span>
   
</div>
<small class="text-warning">{{ noteMsg.footer }}</small>
</div>
</div>
<hr>
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
        this.getnotifications(this.$userId)
        console.log(this.$userId)
    },
    methods:{

        async getnotifications(id){
                 this.id = id
            await this.axios.get('/api/getnote/'+ this.id).then(response=>{
                    console.log(response.data)
                this.notifications = response.data
            }).catch(error=>{
                console.log(error)
                this.notifications = []
            })
        },
        deleteGroup(id){
            if(confirm("Are you sure to delete this group ?")){
                this.axios.delete(`/api/notifications/${id}`).then(response=>{
                    this.getnotifications(this.$userId)
                }).catch(error=>{
                    console.log(error)
                })
            }
        },

        
        updateNote(id){
              
               let id1 = id;
                 this.$swal({
          title: 'Clear This Notification?',
          text: 'You can\'t revert your action',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes Remove it!',
          cancelButtonText: 'No, Keep it!',
          showCloseButton: true,
          showLoaderOnConfirm: true
        }).then((result) => {
          if(result.value) {
                  this.axios.put('/api/notifications/${id}', {id1:id1}).then(response=>{
                    this.getnotifications(this.$userId)
                }).catch(error=>{
                    console.log(error)
                })
              this.$swal('Removed', 'You successfully removed this notification', 'success')
          } else {
               this.$swal('Cancelled', 'Notification is still intact', 'info')
          }
        })

            //  if(confirm("Are you sure to remove this message ?")){
            //     this.axios.put('/api/notifications/${id}', {id1:id}).then(response=>{
            //         this.getnotifications()
            //     }).catch(error=>{
            //         console.log(error)
            //     })
            // }
        }
    }
    }
</script>
