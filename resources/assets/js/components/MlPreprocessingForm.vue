<template>
    <div>
        <h4>Data preprocessing options</h4>

        <div class="form-group">
            <div class="row">
                <div class="col-md-push-1 col-md-10">
                    <label for="ml_algorithm_preprocessng_methods_id">Please select the desired preprocessing
                        method</label>
                    <select class="form-control" id="ml_algorithm_preprocessng_methods_id" v-model="preprocessing">
                        <option v-for="option in methods" v-bind:value="option">
                            {{ option }}
                        </option>
                    </select>
                </div>
            </div>
        </div>

        <input type="hidden" id="preprocessing" name="preprocessing" v-model="preprocessing"/>
        <br/>
    </div>
</template>


<script>
    export default {
        name: "MlPreprocessingForm",
        data() {
            return {
                methods: [],
                preprocessing: null
            }
        },
        mounted: function () {
            this.populateResampling();
        },
        methods: {
            populateResampling: function () {
                window.axios.get('/api/algorithm/getPreprocessingMethods')
                    .then(response => {
                        let data = response.data.data;
                        this.methods = data;
                        this.preprocessing = data[0];
                    })
                    .catch(e => {
                        console.error('Can not retrieve algorithm methods option list.')
                    })
            },
        },
        computed: {}
    }
</script>

<style scoped>

</style>
