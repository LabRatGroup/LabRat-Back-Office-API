<template>
    <div>
        <div class="card mb-2">
            <div class="card-header">Data performance options</div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="offset-1 col-md-10 mb-3">
                        <label for="ml_algorithm_metric_methods_id">Please select the desired metric to calculate performance from.</label>
                        <select class="form-control" id="ml_algorithm_metric_methods_id"  v-model="metric">
                            <option v-for="option in methods" v-bind:value="option">
                                {{ option }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="metric" name="metric" v-model="metric"/>
    </div>
</template>

<script>
    export default {
        name: "MlMetricForm",
        data() {
            return {
                methods: [],
                metric: null
            }
        },
        mounted: function () {
            this.populateMetric();
        },
        methods: {
            populateMetric: function () {
                window.axios.get('/api/algorithm/getMetricMethods')
                    .then(response => {
                        let data = response.data.data;
                        this.methods = data;
                        this.metric = data[0];
                    })
                    .catch(e => {
                        console.error('Can not retrieve algorithm metric option list.')
                    })
            },
        }
    }
</script>

<style scoped>

</style>
