<template>
    <div>
        <ml-algorithm-form></ml-algorithm-form>
        <ml-preprocessing-form v-show="visibility"></ml-preprocessing-form>
        <ml-resampling-form v-show="visibility"></ml-resampling-form>
        <ml-metric-form v-show="visibility"></ml-metric-form>
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
        name: "MlStateForm",
        data() {
            return {
                visibility: true
            }
        },
    }
</script>

<style scoped>

</style>
