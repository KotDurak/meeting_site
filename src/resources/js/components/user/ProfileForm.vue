<script setup>
import {ref, reactive} from "vue";
import axios from "axios";
import {useStore} from "vuex";
import CityListSelect from "../ui/CityListSelect.vue";

const store = useStore();

const props = defineProps({
    user: {
        type: Object,
        default: () => ({
            name: null,
            birthday: null,
        })
    }
});
const emit = defineEmits(['update']);
const formData = reactive({...props.user});

const submitted = ref(false);


const  updateProfile = async () => {
    submitted.value = true;

    try {
        const response = await axios.post('/api/user/profile', formData);
        emit('update', formData);
    } catch (error) {
        const message = error?.response?.data?.message;
        store.dispatch('messages/sendError', message);
    }

    submitted.value = false;

};

</script>

<template>
    <div class="row" v-if="user">
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Имя</label>
                <input type="text" class="form-control" v-model="formData.name">
            </div>

            <CityListSelect v-model="formData.city_id"/>

            <div class="mb-3">
                <label for="name">Дата рождения</label>
                <input v-model="formData.birthday" class="form-control"  type="date"/>
            </div>

            <div class="mb-3">
                <label for="about" class="form-label">О себе</label>
                <textarea class="form-control" id="about" rows="3" v-model="formData.about"></textarea>
            </div>

            <button
                :disabled="submitted"
                type="submit"
                @click.prevent="updateProfile"
                class="btn btn-primary">
                Сохранить
            </button>
        </form>
    </div>
</template>

<style scoped>

</style>
