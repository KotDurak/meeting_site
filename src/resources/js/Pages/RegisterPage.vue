<script setup>
import {reactive, ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";
import {useStore} from "vuex";
import CityListSelect from "../components/ui/CityListSelect.vue";

const router = useRouter();
const store = useStore();

const formData = reactive({
    email: '',
    password: '',
    name: '',
    gender: 'male',
    birthday: null,
    city_id: null,
});

const submitted = ref(false);

const register = async () => {
  submitted.value = true;
  store.dispatch('messages/clearMessages');
  try {
      const result = await axios.post('/api/register', formData);
      router.push('/register/confirm');
  } catch (error) {
      const message = error?.response?.data?.message;
      store.dispatch('messages/sendError', message);
      submitted.value = false;
  }

};
</script>

<template>
    <div>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" v-model="formData.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input v-model="formData.password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="name">Имя</label>
                <input v-model="formData.name" class="form-control" id="name"/>
            </div>

            <CityListSelect v-model="formData.city_id"/>

            <div class="form-check">
                <input class="form-check-input" type="radio" value="male" v-model="formData.gender">
                <label class="form-check-label" for="flexRadioDefault1">
                    Мужской
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="female" v-model="formData.gender">
                <label class="form-check-label" for="flexRadioDefault2">
                    Женский
                </label>
            </div>
            <div class="mb-3">
                <label for="name">Дата рождения</label>
                <input v-model="formData.birthday" class="form-control"  type="date"/>
            </div>
            <button
                :disabled="submitted"
                type="submit"
                @click.prevent="register"
                class="btn btn-primary">
                Регистрация
            </button>
        </form>
    </div>
</template>

<style scoped>

</style>
