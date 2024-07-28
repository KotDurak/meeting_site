<script setup>
import {ref} from "vue";
import axios from "axios";
import {useStore} from "vuex";

const store = useStore();

const props = defineProps({
    user: {
        type: Object,
        default: () => ({}),
    }
});

const file = ref(null);
const preview = ref(null);
const imgInput = ref(null);
const photoSrc = ref(null);

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

const loadPhoto = async () => {
    const formData = new FormData();
    formData.append('photo', file.value);
    try {
        const response = await axios.post('/api/user/profile/photo', formData);
        console.log(response);
    } catch (error) {
        const message = error?.response?.data?.message;
        store.dispatch('messages/sendError', message);
    }
};

const getPhoto = async () => {
    const response = await axios.get('/api/user/profile/photo');
    console.log(response);
    photoSrc.value = response.data.file;
};
</script>

<template>
    <div class="avatar">
        <button @click="getPhoto">Load</button>
        <img :src="photoSrc" alt="">
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-2 col-md-3 col-sm-12">
                <input
                    type="file"
                    accept="image/*"
                    @change="handleFileUpload"
                    style="display: none"
                    ref="imgInput"
                >
                <button @click="$refs.imgInput.click()">Выберите фото</button>
                <button v-if="file" @click="loadPhoto">Загрузить</button>
            </div>
            <div class="col-6">
                <img src="" alt="" ref="preview" width="500">
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
