<script setup>
import {reactive, ref} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";
import {useStore} from "vuex";

const router = useRouter();
const store = useStore();

const formData = reactive({
    email: '',
    password: '',
    name: '',
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
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input v-model="formData.password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="name">Имя</label>
                <input v-model="formData.name" class="form-control" id="name"/>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button :disabled="submitted" type="submit"  @click.prevent="register" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<style scoped>

</style>
