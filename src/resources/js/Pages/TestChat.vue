<script setup>
import {ref} from "vue"
import axios from "axios";

Echo.private('chatbox')
.listen('MessageSend', e => {
   console.log(e);
});


const messages =  ref([]);
const textMessage = ref('');

const sendMessage = () => {
    axios.post('/api/message', {message: textMessage.value});
    textMessage.value = '';
};

</script>

<template>
    <div class="chatbox p-3">
        <div class="messages" v-if="messages.length">
            <div class="message" v-for="message in messages">
                <span class="d-inline-block">{{ message }}</span>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-3">
                <input type="text" class="form-control" v-model="textMessage"></input>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <button class="btn btn-primary" @click="sendMessage()">Send</button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
