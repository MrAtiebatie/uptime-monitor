<script>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import NewSiteForm from '@/Pages/Dashboard/NewSiteForm.vue';
import Table from '@/Components/Table/Table.vue';
import TableHead from '@/Components/Table/TableHead.vue';
import TableCell from '@/Components/Table/TableCell.vue';

export default {
    props: ['sites'],

    components: {
        Link,
        TableCell,
        TableHead,
        Table,
        NewSiteForm,
        AppLayout,
    },
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div>
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <div class="mt-8 text-2xl">
                                Welcome to uptimemonitor!
                            </div>

                            <div class="mt-6 text-gray-500">
                                <NewSiteForm />
                            </div>
                        </div>

                        <Table>
                            <thead>
                                <tr>
                                    <TableHead>Status</TableHead>
                                    <TableHead>URL</TableHead>
                                    <TableHead>Search query</TableHead>
                                    <TableHead>Last scan</TableHead>
                                    <TableHead>&nbsp;</TableHead>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="site in sites" :key="site.id" class="group">
                                    <TableCell>
                                        <span class="block h-2 w-2 rounded-full" :class="site.status_class"></span>
                                    </TableCell>
                                    <TableCell>{{ site.url }}</TableCell>
                                    <TableCell>{{ site.search_query }}</TableCell>
                                    <TableCell>{{ site.created_at }}</TableCell>
                                    <TableCell class="group-hover:opacity-100 opacity-0 transition text-indigo-600"><Link :href="site.show_url">show</Link></TableCell>
                                </tr>
                            </tbody>
                        </Table>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
