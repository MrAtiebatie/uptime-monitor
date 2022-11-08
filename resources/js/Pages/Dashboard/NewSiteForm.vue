<template>
    <form @submit.prevent="submitForm" class="mt-6 flex w-full space-x-4">
        <div class="w-full">
            <InputLabel>URL</InputLabel>
            <TextInput v-model="form.url" type="url" placeholder="Your URL" class="w-full"/>
        </div>

        <div class="w-full">
            <InputLabel>Text to look for</InputLabel>
            <TextInput v-model="form.query" type="text" placeholder="Search query" class="w-full"/>
        </div>

        <div class="flex w-full items-end pt-5">
            <PrimaryButton class="h-full">Add</PrimaryButton>
        </div>
    </form>
</template>
<script>
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'

export default {
    name: 'NewSiteForm',
    components: {InputLabel, PrimaryButton, TextInput},
    data() {
        return {
            form: this.$inertia.form({
                url: null,
                query: null,
            }),
        }
    },

    methods: {
        submitForm() {
            this.form.post(route('sites.store'));
        },
    },
}
</script>
