<template>
    <div>
        <div class="card mb-2">
            <div class="card-header">Resampling optimization method</div>
            <div class="card-body">
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
        </div>
    </div>
</template>

<script>
    export default {
        name: "MlReSampling",
        data() {
            return {
                resampling: [],
                tune: [],
            }
        },
        mounted: function () {
            this.populateResampling();
        },
        methods: {
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
            }
        }
    }
</script>

<style scoped>

</style>
