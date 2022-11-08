<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
                class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
            >
                <div
                    class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg"
                >
                    <table class="min-w-full divide-y divide-gray-200">
                        <slot></slot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Table'
}
</script>

<style scoped>

</style>
