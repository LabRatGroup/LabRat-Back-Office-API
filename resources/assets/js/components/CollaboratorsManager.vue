<template>
    <div>


        <div class="alert alert-warning alert-dismissible" v-if="showEmailExist" v-cloak>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="closeEmailExist()">×
            </button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            Collaborator already added
        </div>

        <div class="alert danger alert-dismissible" v-if="showEmailError" v-cloak>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" @click="closeEmailExist()">×
            </button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            Invalid collaborator email
        </div>


        <label for="collaboratorEmail">Add collaborators by email</label>
        <div class="input-group">
            <input type="hidden" v-model="users" id="users" name="users"/>
            <input type="text" class="form-control" id="collaboratorEmail" v-model="collaboratorEmail" placeholder="Collaborator email address">
            <span class="input-group-btn">
            <button type="button" @click="invite()" class="btn btn-primary ">Add new
                collaborator
            </button>
            </span>
        </div>

        <div class="col-sm-12">
            <div class="list-group collaborator-panel">
                <div v-for="collaborator in collaborators" class="list-group-item added-collaborators" v-cloak>
                    <div class="row">
                        <div class="col-sm-10">
                            <span class="name">{{ collaborator.name }}</span><br/>
                            <span class="email">{{ collaborator.email }}</span>
                        </div>
                        <button type="button" class="btn btn-danger" v-if="!collaborator.pivot || (collaborator.pivot && collaborator.pivot.is_owner == 0)" @click="remove(collaborator.id)">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "CollaboratorsManager",
        props: ['items', 'model'],
        data() {
            return {
                collaborators: [],
                defaultRole: null,
                collaboratorEmail: null,
                showEmailError: false,
                showEmailExist: false
            };
        },
        mounted: function () {
            this.collaborators = this.items;
            this.setDefaultRole();
        },
        methods: {
            invite: function () {
                this.showEmailError = false;
                this.showEmailExist = false;

                window.axios.post('/api/users/findByEmail', {
                    email: this.collaboratorEmail
                })
                    .then(response => {
                        let data = response.data.data;
                        let jq = window.jsonQ(this.collaborators);
                        if (jq.find('id').index(data.id) > -1) {
                            this.showEmailExist = !this.showEmailExist;
                        } else {
                            data.pivot = {'role_id': this.defaultRole, 'is_owner': false};
                            this.collaborators.push(data);
                        }

                        this.collaboratorEmail = null
                    })
                    .catch(e => {
                        this.showEmailError = !this.showEmailError;
                    });
            },
            setDefaultRole: function () {
                window.axios.get('/api/' + this.model + '/getDefaultCollaboratorRole')
                    .then(response => {
                        let data = response.data.data;
                        this.defaultRole = data.id;
                    })
                    .catch(e => {
                        console.error('Can not retrieve default role for model.')
                    })
            },
            remove: function (id) {
                let jq = window.jsonQ(this.collaborators);
                let items = jq.find('id');
                let index = items.index(id);
                this.collaborators.splice(index, 1)
            },
            closeEmailError: function () {
                this.showEmailError = !this.showEmailError;
            },
            closeEmailExist: function () {
                this.showEmailExist = !this.showEmailExist;
            }
        },
        computed: {
            users: function () {
                return JSON.stringify(this.collaborators)
            }
        }
    }
</script>

<style scoped>

</style>
