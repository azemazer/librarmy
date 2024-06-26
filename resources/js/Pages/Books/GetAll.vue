<script>
export default {
    props: {
        books: {
            type: Array,
            required: true
        }
    },
    created() {
        console.log(this.book)
    }
}
</script>

<template>
    <div v-for="book in books">
        <h3>{{ book.title }}</h3>
        <div v-for="author in book.authors">
            <h4>{{ author.formatted_name }}</h4>
        </div>
        <p>{{ book.summary }}</p>
    </div>
</template>