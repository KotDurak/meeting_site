<script setup>

import MainPage from "./components/MainPage.vue";
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
