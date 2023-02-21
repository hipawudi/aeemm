<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                課程規劃
            </h2>
        </template>
        {{ offers }}
        <a-list item-layout="horizontal" :data-source="offers">
            <template #renderItem="{ item }">
                <a-list-item>
                    <template #actions>
                        Apply
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
        <a-form
            :model="application"
            v-bind="layout"
            name="nest-messages"
            :validate-messages="validateMessages"

        >
            <a-form-item :name="offer_id" label="Offer_id" :rules="[{ required: true }]">
                <a-select
                    v-model:value="application.offer_id"
                    :options="offers.map(offer=>({value:offer.id,label:offer.title_zh}))"
                ></a-select>
            </a-form-item>
        </a-form>        
    </AdminLayout>

</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { defineComponent, reactive } from 'vue';
import dayjs, { Dayjs } from 'dayjs';

export default {
    components: {
        AdminLayout,
    },
    props: ['offers'],
    data() {
        return {
            application:{},
            layout:{
                labelCol: {
                    span: 8,
                },
                wrapperCol: {
                    span: 16,
                }                
            }
        }
    },
    methods: {
    },
}
</script>