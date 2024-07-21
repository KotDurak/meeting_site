<script setup>
import {useStore} from "vuex";
import {useRouter} from "vue-router";
import MessagesList from "./ui/MessagesList.vue";
import {computed, ref} from "vue";
import UserPanel from "./user/UserPanel.vue";

const store = useStore();
const router = useRouter();

const user = computed(() => {
    return store.getters['auth/getUser'];
});

const show = ref(false);
const showMenu = () => {
    show.value = !show.value;
    console.log(show.value);
};

const hideMenu = () => {
  show.value = false;
};

const logout = async () => {
    hideMenu();
    const response = axios.post('/api/logout');
    store.dispatch('auth/logout');
    router.push('/');
};

const isGuest = computed(() => {
   return store.getters['auth/getIsGuest'];
});

</script>

<template>

    <header>
        <!-- Фиксированная навигационная панель -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Сайт знакомств</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Переключить навигацию">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link active" aria-current="page" href="#">Главная</router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ссылка</a>
                        </li>
                    </ul>
                    <div class="d-flex me-5">
                        <div class="dropdown" v-if="user">
                            <a class="btn btn-secondary dropdown-toggle"
                               href="#" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false"
                               @click="showMenu"
                            >
                                {{ user.name }}
                            </a>

                            <ul class="dropdown-menu"
                                :class="{show: show}"
                                aria-labelledby="dropdownMenuLink"

                            >
                                <li>
                                    <router-link
                                        class="dropdown-item"
                                        to="/user/profile"
                                        @click="hideMenu"
                                    >
                                         Профиль
                                    </router-link>
                                </li>
                                <li>
                                    <a
                                        class="dropdown-item"
                                        @click.prevent="logout"
                                       href="#">Выйти</a>
                                </li>
                            </ul>
                        </div>
                        <div v-if="isGuest">
                            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                <li class="nav-item">
                                    <router-link
                                        class="nav-link"
                                        to="/login"
                                        @click="hideMenu"
                                    >
                                        Войти
                                    </router-link>
                                </li>
                                <li>
                                    <router-link
                                        class="nav-link"
                                        to="/register"
                                        @click="hideMenu"
                                    >
                                        Регистрация
                                    </router-link>
                                </li>
                            </ul>


                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Начало содержимого страницы -->
    <main class="flex-shrink-0">
        <div class="container">
            <div class="row">
                <UserPanel/>
                <MessagesList/>
            </div>
           <slot/>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container">
            <span class="text-muted">Сайт знакомств</span>
        </div>
    </footer>
</template>

<style scoped>

</style>
