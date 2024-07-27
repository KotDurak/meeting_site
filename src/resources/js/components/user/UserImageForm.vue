<script setup>
import {ref} from "vue";

const props = defineProps({
   user: {
       type: Object,
       default: () => ({}),
   }
});

const file = ref(null);
const preview = ref(null);

const handleFileUpload = (event) => {
    file.value = event.target.files[0];

    const reader = new FileReader();
    reader.onload = ((aImg) => {
        return e => {
            aImg.src = e.target.result;
        }
    })(preview.value);

    reader.readAsDataURL(file.value);
}
</script>

<template>
    <div class="col-12">
        <img src="" alt="" ref="preview">
        <input type="file" accept="image/*" @change="handleFileUpload">
    </div>
</template>

<style scoped>

</style>
