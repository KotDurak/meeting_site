<script setup>
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore();
const errorMessages = computed(() => store.getters["messages/errorMessages"]);

const closeMessage = (id) => {
    store.dispatch('messages/removeMessage', id);
};

</script>

<template>
    <div>
        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
            v-for="message in errorMessages"
            :key="message.id"
        >
            {{message.message}}
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
                @click="closeMessage(message.id)"
            >

            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
