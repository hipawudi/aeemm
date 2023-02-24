<template>
    <TeacherLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                教師主頁
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    Teacher dashboard
                    {{ teacher }}
                    <hr>
                    {{ offers }}
                </div>
            </div>
        </div>
    </TeacherLayout>
</template>

<script>
import TeacherLayout from '@/Layouts/TeacherLayout.vue';
import Welcome from '@/Components/Welcome.vue';

export default {
    components: {
        TeacherLayout,
    },
    props: ['teacher','offers'],
    data() {
        return {
            
        }
    },
    methods: {

    },
}

</script>
