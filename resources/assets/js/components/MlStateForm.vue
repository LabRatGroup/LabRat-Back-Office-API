<template>
    <div>
        <ml-algorithm-form></ml-algorithm-form>
        <ml-preprocessing-form></ml-preprocessing-form>
        <ml-resampling-form ref=resamplingComponent></ml-resampling-form>
        <ml-metric-form ref="MlMetricForm"></ml-metric-form>

        <div class="card mb-2">
            <div class="card-header">Training data</div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="offset-1 col-md-10 ">
                        <p>Please select file containing the data you wish to use to train the model.</p>
                    </div>
                    <div class="custom-file offset-1 col-md-10 mb-3">
                        <input type="file" class="custom-file-input" id="file" name="file">
                        <label class="custom-file-label" for="file">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MlStateForm"
    }
</script>

<style scoped>

</style>
