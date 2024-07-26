<script setup>
import {onMounted, ref, reactive} from "vue";

const props = defineProps({
    user: {
        type: Object,
        default: () => ({
            name: null,
            birthday: null,
        })
    }
});
const emit = defineEmits(['update']);
const formData = reactive({...props.user});

const submitted = ref(false);


const updateProfile = () => {
    emit('update', formData)
};


</script>

<template>
    <div class="row" v-if="user">
        <h3>{{formData.name}}</h3>
        <form>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Имя</label>
                <input type="text" class="form-control" v-model="formData.name">
            </div>

            <div class="mb-3">
                <label for="name">Дата рождения</label>
                <input v-model="formData.birthday" class="form-control"  type="date"/>
            </div>

            <button :disabled="submitted" type="submit"  @click.prevent="updateProfile" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<style scoped>

</style>
