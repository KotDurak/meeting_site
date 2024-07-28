<script setup>
import {useStore} from "vuex";
import {onMounted, computed, reactive, ref} from "vue";
import axios from "axios";
import ProfileForm from "../../components/user/ProfileForm.vue";
import UserImageForm from "../../components/user/UserImageForm.vue";

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


const showImages = ref(false);
const showEditProfile = ref(false);
const  avatarUrl = computed(() => {
    const images = user.value?.images;

    if (!images) {
        return null;
    }

    const mainImg = images.pop();
    console.log(mainImg);
    return mainImg.photo_url;
});

const updateUser = (formData) => {
    loadUser();
};

onMounted( async () => {
   await loadUser();
});
</script>

<template>
    <div v-if="userLoaded" class="col-12">

        <div class="d-flex">
            <h1>{{user.name}}</h1>
            <div class="user_main_inm" v-if="avatarUrl">
                <img :src="avatarUrl" alt="User main avatar"  class="avatar"/>
            </div>
        </div>
        <a href="" @click.prevent="showEditProfile = !showEditProfile">
            Редактивровать профиль
        </a>
       <ProfileForm
           :user="user"
           @update="updateUser"
           v-show="showEditProfile"
        />
        <div class="row">
            <div class="col-12">
                <a href="" @click.prevent="showImages = !showImages">
                    Загрузить изображение
                </a>
            </div>
            <UserImageForm
                :user="user"
                v-if="showImages"
            />
        </div>

    </div>
</template>

<style scoped>
.avatar{
    width: 50px;
    height: 50px;
}
</style>
