<script setup>
import {useStore} from "vuex";
import {onMounted, computed, reactive, ref} from "vue";
import axios from "axios";
import ProfileForm from "../../components/user/ProfileForm.vue";

const store = useStore();

const user = ref({});
const userLoaded = ref(false);

const loadUser = async () => {
    const response = await axios.get('/api/user/profile');
    const userData = response?.data?.user;

    if (!userData) {
        return;
    }

    user.value = userData;
    userLoaded.value = true;
};

const updateUser = (formData) => {
    console.log(formData);
};

onMounted( async () => {
   await loadUser();
});
</script>

<template>
    <div v-if="userLoaded">
        <h1>{{user.name}}</h1>
       <ProfileForm
           :user="user"
           @update="updateUser"
/>
    </div>
</template>

<style scoped>

</style>
