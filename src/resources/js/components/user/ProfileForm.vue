<script setup>
import {onMounted, ref, reactive} from "vue";

const props = defineProps(['user']);
const emit = defineEmits(['update']);

const submitted = ref(false);

const updateProfile = () => {
    emit('update');
};

const formData = reactive({
    name: null
});


onMounted(() => {
    formData.name = props.user.name
});

</script>

<template>
    <div class="row">
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Имя</label>
                <input type="text" v-model="formData.name" class="form-control">
            </div>

            <button :disabled="submitted" type="submit"  @click.prevent="updateProfile" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<style scoped>

</style>
