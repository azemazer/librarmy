<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddEditionModal from '@/Components/Modals/AddEditionModal.vue'
import { Head } from '@inertiajs/vue3';

export default {
    props: {
        editions: {
            type: Array,
            default: []
        },
        all_editions: {
            type: Array,
            default: []
        }
    },
    data () {
        return {
            show_add_edition_modal: false,
            current_editions: this.editions
        }
    },
    components: {
        Head, AddEditionModal
    },
    methods: {
        addBook: function(){
            this.show_add_edition_modal = true
        },
        closeAddEditionModal: function(){
            this.show_add_edition_modal = false
        },
        refreshEditions(edition){
            this.current_editions = [...this.current_editions, edition]
        }
    }
}
</script>

<template>
    <Head title="Editions" />

    <h3>Books:</h3>
    <div v-for="edition in editions">
        <hr>
        <p>Book title: {{ edition.book.title }}</p>
        <p>Author(s):
             <span v-for="author in edition.book.authors">{{ author.formatted_name }} </span>
        </p>
        <p>Edited: {{ edition.edition_date }}</p>
        <p>Quantity: {{ edition.quantity }}</p> 
        <p>Obtained: {{ edition.acquisition_date }}</p>
        <p>Edition {{ edition.edition_type.label }}</p>
        <br/>
    </div>
    <button @click="addBook">Add a book to my collection</button>
    <AddEditionModal 
        v-if="show_add_edition_modal" ref="add_edition_modal" 
        @new-book="refreshEditions"
        @close="closeAddEditionModal"
        :all_editions="all_editions"
    />
</template>