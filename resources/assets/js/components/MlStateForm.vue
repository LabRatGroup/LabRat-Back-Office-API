<template>
    <div>
        <ml-algorithm-form></ml-algorithm-form>
        <br/>
        <ml-preprocessing-form></ml-preprocessing-form>
        <br/>
        <ml-resampling-form></ml-resampling-form>
        <br/>
        <ml-metric-form></ml-metric-form>
        <br/>
        <div>
            <h4>Training data upload</h4>
            <div class="form-group">
                <div class="col-md-push-1 col-md-10">
                    <label for="file">Please select file containing the data you wish to use to train the model.</label>
                    <input type="file" class="custom-file-input" id="file" name="file">
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
