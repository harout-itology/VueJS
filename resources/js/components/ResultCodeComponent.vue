<template>
    <span :title="data.result_code" class='badge ' :class='data.result_code >= 0 ? "badge-success" : "badge-danger"' > {{ data.result_code >= 0 ? "Success" : "Error" }} </span>
</template>

<script>
    export default {
        props: {
            data: {},
            name: {},
        }
    }
</script> 
