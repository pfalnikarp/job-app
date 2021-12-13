<template>
    <div class="row">
      
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4> Invoice Submitted</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                     <th>Select All</th>
                                    <th> Company</th>
                                     <th>Created at</th>
                                   
                                  
                                </tr>
                            </thead>
                            <tbody v-if="grouplist.length > 0">
                                <tr v-for="(group,key) in grouplist" :key="key">
                                    <td>{{ group.id }}</td>
                                    <td>{{ group.username }}</td>
                                       <td>{{ group.selectall }}</td>
                                    <td>{{ group.company_fired }}</td>
                                       <td>{{ group.created_at }}</td>
                                  
                                    
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Groups Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"grouplist",
    data(){
        return {
            grouplist:[]
        }
    },

    beforeMount(){
           this.getgrouplist()
    },
    mounted(){
        console.log('JOB  component mounted.');
        this.getgrouplist()
    },
    methods:{
        async getgrouplist(){
            await this.axios.get('/api/jobinvoice').then(response=>{
                this.grouplist = response.data
            }).catch(error=>{
                console.log(error)
                this.grouplist = []
            })
        },
        deleteGroup(id){
            if(confirm("Are you sure to delete this group ?")){
                this.axios.delete(`/api/group/${id}`).then(response=>{
                    this.getgrouplist()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>