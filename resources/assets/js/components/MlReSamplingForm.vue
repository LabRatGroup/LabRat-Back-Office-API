<template>
    <div>
        <div class="card mb-2">
            <div class="card-header">Resampling optimization method</div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="offset-1 col-md-10 mb-3">
                        <label for="ml_algorithm_methods_id">Please select the desired re-sampling method</label>
                        <select class="form-control" id="ml_algorithm_methods_id" v-model="trainControlMethod" :onchange="setResamplingParams()">
                            <option v-for="option in methods" v-bind:value="option.alias">
                                {{ option.name }}
                            </option>
                        </select>
                    </div>

                    <div class="offset-1 col-md-10 col-md-pull-1">
                        <div class="row mb-2" v-for="item in tune">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="formControlRange">{{ item.description }} ({{
                                        item.default }}) </label>
                                    <input type="range" :min="item.low" :max="item.high" :step="item.step" class="form-control-range" id="formControlRange" v-model="item.default">
                                </div>
                                <small>min: {{ item.low }}, max: {{ item.high }}, steps: {{ item.step }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="control" name="control" v-model="control"/>
    </div>
</template>

<script>
    export default {
        name: "MlReSampling",
        data() {
            return {
                methods: [],
                tune: [],
                trainControlMethod: null,
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
                        this.methods = data;
                        this.trainControlMethod = this.methods[0].alias;
                    })
                    .catch(e => {
                        console.error('Can not retrieve algorithm methods option list.')
                    })
            },
            setResamplingParams: function () {
                if (this.trainControlMethod !== null) {
                    let jq = window.jsonQ(this.methods);
                    let items = jq.find('alias');
                    let index = items.index(this.trainControlMethod);
                    this.tune = this.methods[index]['tune'];
                } else {
                    this.tune = [];
                }
            }
        },
        computed: {
            control: function () {
                let trainControlMethodRounds;

                for (var key in this.tune) {
                    trainControlMethodRounds = this.tune[key].default;
                }
                return JSON.stringify(
                    {
                        'trainControlMethod': this.trainControlMethod,
                        'trainControlMethodRounds': trainControlMethodRounds
                    });
            }
        }
    }
</script>

<style scoped>

</style>
