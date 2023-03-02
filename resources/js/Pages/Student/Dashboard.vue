<template>
    <StudentLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl ">
                行政後台管理
            </h2>
        </template>

        <div class="flex flex-row">
            <div class="bg-white p-4 basis-2/4 shadow-md rounded">
                Course List

            </div>
        </div>

    </StudentLayout>
</template>

<script>
import StudentLayout from '@/Layouts/StudentLayout.vue';
import { defineComponent, reactive } from 'vue';

export default {
    components: {
        StudentLayout,
    },
    props: [],
    data() {
        return {
        }
    },
    methods: {

    },
}
</script>