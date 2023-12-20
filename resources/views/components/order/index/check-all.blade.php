<div x-data="checkAll">
    <input @change="handleCheck" type="checkbox" class="rounded border-gray-300 shadow">
</div>

@script
<script>
    Alpine.data('checkAll', () => {
        return {
            handleCheck(e) {
                e.target.checked ? this.selectAll() : this.deselectAll()
            },

            selectAll() {
                this.$wire.orderIdsOnPage.forEach(id => {
                    if (this.$wire.selectedOrderIds.includes(id)) return

                    this.$wire.selectedOrderIds.push(id)
                })
            },

            deselectAll() {
                this.$wire.selectedOrderIds = []
            },
        }
    })
</script>
@endscript
