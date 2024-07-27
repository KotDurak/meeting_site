<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue']);

const cities = ref([]);

const loadCities = async () => {
    const response = await axios.get('/api/city');
    cities.value = response.data;

};

const changeCity = (event) => {
    emit('update:modelValue', event.target.value);
};

onMounted(() => {
   loadCities();
});

</script>

<template>
    <select class="form-select form-select-lg mb-3"
            aria-label=".form-select-lg example"
            @change="changeCity"
    >
        <option selected>Город</option>
        <option
            v-for="city in cities"
            :value="city.id"
            :key="city.id"
            :selected="city.id == modelValue"
        >
            {{city.name}}
        </option>
    </select>
</template>

<style scoped>

</style>
