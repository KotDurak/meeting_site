<script setup>
import {useStore} from "vuex";
import {onMounted, computed, reactive} from "vue";
import axios from "axios";
import ProfileForm from "../../components/user/ProfileForm.vue";

const store = useStore();

const user = computed(() => {
    return store.getters['auth/getUser'];
});

const userData = reactive({});

const loadUser = async () => {
    const response = await axios.get('/api/user/profile');
    const user = response?.data?.user;

    if (!user) {
        return;
    }
};

onMounted( async () => {
   await loadUser();
});
</script>

<template>
    <div v-if="user">
       <ProfileForm :user="formData"/>
    </div>
</template>

<style scoped>

</style>
