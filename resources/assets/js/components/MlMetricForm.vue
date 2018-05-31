<template>
    <div>
        <h4>Data performance options</h4>

        <div class="form-group">
            <div class="row">
                <div class="col-md-push-1 col-md-10">
                    <label for="ml_algorithm_metric_methods_id">Please select the desired metric to calculate
                        performance from.</label>
                    <select class="form-control" id="ml_algorithm_metric_methods_id" v-model="metric">
                        <option v-for="option in methods" v-bind:value="option">
                            {{ option }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <br/>
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
