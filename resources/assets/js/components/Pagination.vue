<template>
    <div class="w3-bar w3-border">

        <a v-if="totalItems" class="w3-button" @click.prevent="pageChanged(1)" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        <a v-if="totalItems" v-for="n in paginationRange" class="w3-button" :class="activePage(n)" @click.prevent="pageChanged(n)">
            {{ n }}
        </a>
        <a v-if="totalItems" class="w3-button" @click.prevent="pageChanged(lastPage)" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        <div v-else>no result found!</div>
    </div>
</template>

<script>
    import {lowerBound} from './Ajax/Utils'
    export default {

        props: {
            // Current Page
            currentPage: {
                type: Number,
                default: 1,
                required: true
            },
            // Total page
            totalPages: Number,
            // Items per page
            itemsPerPage: Number,
            // Total items
            totalItems: Number,
            // Visible Pages
            visiblePages: {
                type: Number,
                default: 5,
                coerce: (val) => parseInt(val)
        }
    },

    data () {
        return {}
    },

    computed: {
        lastPage () {
            if (this.totalPages) {
                return this.totalPages
            } else {
                return this.totalItems % this.itemsPerPage === 0
                    ? this.totalItems / this.itemsPerPage
                    : Math.floor(this.totalItems / this.itemsPerPage) + 1
            }
        },

        paginationRange () {
            let start = this.currentPage - this.visiblePages / 2 <= 0
                ? 1 : this.currentPage + this.visiblePages / 2 > this.lastPage
                    ? lowerBound(this.lastPage - this.visiblePages + 1, 1)
                    : Math.ceil(this.currentPage - this.visiblePages / 2)
            let range = []
            for (let i = 0; i < this.visiblePages && i < this.lastPage; i++) {
                range.push(start + i)
            }
            return range
        }
    },

    methods: {
        pageChanged (pageNum) {
            this.$emit('page-changed', pageNum)
        },

        activePage (pageNum) {
            return this.currentPage === pageNum ? 'w3-green' : ''
        }
    }

    }
</script>
