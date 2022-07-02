<template>
    <div class="mt-8 max-w-screen-2xl mx-auto">

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="mt-6 flex items-center justify-end">
                        <router-link to="create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-3 font-normal">
                            Add Subscriber
                        </router-link>
                    </div>
                    <div class="overflow-hidden">
                        <table class="min-w-full border shadow">
                            <thead class="border-b">
                            <tr class="bg-white">
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    #
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Name
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Email
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Status
                                </th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                    Actions
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b" v-for="(subscriber, key) in subscribers">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{subscriber.id}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{subscriber.name}}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ subscriber.email }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    {{ subscriber.status }}
                                </td>
                                <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                    <router-link :to="{ name: 'edit', params: { id: subscriber.id }}">
                                        <svg class="w-6 h-6 dark:text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                                    </router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
    name: "List",
    async created() {
        await this.loadSubscribers()
    },
    computed: {
        ...mapGetters('subscribers', [
            'subscribers',
        ]),
    },
    methods: {
        ...mapActions('subscribers', [
            'loadSubscribers'
        ]),
        handleEdit(id) {
            this.$router.push(`create/${id}`)
        }
    }
}
</script>

<style scoped>

</style>
