<template>
    <div class="form-group row">
        <div class="col-sm-12">
            <div class="list-group collaborator-panel">
                <div v-for="collaborator in users" class="list-group-item added-collaborators" v-cloak>
                    <div class="row">
                        <div class="col-sm-10">
                            <span class="name">{{ collaborator.name }}</span></br>
                            <span class="email">{{ collaborator.email }}</span>
                        </div>
                        <button type="button" class="btn btn-danger" v-if="collaborator.id > 0">Remove</button>
                        <!--<div class="col-sm-3 text-right">-->
                            <!--<p class="action"-->
                               <!--v-if="!collaborator.pivot || (collaborator.pivot && collaborator.pivot.is_owner == 0)">-->
                                <!--<span v-if="collaborator.pivot && collaborator.pivot.is_valid == 0">@lang('collaborator.form.in-process')</span>-->
                                <!--{{&#45;&#45;<a href="#" class="s7-close remove_collaborator" @click="remove(collaborator.id)" :id="'remove_collaborator_' + collaborator.pivot.user_id">&nbsp;</a>&#45;&#45;}}-->
                            <!--</p>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserChooser",
        props: ['users'],
    }
</script>

<style scoped>

</style>
