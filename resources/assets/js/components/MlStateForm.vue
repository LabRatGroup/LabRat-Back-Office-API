<template>
    <div>
        <div class="card mb-2">
            <div class="card-header">Training algorithm selection</div>
            <div class="card-body">
                <div class="form-group row">

                    <div class="offset-1 col-md-10 mb-3">
                        <label for="ml_algorithm_id">Please select the desired training algorithm</label>
                        <select class="form-control" id="ml_algorithm_id" name="ml_algorithm_id" v-model="algorithm" :onchange="setAlgorithmParams()">
                            <option :value="null">Use the best fitted method</option>
                            <option v-for="option in algorithms" v-bind:value="option.alias">
                                {{ option.name }}
                            </option>
                        </select>
                    </div>

                    <div class="offset-1 col-md-10 col-md-pull-1">
                        <div class="row mb-2" v-for="item in params">
                            <div class="col-md-12">
                                <strong>{{ item.name }}</strong>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-from">From</span>
                                    </div>
                                    <input type="text" :value="item.default_value[item.key].min" class="form-control" :id="item.key" aria-describedby="basic-addon-from" required="required">
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-to">To</span>
                                    </div>
                                    <input type="text" :value="item.default_value[item.key].max" class="form-control" :id="item.key" aria-describedby="basic-addon-to" required="required">
                                </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon-step">Steps</span>
                                    </div>
                                    <input type="text" :value="item.default_value[item.key].step" class="form-control" :id="item.key" aria-describedby="basic-addon-step" required="required">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <small>min: {{ item.low_range }}, max: {{ item.high_range }}, steps: {{ item.step }} </small>
                            </div>

                        </div>
                    </div>

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
                algorithm: null,
                algorithms: [],
                params: [],
            }
        },
        mounted: function () {
            this.populateAlgorithms();
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
            setAlgorithmParams: function () {
                if (this.algorithm !== null) {
                    let jq = window.jsonQ(this.algorithms);
                    let items = jq.find('alias');
                    let index = items.index(this.algorithm);
                    this.params = this.algorithms[index]['params'];
                } else {
                    this.params = [];
                }
            }
        }
    }
</script>

<style scoped>

</style>
