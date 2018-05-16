<template>
    <div>

        <div class="form-group row">
            <div class="offset-1 col-md-10">
                <label for="ml_algorithm_id">Please select the desired training algorithm</label>
                <select class="form-control" id="ml_algorithm_id" name="ml_algorithm_id">
                    <option value="">Use the best fitted method</option>
                    <option v-for="option in algorithms" v-bind:value="option.id">
                        {{ option.name }}
                    </option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label for="ml_algorithm_resampling_id">Please select the desired re-sampling method</label>
                <select class="form-control" id="ml_algorithm_resampling_id" name="ml_algorithm_resampling_id">
                    <option v-for="option in resampling" v-bind:value="option.alias">
                        {{ option.name }}
                    </option>
                </select>
            </div>
            <div class="col-md-6">
                <div class="slidecontainer" v-for="range in tune">
                    <strong>{{ range.description }} (10)</strong><br/>
                    <span>{{ range.low }}&nbsp;</span>
                    <input type="range" :min="range.low" :max="range.high" :value="range.default" class="slider" id="myRange" :step="range.step">
                    <span>&nbsp;{{ range.high }}</span>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "MlStateForm",
        data() {
            return {
                algorithms: [],
                preprocessing: [],
                resampling: [],
                tune:[],
            }
        },
        mounted: function () {
            this.populateAlgorithms();
            this.populateResampling();
        },
        methods: {
            populateAlgorithms: function () {
                window.axios.get('/api/algorithm')
                    .then(response => {
                        let data = response.data.data;
                        this.algorithms = data;
                    })
                    .catch(e => {
                        console.error('Can not retrieve algorithm list.')
                    })
            },
            popularePreprocessing: function () {
                window.axios.get('/api/algorithm/preprocessing')
                    .then(response => {
                        let data = response.data.data;
                        this.preprocessing = data;
                    })
                    .catch(e => {
                        console.error('Can not retrieve algorithm preprocessing option list.')
                    })
            },
            populateResampling: function () {
                window.axios.get('/api/algorithm/getResamplingMethods')
                    .then(response => {
                        let data = response.data.data;
                        this.resampling = data;
                        this.tune = data[0]['tune'];
                    })
                    .catch(e => {
                        console.error('Can not retrieve algorithm resampling option list.')
                    })
            },
            catchAlgorithmOptions: function () {

            }
        }
    }
</script>

<style scoped>

</style>
