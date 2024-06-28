<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';

export default {
    props: {
        books: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            current_books: this.books
        }
    },
    created() {
        console.log(this.book)
    },
    components: { AuthenticatedLayout, Link },
    methods: {
        async saveBookToWishlist(id) {
            console.log('I wanna save this to wishlist')
            const {data} = await axios.post('book/' + id + '/wishlist')
            if (data !== 1) return // if it didn't save correctly
            const index = this.current_books.findIndex((book) => book.id == id)
            this.current_books[index].is_wishlisted = true
        },
        async removeBookFromWishlist(id) {
            console.log('I wanna remove this from my wishlist')
            const {data} = await axios.delete('book/' + id + '/wishlist')
            if (data !== 1) return // if it didn't delete correctly
            const index = this.current_books.findIndex((book) => book.id == id)
            this.current_books[index].is_wishlisted = false
        }
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <div v-for="book in current_books">
            <hr>
            <br>
            <Link :href="route('book.get', {id: book.id})">
                <h3>{{ book.title }}</h3>
            </Link>
            <div v-for="author in book.authors">
                <h4>{{ author.formatted_name }}</h4>
            </div>
            <p>{{ book.summary }}</p>
            <button 
                v-if="$page.props.auth.user && !book.is_wishlisted"
                @click="saveBookToWishlist(book.id)"
            > 
                Add to wishlist
            </button>
            <button 
                v-else-if="$page.props.auth.user && book.is_wishlisted"
                @click="removeBookFromWishlist(book.id)"
            > 
                Remove from wishlist
            </button>
        </div>
    </AuthenticatedLayout>
</template>