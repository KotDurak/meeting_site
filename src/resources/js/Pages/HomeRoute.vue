<script setup>
import axios from "axios";
import {onMounted, ref} from "vue";

const users = ref([]);
const loadUsers = async () => {
    const response = await axios.get('/api/users');
    users.value = response.data;

};

onMounted(() => {
    loadUsers();
});
</script>

<template>
    <h1>home route</h1>
    <router-link to="/test"> Take me to Test page </router-link>

    <ul>
        <li v-for="user in users" :key="user.id">
            {{user.name}}
        </li>
    </ul>
</template>

<style scoped>

</style>
