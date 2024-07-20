<script setup>
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore();
const errorMessages = computed(() => store.getters["messages/errorMessages"]);

</script>

<template>
    <div>
        <div
            class="alert alert-danger"
            role="alert"
            v-for="message in errorMessages"
        >
            {{message.message}}
        </div>
    </div>
</template>

<style scoped>

</style>
