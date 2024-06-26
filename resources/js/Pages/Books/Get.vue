<script>
import AddTagModal from '@/Components/Modals/AddTagModal.vue';

export default {
    props: {
        book: {
            type: Object,
            required: true
        },
        all_genres: {
            type: Array,
            required: true
        },
        all_tags: {
            type: Array,
            required: true
        },
    },
    data() {
        return {
            show_add_tag_modal: false,
            current_book: this.book
        }
    },
    components: {
        AddTagModal
    },
    methods: {
        addTag: function(){
            // alert("we're adding tags!")
            this.show_add_tag_modal = true
        },
        addGenre: function(){
            alert("we're adding genres!")
        },
        closeAddTagModal: function(){
            this.show_add_tag_modal = false
        },
        refreshBook(book){
            this.current_book = book
        }
    }
}
</script>

<template>
    <div>
        <h2>{{ current_book.title }}</h2>
        <div v-for="author in current_book.authors">
            <h4>{{ author.formatted_name }}</h4>
        </div>
        <p>{{ current_book.summary }}</p>
        <div>
            <h3>Tags</h3>
            <ul>
                <li v-for="tag in current_book.tags">{{ tag.name }}</li>
            </ul>
        </div>
        <div>
            <h3>Genres</h3>
            <ul>
                <li v-for="genre in current_book.genres">{{ genre.name }}</li>
            </ul>
        </div>
    </div>
    <button @click="addTag">Add a tag</button>
    <button @click="addGenre">Add a genre</button>
    <AddTagModal 
        v-show="show_add_tag_modal" ref="add_tag_modal" 
        @new-book="refreshBook"
        :book="current_book"
        @close="closeAddTagModal"
        :all_tags="all_tags"
    />
</template>