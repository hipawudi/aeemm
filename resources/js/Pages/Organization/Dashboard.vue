<template>
    <OrganizationLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                行政後台管理....
            </h2>
        </template>
        <p>Admin Dashboard</p>
        <OrganizationList :organizations="organizations"/>
        
    </OrganizationLayout>
</template>

<script>
import OrganizationLayout from '@/Layouts/OrganizationLayout.vue';
import OrganizationList from '@/Components/Organization/OrganizationList.vue';


export default {
    components: {
        OrganizationLayout,
        OrganizationList,
    },
    props: ['organizations'],
    data() {
        return {

        }
    },
    methods: {

    },
}
</script>