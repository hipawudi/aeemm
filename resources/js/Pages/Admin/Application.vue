<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                課程規劃
            </h2>
        </template>
        {{ applications }}
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Subject template</button>
            <a-table :dataSource="applications" :columns="columns">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <a :href="'/essential/subjects/'+record.id">View</a>
                        <a-button @click="editRecord(record)">Edit</a-button>
                        <a-button @click="deleteRecord(record.id)">Delete</a-button>
                    </template>
                    <template v-else-if="column.dataIndex=='offer_id'">
                        {{ record.offer.code }}
                    </template>
                    <template v-else-if="column.dataIndex=='id_num'">
                        {{ record.id_type }}{{ text }}
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
            name="Application"
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
        >
            <a-input type="hidden" v-model:value="modal.data.id"/>
            <a-form-item name="offer_id" label="報讀課程">
                <a-select
                    v-model:value="modal.data.offer_id"
                    :options="offers.map(offer=>({value:offer.id,label:offer.title_zh}))"
                ></a-select>
            </a-form-item>
            <a-form-item label="課程範疇" name="student_id">
                <a-input v-model:value="modal.data.student_id" />
            </a-form-item>
            <a-form-item name="id_num" label="證件號編">
                <a-input v-model:value="modal.data.id_num" readonly/>
            </a-form-item>
            <a-form-item label="課程名稱(中文)" name="id_type">
                <a-input v-model:value="modal.data.id_type" />
            </a-form-item>
            <a-form-item label="課程名稱(英文)" name="name_zh">
                <a-input v-model:value="modal.data.name_zh" />
            </a-form-item>
            <a-form-item label="課程名稱(英文)" name="name_fn">
                <a-input v-model:value="modal.data.name_fn" />
            </a-form-item>
            <a-form-item label="課程名稱(英文)" name="gender">
                <a-input v-model:value="modal.data.gender" />
            </a-form-item>
            <a-form-item label="課程名稱(英文)" name="dob">
                <a-input v-model:value="modal.data.dob" />
            </a-form-item>
            <a-form-item label="課程名稱(英文)" name="mobile">
                <a-input v-model:value="modal.data.mobile" />
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
    props: ['applications','offers','idTypes'],
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
                    dataIndex: 'offer_id',
                },{
                    title: 'Title cn',
                    dataIndex: 'student_id',
                },{
                    title: 'Title cn',
                    dataIndex: 'id_num',
                },{
                    title: 'Title en',
                    dataIndex: 'name_zh',
                },{
                    title: 'Title en',
                    dataIndex: 'name_fn',
                },{
                    title: 'Title en',
                    dataIndex: 'mobile',
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