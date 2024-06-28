<script>
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

export default {
    props: {
        authors: {
            type: Array,
            required: true
        }
    },
    components: {
        AuthenticatedLayout
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
    <AuthenticatedLayout>
        <form @submit.prevent="form.post(route('book.store'))">
            <div>
                <h1>Add a book</h1>
                <label for="title">Title</label>
                <input id="title" v-model="form.title" />
                <br/>
                <label for="summary">Summary</label>
                <input v-model="form.summary" />
                <br/>
                <label for="author">Author</label>
                <select v-model="form.author">
                    <option 
                    v-for="author in authors" 
                    :key="author.id" 
                    :value="author.id"
                    >{{ author.formatted_name }}</option>
                </select>
                <br/>
                <button>
                    Submit
                </button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>