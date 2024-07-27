<script setup>
import {reactive, ref} from "vue";
import axios from "axios";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

const formData = reactive({
    code: null
})

const  submitted = ref(false);
const store = useStore();
const router = useRouter();

const confirmCode = async () => {
    submitted.value = true;
    store.dispatch('messages/clearMessages');

    try {
        axios.get('/sanctum/csrf-cookie').then(response => {
            axios.post('/api/register/confirm', formData).then(response => {
                store.dispatch('auth/updateUser');
                store.dispatch('auth/checkUser');
                router.push('/');
            }).catch(error => {
                const message = error?.response?.data?.message;
                store.dispatch('messages/sendError', message);
                submitted.value = false;
            });
        });
    } catch (error) {
        const message = error?.response?.data?.message;
        store.dispatch('messages/sendError', message);
        submitted.value = false;
    }

};

</script>

<template>
    <div>
        <h1>Подтверждение пароля</h1>
        <form>
            <div class="mb-3">
                <label for="code" class="form-label">Код из email</label>
                <input type="text" v-model="formData.code" class="form-control" id="code">
                <div id="emailHelp" class="form-text">Введите  код, пришедший на почту</div>
            </div>
            <button :disabled="submitted" type="submit"  @click.prevent="confirmCode" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<style scoped>

</style>
