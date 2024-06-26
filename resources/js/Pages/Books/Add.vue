<script>
import { useForm } from '@inertiajs/vue3';

export default {
    props: {
        authors: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            form: useForm({
                title: null,
                summary: null,
                author: null
            }),
        }
    },
    methods: {

    },
    computed: {

    }
}
</script>

<template>
    <form @submit.prevent="form.post(route('book.store'))">
        <div>
            <h1>Add a book</h1>
            <input v-model="form.title" />
            <input v-model="form.summary" />
            <select v-model="form.author">
                <option 
                    v-for="author in authors" 
                    :key="author.id" 
                    :value="author.id"
                >{{ author.formatted_name }}</option>
            </select>
            <button>
                Submit
            </button>
        </div>
    </form>
</template>