<div x-data="checkAll">
    <input type="checkbox" x-ref="checkAll" @change="handleCheckAll" class="rounded border-gray-300 shadow">
</div>

@script
<script>
    Alpine.data('checkAll', () => {
        return {
            init() {
                this.$wire.watch('orderIdsOnPage', (values) => {
                    this.updateCheckAllState()
                })

                this.$wire.watch('selectedOrderIds', (values) => {
                    this.updateCheckAllState()
                })
            },

            updateCheckAllState() {
                if (this.$wire.selectedOrderIds.length === 0) {
                    this.$refs.checkAll.indeterminate = false
                    this.$refs.checkAll.checked = false
                    return
                }

                // If all orders on the current page are checked...
                if (this.$wire.orderIdsOnPage.every(i => this.$wire.selectedOrderIds.includes(i))) {
                    this.$refs.checkAll.indeterminate = false
                    this.$refs.checkAll.checked = true
                    return
                }

                this.$refs.checkAll.indeterminate = true
                this.$refs.checkAll.checked = false
            },

            handleCheckAll(e) {
                let checked = e.target.checked

                if (checked) {
                    // Select all...
                    this.$wire.orderIdsOnPage.forEach(i => {
                        if (! this.$wire.selectedOrderIds.includes(i)) {
                            this.$wire.selectedOrderIds.push(i)
                        }
                    })
                } else {
                    // Deselect all...
                    this.$wire.selectedOrderIds = []
                }
            }
        }
    })
</script>
@endscript
