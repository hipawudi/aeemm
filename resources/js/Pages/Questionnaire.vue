<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard..
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    {{ survey.title_cn }}
                    <div v-for="(question, idx) in questions">
                        <div v-if="question.format=='SHORT'">
                            <a-typography-title :level="3">{{++idx}}. {{ question.title_cn }}</a-typography-title>
                            <a-input />
                        </div>
                        <div v-if="question.format=='GENDER'">
                            <a-typography-title :level="3">{{++idx}}. {{ question.title_cn }}</a-typography-title>
                            <a-input />
                        </div>
                        <div v-if="question.format=='SHORTMULTI'">
                            <a-typography-title :level="3">{{++idx}}. {{ question.title_cn }}</a-typography-title>
                            <ol class="list-decimal list-inside">
                                <li v-for="option in JSON.parse(question.option_cn)">
                                {{ option }} <a-input style="width:unset"/>
                                </li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
export default {
    components: {
        AppLayout,
    },
    props: ['survey','questions'],
    data() {
        return {
        }
    },
    methods: {
    },
}
</script>
