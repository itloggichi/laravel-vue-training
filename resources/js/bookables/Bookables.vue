<template>
    <div>
        <div v-if="loading">
            The data is loading...
        </div>
        <div v-else>
            <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div class="col d-flex align-items-stretch" v-for="(bookable, column) in bookablesInRow(row)"  :key="'row' + row + 'col' + column">
                            <bookable-list-item
                            v-bind="bookable"
                            ></bookable-list-item>
                </div>
                <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
            </div>
        </div>
        

    </div>
</template>

<script>
import Axios from 'axios';
import BookableListItem from './BookableListItem'
export default {
    components: {
        BookableListItem
    },
    data() {
        return {
            bookables: null,
            loading: false,
            columns: 3
        }
    },
    computed: {
        rows () {
            return this.bookables == null? 0 : Math.ceil(this.bookables.length / this.columns);
            // recalculates the number of rows per bookable items
        }
    },
    methods: {
        bookablesInRow(row) {
            return this.bookables.slice((row - 1) * this.columns, row * this.columns);
        },
        placeholdersInRow(row) {
            return this.columns - this.bookablesInRow(row).length;
        }
    },
    created() {
        // fetch data here
        this.loading = true;

        const request = Axios
        .get("/api/bookables")
        .then(response => {
            this.bookables = response.data.data;
            this.loading = false;
        });

    },
    mounted() {
        console.log("Mounted!");
    },
}
</script>