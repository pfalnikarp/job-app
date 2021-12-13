<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Group Notification</h4>
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
                                  <p>{{  group.names }}</p>  
                              </div>
          
          </div>                    
                    <h4>Notifications </h4>
                       <table class="table table-bordered table-responsive">
                            <thead>
                              <th>Client Notification</th>
                              
                            </thead>
                            <tbody>
                               <tr  v-for="option in coptions">
                                  <td ><input type="checkbox"  v_model="selected"> {{ option.text }}</td>
                                
                               </tr>
                            </tbody>
                          
                        </table>

                         <table class="table table-bordered table-responsive">
                            <thead>
                              <th>Order Status Notification</th>
                              
                            </thead>
                            <tbody>
                               
                               <tr  v-for="option in options1" >
                                  <td   > <input type="checkbox"  v_model="selected"> {{ option.text }} </td> 
                                       
                               </tr v-else><tr></tr>
                            </tbody>
                          
                        </table>
          <div class="row">  

             <div class="col-4 mb-4 form-group select2-container  full-width">
                                  

          <b-form-group label="Client:" v-slot="{ ariaDescribedby }">
           
      <b-form-checkbox-group
        id="checkbox-group-1"
        v-model="selected"
        :options="coptions"
        :aria-describedby="ariaDescribedby"
        stacked
        size="lg"
        name="flavour-1"
      ></b-form-checkbox-group>
       
    </b-form-group>

       </div>


          <div class="col-4 mb-4 form-group select2-container  full-width">
                          

          <b-form-group label="Order Changes:" v-slot="{ ariaDescribedby }">
          
      <b-form-checkbox-group
        id="checkbox-group-1"
        v-model="selected"
        :options="options"
        :aria-describedby="ariaDescribedby"
        stacked
        size="lg"
        name="flavour-1"
      ></b-form-checkbox-group>
       </b-col>    </b-form-group>

       </div>

       <div class="col-4 mb-4 form-group select2-container  full-width">

        <b-form-group label="Order Status:" v-slot="{ ariaDescribedby }">
          
      <b-form-checkbox-group
        id="checkbox-group-1"
        v-model="selected"
        :options="options1"
        :aria-describedby="ariaDescribedby"
        stacked
        size="lg"
        name="flavour-1"
      ></b-form-checkbox-group>
       
    </b-form-group>


    </div>

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
//  import Multiselect from 'vue-multiselect'
import { BFormGroup, BFormCheckboxGroup, BCol } from 'bootstrap-vue'


export default {
    name:"update-group",
    components: { 'b-form-group': BFormGroup, 'b-form-checkbox-group': BFormCheckboxGroup,'b-col':BCol},

    data(){
        return {
            group:{
                id:0,
                name:"",
                names:"",
                _method:"PATCH"
            },
            listusers:{},
            myValue: "",
           value: [],
           options: [],
           coptions: [],
            options1: [],
            list: [],
            vusers:[],
            selected:[],
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
                this.group.names = response.data.groupmaster[0].names
                console.log(response.data.groupmaster)
               
          
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
                this.axios.get(`/api/listnotification`).then(response=>{
                          
                  console.log(response.data.notification)
              
                  this.isLoading = false
                  this.options =  response.data.notification
                   this.options1 =  response.data.notification1
                    this.coptions =  response.data.cnotification



        console.log(this.options)
               
                
                        
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



