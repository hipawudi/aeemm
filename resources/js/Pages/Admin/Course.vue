<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                課程規劃
            </h2>
        </template>
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">規劃新課程</button>
            <a-table :dataSource="courses" :columns="columns">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <inertia-link :href="'/admin/offers?cid='+record.id" >已開設課程</inertia-link>
                        <a-button @click="editRecord(record)">Edit</a-button>
                        <a-button @click="deleteRecord(record.id)">Delete</a-button>
                    </template>
                    <template v-else-if="column.dataIndex=='courses'">
                        <ul>
                            <li v-for="klass in record['klasses']">Class: {{klass.acronym}}</li>
                        </ul>
                    </template>
                    <template v-else>
                        {{record[column.dataIndex]}}
                    </template>
                </template>
            </a-table>

        <!-- Modal Start-->
        <a-modal v-model:visible="modal.isOpen" :title="modal.title" width="60%" >
            {{ modal.data }}
        <a-form
            ref="modalRef"
            :model="modal.data"
            name="Survey"
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
        >
            <a-input type="hidden" v-model:value="modal.data.id"/>
            <a-form-item label="課程編號" name="code">
                <a-input v-model:value="modal.data.code" />
            </a-form-item>
            <a-form-item label="課程範疇" name="area">
                <a-input v-model:value="modal.data.area" />
            </a-form-item>
            <a-form-item label="課程分類" name="category">
                <a-input v-model:value="modal.data.category" />
            </a-form-item>
            <a-form-item label="課程名稱(中文)" name="title_zh">
                <a-input v-model:value="modal.data.title_zh" />
            </a-form-item>
            <a-form-item label="課程名稱(英文)" name="title_en">
                <a-input v-model:value="modal.data.title_en" />
            </a-form-item>
            <a-form-item label="簡介" name="description">
                <a-textarea v-model:value="modal.data.description" />
            </a-form-item>
            <a-form-item label="價錢" name="price">
                <a-input-number v-model:value="modal.data.price" />
            </a-form-item>
            <a-form-item label="早鳥價錢" name="early_price">
                <a-input-number v-model:value="modal.data.early_price" />
            </a-form-item>
            <a-form-item label="會員價錢" name="member_price">
                <a-input-number v-model:value="modal.data.member_price" />
            </a-form-item>
            <a-form-item label="有效" name="valid">
                <a-switch v-model:checked="modal.data.valid" :checkedValue="1" :unCheckedValue="0"/>
            </a-form-item>
            

        </a-form>
        <template #footer>
            <a-button v-if="modal.mode=='EDIT'" key="Update" type="primary"  @click="updateRecord()">Update</a-button>
            <a-button v-if="modal.mode=='CREATE'"  key="Store" type="primary" @click="storeRecord()">Add</a-button>
        </template>
    </a-modal>    
    <!-- Modal End-->
    </AdminLayout>

</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { defineComponent, reactive } from 'vue';

export default {
    components: {
        AdminLayout,
    },
    props: ['courses'],
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
                    title: 'Code',
                    dataIndex: 'code',
                },{
                    title: 'Title cn',
                    dataIndex: 'title_zh',
                },{
                    title: 'Title en',
                    dataIndex: 'title_en',
                },{
                    title: 'Operation',
                    dataIndex: 'operation',
                    key: 'operation',
                },
            ],
            rules:{
                code:{required:true},
                title_zh:{required:true},
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
    methods: {
        createRecord(){
            this.modal.data={};
            this.modal.mode="CREATE";
            this.modal.title="新增問卷";
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
                this.$inertia.post('/admin/courses/', this.modal.data,{
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
                this.$inertia.patch('/admin/courses/' + this.modal.data.id, this.modal.data,{
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
        deleteRecord(recordId){
            console.log(recordId);
            if (!confirm('Are you sure want to remove?')) return;
            this.$inertia.delete('/admin/offers/' + recordId,{
                onSuccess: (page)=>{
                    console.log(page);
                },
                onError: (error)=>{
                    console.log(error);
                }
            });
        },
    },
}
</script>