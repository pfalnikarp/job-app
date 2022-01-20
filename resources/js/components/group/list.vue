<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"groupAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Group</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Total</th>
                                    <th>List of Users</th>
                                  
                                </tr>
                            </thead>
                            <tbody v-if="grouplist.length > 0">
                                <tr v-for="(group,key) in grouplist" :key="key">
                                    <td>{{ group.groupid }}</td>
                                    <td>{{ group.groupname }}</td>
                                    <td>{{ group.totuser }}</td>
                                    <td>{{ group.names }}</td>

                                  
                                    <td>
                                        <router-link :to='{name:"groupEdit",params:{id:group.groupid}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteGroup(group.groupid)" class="btn btn-danger">Delete</button>
                                    </td>
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
    mounted(){
        this.getgrouplist()
    },
    methods:{
        async getgrouplist(){
            await this.axios.get('/api/group').then(response=>{
                this.grouplist = response.data
                console.log(response.data)
            }).catch(error=>{
                console.log(error)
                this.categories = []
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