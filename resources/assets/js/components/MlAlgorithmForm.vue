<template>
    <div>
        <div class="card mb-2">
            <div class="card-header">Training algorithm selection</div>
            <div class="card-body">
                <div class="form-group row">

                    <div class="offset-1 col-md-10 mb-3">
                        <label for="ml_algorithm_id">Please select the desired training algorithm</label>
                        <select class="form-control" id="ml_algorithm_id" v-model="method" :onchange="setAlgorithmParams()">
                            <option :value="null">Use the best fitted method</option>
                            <option v-for="option in algorithms" v-bind:value="option.alias">
                                {{ option.name }}
                            </option>
                        </select>
                    </div>

                    <div class="offset-1 col-md-10 col-md-pull-1">
                        <div class="row mb-2" v-for="item in params">

                            <div class="col-md-12">
                                <strong>{{ item.name }}</strong>&nbsp;<i>({{ item.key }})</i>
                            </div>

                            <div class="row" v-if="item.classType == 'numeric'">
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
                                    <small>min: {{ item.low_range }}, max: {{ item.high_range }}, steps: {{ item.step
                                        }}
                                    </small>
                                </div>
                            </div>

                            <div class="row" v-if="item.classType == 'logical'">
                                <div class="offset-4 col-md-12">
                                    <select class="form-control" :id="item.key" :name="item.key">
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row" v-if="item.classType == 'character'">
                                <div class="offset-4 col-md-12">
                                    <select class="form-control" :id="item.key" :name="item.key">
                                        <option :value="opt.value" v-for="opt in JSON.parse(item.options)">{{ opt.key
                                            }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <input type="hidden" id="ml_algorithm_id" name="ml_algorithm_id" v-model="ml_algorithm_id"/>
        <input type="hidden" id="method" name="method" v-model="method"/>
        <input type="hidden" id="tune" name="tune" v-model="tune"/>

    </div>
</template>

<script>
    export default {
        name: "MlALgorithmForm",
        data() {
            return {
                algorithms: [],
                params: [],
                method: null,
                ml_algorithm_id:null
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
                        this.method = this.algorithms[0].alias;
                    })
                    .catch(e => {
                        console.error('Can not retrieve algorithm list.')
                    })
            },
            setAlgorithmParams: function () {
                if (this.method !== null) {
                    let jq = window.jsonQ(this.algorithms);
                    let items = jq.find('alias');
                    let index = items.index(this.method);
                    this.params = this.algorithms[index]['params'];
                    this.ml_algorithm_id = this.algorithms[index]['id'];
                } else {
                    this.params = [];
                }
            }
        },
        computed: {
            tune: function () {
                let items = []

                for (var item in this.params) {
                    items.push(this.params[item].default_value);
                }
                return JSON.stringify(items);
            }
        }
    }
</script>

<style scoped>

</style>
