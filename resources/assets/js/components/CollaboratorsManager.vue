<template>
    <div class="row">
        <div class="col-sm-12">

            <div class="form-inline row">
                <div class="form-group mx-sm-0 mb-2 col-sm-8">
                    <input type="text" class="form-control col-sm-12" id="collaboratorEmail" v-model="collaboratorEmail" placeholder="Collaborator email address">
                </div>
                <div class="col-sm-4 text-sm-right">
                    <button type="button" @click="invite()" class="btn btn-primary mb-2 col-sm-12">Add new collaborator</button>
                </div>
            </div>

        </div>
        <div class="col-sm-12">

            <div class="list-group collaborator-panel">
                <div v-for="collaborator in collaborators" class="list-group-item added-collaborators" v-cloak>
                    <div class="row">
                        <div class="col-sm-10">
                            <span class="name">{{ collaborator.name }}</span><br/>
                            <span class="email">{{ collaborator.email }}</span>
                        </div>
                        <button type="button" class="btn btn-danger" v-if="!collaborator.pivot || (collaborator.pivot && collaborator.pivot.is_owner == 0)">
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
        props: ['collaborators'],
        data() {
            return {
                collaboratorEmail: null,
                howEmailError: false,
                showEmailExist: false
            };
        },
        methods: {
            invite: function () {
                axios.post('/api/users/findByEmail', {
                    email: this.collaboratorEmail
                })
                    .then(response => {
                        let data = response.data.data;
                        let jq = jsonQ(this.collaborators);
                        if (jq.find('id').index(data.id) > -1) {
                            this.showEmailExist = !this.showEmailExist;
                        } else {
                            data.pivot = {'is_owner': false};
                            this.collaborators.push(data);
                        }

                        this.collaboratorEmail = null
                    })
                    .catch(e => {
                        this.showEmailError = !this.showEmailError;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
