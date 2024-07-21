<script setup>
 import {useStore} from "vuex";
 import {useRouter} from "vue-router";
 import {computed} from "vue";
 import axios from "axios";

 const store = useStore();
 const router = useRouter();

 const notActive = computed(() => {
     const user = store.getters['auth/getUser'];

     return user && !user.is_activated;
 });

 const retryConfirm = () => {
     store.dispatch('messages/clearMessages');
     axios.post('/api/register/confirm/retry').then(response => {
         router.push('/register/confirm');
     }).catch(error => {
         const message = error?.response?.data?.message;
         store.dispatch('messages/sendError', message);
     });
 };


</script>

<template>
    <div class="col-12" v-if="notActive">
        <div class="alert alert-warning" role="alert">
            Для того, чтоб начать пользоваться сайтом, подтвердите  регистрацию
        </div>
        <p>
            <router-link
                to="/register/confirm"
            >
                Введите код, полученый на вашу почту
            </router-link>

            или

            <a href="" @click.prevent="retryConfirm">
                нажмите тут чтобы выслать повторно
            </a>
        </p>
    </div>
</template>

<style scoped>

</style>
