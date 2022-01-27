<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Group</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                      
                              <div class="row" >
                                <div class="col-10">
                                       <router-link to="/group">Back</router-link>
                                </div>
                                <div class="col-2" style="text-align: right;">
                                         <button type="submit" class="btn btn-primary">Update</button>  
                                </div>
                                
                            </div>
                        <div class="row">
                            <div class="col-2 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="group.name">
                                    <input type="hidden" v-model="group.id">
                                </div>
                            </div>
                              <div class="col-2 mb-2 overflow-auto">
                                   <label>Name</label>
                                  
                                <li v-for="(item, index) in groupuser.name" :key="index">
                                    
                                        {{ item }} <a href="#"
                                         v-on:click="DelUser()">{{ groupuser.id[index] }}</a>
                                    
                                        
                                </li>
                                
                              </div>
                          
          <div class="col-3 mb-2 form-group select2-container select2-container-multi full-width">
                                        <label>User</label>
  <multiselect 
    v-model="value" 
    :options="options"
    :multiple="true"
    track-by="id"
    :close-on-select="false"
    :clear-on-select="false"
    :preserve-search="true"
    :max-height="200"
    :taggable="true"
    placeholder="Pick some"
    :custom-label="customLabel"
    >
  </multiselect> 
    </div>
                         
                         <div class="col-4 mb-2 " ><!-- <pre>{{ value  }}</pre> -->  
                                <label>New Users Selected</label>
                                       <table id = "grouptable" >
                                  <thead>
                                    <th style="width: 8%;">#</th>
                                    <th>User Name</th>
                                  </thead>
                              
                                <tr v-for="(Record, index) in value">
                                    <td>{{ index+1 }}</td>
                                    <td><b>{{ Record.name }}</b></td>
            
                                </tr>
                                </table> 
                           </div>                     
             
             <input type="hidden" name="selectedusers"  value=" ">                    
                       
                                
                           
                        </div>    

                     
                      
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>


//import Select2 from 'v-select2-component';  
//import Select2MultipleControl from 'v-select2-multiple-component';
  import Multiselect from 'vue-multiselect'




export default {
    name:"update-group",
    components: {Multiselect},

    data(){
        return {
            group:{
                id:0,
                name:"",
                names:"",
                _method:"PATCH"
            },
            groupuser: {
                 id:0,
                 name:""
            },
            listusers:{},
            myValue: "",
           value: [],
           options: [],
            list: [],
            vusers:[],
            selectedusers:{ 
                     id:0,
                     name:"",
                    _method:"PATCH"},
              isLoading: false
        }
    },
    mounted(){
        this.showGroup()
        this.asyncFind()
    },
   
    methods:{
        async showGroup(){
                   this.isLoading = true
            await this.axios.get(`/api/group/${this.$route.params.id}`).then(response=>{
                // const { name } = response.data.groupmaster
                // const { names } = response.data.groupmaster
                //  const { id } = response.data.groupmaster

                this.group.name =  response.data.groupmaster[0].groupname
                this.group.id  =   response.data.groupmaster[0].groupid
                let names  =         response.data.groupmaster[0].names
                let userids  =      response.data.groupmaster[0].userids
                this.groupuser.name =  names.split(",")
                //console.log(names);
                this.groupuser.id = userids.split(",")
                 //this.group.names =   response.data.groupmaster[0].names
                //console.log(response.data.groupmaster)
                console.log(userids)
               
          
                 // for (const [key, value] of Object.entries(response.data.users)) {
                 //            console.log(key, value)
                 //              this.list.push({id: key.id,text:value.name})

                 //        }
                 //        this.myOptions = this.list

                        
            }).catch(error=>{
                console.log(error)
            })
        },
       
        customLabel (option) {
                       return `${option.id} - ${option.name}`
                       },

         asyncFind (query) {
                this.axios.get(`/api/user/${query}`).then(response=>{
                           
                                            console.log(response.data.users)
              
                  this.isLoading = false
                  this.options =  response.data.users
               
                
                        
            }).catch(error=>{
                console.log(error)
            })
         },
        async update(){
                     
                     this.selectedusers =  this.value;
                        
            await this.axios.put(`/api/group/${this.$route.params.id}`,
              { group: this.group, users: this.selectedusers}).then(response=>{
                this.$router.push({name:"groupList"})
            }).catch(error=>{
                console.log(error)
            })
        },

        async  DelUser(){
                         console.log();
        },
        myChangeEvent(val){
             this.myValue= val
            console.log(val);
        },
        mySelectEvent({id, text}){
                //this.myValue=text
            console.log({id, text});
        },
           clearAll () {
          this.selectedusers = []
           },
             limitText (count) {
      return `and ${count} other countries`
    
             }
   }
}
</script>



