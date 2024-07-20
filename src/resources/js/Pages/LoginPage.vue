<script setup>
import {ref, reactive} from "vue";
import {useRouter} from "vue-router";
import {useStore} from "vuex";

const submitted = ref(false);
const formData = reactive({
   email: '',
   password: ''
});

const router =  useRouter();
const store = useStore();

const login = () => {
    store.dispatch('messages/clearMessages');
    axios.get('/sanctum/csrf-cookie').then(response => {
        axios.post('/api/login', formData).then(response => {
            store.dispatch('auth/checkUser');
            router.push('/');
        }).catch(error => {
            store.dispatch('messages/sendError', error.response.data.message);
        });
    });

};

</script>

<template>
    <div>
        <h1>Логин</h1>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" v-model="formData.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input v-model="formData.password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button :disabled="submitted" type="submit"  @click.prevent="login" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<style scoped>

</style>
