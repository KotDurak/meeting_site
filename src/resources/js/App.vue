<script setup>
import {onMounted} from "vue";
import MainPage from "./components/MainPage.vue";
import {useStore} from "vuex";

const store = useStore();

onMounted(() => {
   store.dispatch('auth/checkUser');
});

</script>

<template>
    <MainPage>
        <router-view v-slot="{ Component, route }">
            <div :key="route.name">
                <Component :is="Component" />
            </div>
        </router-view>
    </MainPage>

</template>

<style scoped>

</style>
