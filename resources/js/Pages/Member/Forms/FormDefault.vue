<template>
    <AppLayout title="Dashboard" >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                表格管理
            </h2>
        </template>
        
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <a-form
                    :model="formData"
                    name="default"
                    layout="vertical"
                >
                    <div v-for="field in form.fields">
                        <div v-if="field.type=='input'">
                            <a-form-item :label="field.field_label" :name="field.field_name" :rules="[{required:field.require}]">
                                <a-input v-model:value="formData[field.field_name]"/>
                            </a-form-item>                        
                        </div>
                        <div v-else-if="field.type=='select'">
                            <a-form-item :label="field.field_label" :name="field.field_name" :rules="[{required:field.require}]">
                                <a-select
                                    v-model:value="formData[field.field_name]"
                                    :options="JSON.parse(field.options)"
                                ></a-select>
                            </a-form-item>                        
                        </div>
                        <div v-else-if="field.type=='radio'">
                            <a-form-item :label="field.field_label" :name="field.field_name" :rules="[{required:field.require}]">
                                <a-radio-group
                                    v-model:value="formData[field.field_name]"
                                    :options="JSON.parse(field.options)"
                                ></a-radio-group>
                            </a-form-item>                        
                        </div>
                        <div v-else-if="field.type=='checkbox'">
                            <a-form-item :label="field.field_label" :name="field.field_name" :rules="[{required:field.require}]">
                                <a-checkbox-group
                                    v-model:value="formData[field.field_name]"
                                    :options="JSON.parse(field.options)"
                                ></a-checkbox-group>
                            </a-form-item>                        
                        </div>
                        <div v-else-if="field.type=='textarea'">
                            <a-form-item :label="field.field_label" :name="field.field_name" :rules="[{required:field.require}]">
                                <a-textarea
                                    v-model:value="formData[field.field_name]"
                                ></a-textarea>
                            </a-form-item>                        
                        </div>
                        <div v-else-if="field.type=='date'">
                            <a-form-item :label="field.field_label" :name="field.field_name" :format="dateFormat" :valueFormat="dateFormat" :rules="[{required:field.require}]" >
                                <a-date-picker
                                    v-model:value="formData[field.field_name]"
                                ></a-date-picker>
                            </a-form-item>                        
                        </div>
                        <div v-else>
                            {{ field.field_label }}
                        </div>
                    </div>
                    <button @click="onFormChange">aa</button>
                </a-form>
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
    props: ['form'],
    data() {
        return {
            formData:{

            },
            dateFormat:'YYYY-MM-DD',
            columns:[
                {
                    title: 'Name',
                    dataIndex: 'name',
                },{
                    title: 'Title',
                    dataIndex: 'title',
                },{
                    title: 'With Login',
                    dataIndex: 'with_login',
                },{
                    title: 'With Member',
                    dataIndex: 'with_member',
                },{
                    title: 'Action',
                    dataIndex: 'operation',
                    key: 'operation',
                },
            ],
            rules:{
                field:{required:true},
                label:{required:true},
            },
            validateMessages:{
                required: '${label} is required!',
                types: {
                    email: '${label} is not a valid email!',
                    number: '${label} is not a valid number!',
                },
                number: {
                    range: '${label} must be between ${min} and ${max}',
                },
            },
            labelCol: {
                style: {
                width: '150px',
                },
            },
        }
    },
    created(){
    },
    methods: {
        onFormChange(){
            console.log(this.formData);
        }
    },
}
</script>

<style>
.ant-form-vertical .ant-form-item-label{
    padding:0px !important;
}
</style>