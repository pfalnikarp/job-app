<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Add Group</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" v-model="group.name">
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"add-group",
    data(){
        return {
            group:{
                name:""
               
            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/group',this.group).then(response=>{
                this.$router.push({name:"groupList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>