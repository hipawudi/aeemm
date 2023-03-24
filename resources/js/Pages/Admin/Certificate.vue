<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                專業認證
            </h2>
        </template>
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">新增專業認證</button>

            <a-table :dataSource="certificates" :columns="columns">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <a-button @click="editRecord(record)">修改</a-button>
                    </template>
                    <template v-else>
                        {{record[column.dataIndex]}}
                    </template>
                </template>
            </a-table>

        <!-- Modal Start-->
        <a-modal v-model:visible="modal.isOpen" :title="modal.mode=='CREATE'?'新增':'修改'" width="60%" >
        <a-form
            ref="modalRef"
            :model="modal.data"
            name="Teacher"
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
        >
            <a-input type="hidden" v-model:value="modal.data.id"/>
            <a-form-item label="專業認證" name="name">
                <a-input v-model:value="modal.data.name" />
            </a-form-item>
            <a-form-item label="認證名稱" name="cert_title">
                <a-input v-model:value="modal.data.cert_title" />
            </a-form-item>
            <a-form-item label="認證機構" name="cert_body">
                <a-input v-model:value="modal.data.cert_body" />
            </a-form-item>
            <a-form-item label="機構標誌" name="cert_logo">
                <div v-if="modal.data.media.length" >
                    <inertia-link :href="route('certificate-delete-media',modal.data.media[0].id)" class="float-right text-red-500">
                        <svg focusable="false" class="" data-icon="delete" width="1em" height="1em" fill="currentColor" aria-hidden="true" viewBox="64 64 896 896">
                            <path d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"></path>
                        </svg>
                    </inertia-link>
                    <img :src="'/media/'+modal.data.media[0].id+'/'+modal.data.media[0].file_name"/>
                </div>
                <a-upload
                    v-model:file-list="modal.data.cert_logo"
                    :multiple="false"
                    :beforeUpload="()=>false"
                    :max-count="1"
                    list-type="picture"
                >
                    <a-button>
                        <upload-outlined></upload-outlined>
                        upload
                    </a-button>
                </a-upload>
            </a-form-item>
            <a-form-item label="認證樣式" name="cert_template">
                <a-input v-model:value="modal.data.cert_template" />
            </a-form-item>
            <a-form-item label="編號格式" name="number_format">
                <a-input v-model:value="modal.data.number_format" />
            </a-form-item>
            <a-form-item label="等級標題" name="rank_caption">
                <a-input v-model:value="modal.data.rank_caption" />
            </a-form-item>
            <a-form-item label="簡介" name="description">
                <a-textarea v-model:value="modal.data.description" />
            </a-form-item>

        </a-form>
        <template #footer>
            <a-button v-if="modal.mode=='EDIT'" key="Update" type="primary"  @click="updateRecord()">更新</a-button>
            <a-button v-if="modal.mode=='CREATE'"  key="Store" type="primary" @click="storeRecord()">新增</a-button>
        </template>
    </a-modal>    
    <!-- Modal End-->
    </AdminLayout>

</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { UploadOutlined } from '@ant-design/icons-vue';
import Icon, { RestFilled } from '@ant-design/icons-vue';

import { defineComponent, reactive } from 'vue';

export default {
    components: {
        AdminLayout,
        UploadOutlined,
        RestFilled
    },
    props: ['certificates'],
    data() {
        return {
            modal:{
                isOpen:false,
                data:{},
                title:"Modal",
                mode:""
            },
            columns:[
                {
                    title: '專業認證',
                    dataIndex: 'name',
                },{
                    title: '認證名稱',
                    dataIndex: 'cert_title',
                },{
                    title: '認證機構',
                    dataIndex: 'cert_body',
                },{
                    title: '機構標誌',
                    dataIndex: 'cert_logo',
                },{
                    title: '認證樣式',
                    dataIndex: 'cert_template',
                },{
                    title: '編號格式',
                    dataIndex: 'number_format',
                },{
                    title: '操作',
                    dataIndex: 'operation',
                    key: 'operation',
                },
            ],
            rules:{
                name_zh:{required:true},
                mobile:{required:true},
                state:{required:true},
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
        createRecord(record){
            this.modal.data={};
            this.modal.mode="CREATE";
            this.modal.isOpen=true;
        },
        editRecord(record){
            this.modal.data={...record};
            this.modal.mode="EDIT";
            this.modal.title="修改";
            this.modal.isOpen=true;
        },
        storeRecord(){
            this.$refs.modalRef.validateFields().then(()=>{
                this.$inertia.post(route('certificates.store'), this.modal.data,{
                    onSuccess:(page)=>{
                        this.modal.data={};
                        this.modal.isOpen=false;
                    },
                    onError:(err)=>{
                        console.log(err);
                    }
                });
            }).catch(err => {
                console.log(err);
            });
        },
        updateRecord(){
            this.$refs.modalRef.validateFields().then(()=>{
                this.modal.data._method = 'PATCH';
                this.$inertia.post(route('certificates.update', this.modal.data.id), this.modal.data,{
                    onSuccess:(page)=>{
                        this.modal.data={};
                        this.modal.isOpen=false;
                        console.log(page);
                    },
                    onError:(error)=>{
                        console.log(error);
                    }
                });
            }).catch(err => {
                console.log("error", err);
            });
           
        },
    },
}
</script>