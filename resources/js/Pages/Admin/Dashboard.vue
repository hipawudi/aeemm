<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                行政後台管理....
            </h2>
        </template>
        <a-list item-layout="horizontal" :data-source="offers">
            <template #renderItem="{ item }">
                <a-list-item>
                    <template #actions>
                        <inertia-link :href="'/admin/application?oid='+item.id" >報名名單</inertia-link> | 
                        <inertia-link :href="'/admin/application/create?oid='+item.id" >新增報名</inertia-link>
                    </template>

                    <a-list-item-meta
                        :description="item.description">
                        <template #title>
                            <a href="https://www.antdv.com/">{{ item.title_zh }}</a>
                        </template>
                        <template #avatar>
                            <a-avatar src="https://joeschmoe.io/api/v1/random" />
                        </template>
                    </a-list-item-meta>
                </a-list-item>
            </template>
        </a-list>

    </AdminLayout>

</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';


export default {
    components: {
        AdminLayout,
    },
    props: ['offers'],
    data() {
        return {
            
        }
    },
    methods: {

    },
}
</script>