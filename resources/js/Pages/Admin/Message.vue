<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Messenger
            </h2>
        </template>
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">新增Message</button>
            <a-table :dataSource="messages.data" :columns="columns" :pagination="pagination" @change="onPaginationChange" ref="dataTable">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <a-button @click="editRecord(record)">修改</a-button>
                        <a-button @click="deleteRecord(record.id)">刪除</a-button>
                    </template>
                    <template v-else>
                        {{record[column.dataIndex]}}
                    </template>
                </template>
            </a-table>

        <!-- Modal Start-->
        <a-modal v-model:visible="modal.isOpen" :title="modal.title" width="60%" >
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
            <a-form-item label="姓名(中文)" name="name_zh">
                <a-input v-model:value="modal.data.name_zh" />
            </a-form-item>
            <a-form-item label="姓名(外文)" name="name_zh">
                <a-input v-model:value="modal.data.name_fn" />
            </a-form-item>
            <a-form-item label="別名" name="nickname">
                <a-input v-model:value="modal.data.nickname" />
            </a-form-item>
            <a-form-item label="手機" name="mobile">
                <a-input v-model:value="modal.data.mobile" />
            </a-form-item>
            <a-form-item label="狀態" name="status">
                <a-select v-model:value="modal.data.state" :options="employmentStates"/>
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
import { UploadOutlined } from '@ant-design/icons-vue';
import Icon, { RestFilled } from '@ant-design/icons-vue';

export default {
    components: {
        AdminLayout,
        UploadOutlined,
        RestFilled        
    },
    props: ['messages'],
    data() {
        return {
            modal:{
                isOpen:false,
                data:{},
                title:"Modal",
                mode:""
            },
            pagination:{
                total: this.messages.total,
                current:this.messages.current_page,
                pageSize:this.messages.per_page,
            },
            filter:{
            },
            columns:[
                {
                    title: 'Title',
                    dataIndex: 'title',
                },{
                    title: 'Category',
                    dataIndex: 'category',
                },{
                    title: 'Scope',
                    dataIndex: 'scope',
                },{
                    title: 'Sender',
                    dataIndex: 'sender',
                },{
                    title: 'Reciever',
                    dataIndex: 'resiever',
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
        createRecord(record){
            this.modal.data={};
            this.modal.mode="CREATE";
            this.modal.isOpen=true;
        },
        editRecord(record){
            this.modal.data={...record};
            this.modal.mode="EDIT";
            this.modal.isOpen=true;
        },
        storeRecord(){
            this.$refs.modalRef.validateFields().then(()=>{
                this.$inertia.post(route('admin.forms.store') , this.modal.data, {
                    onSuccess:(page)=>{
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
            console.log(this.modal.data);
            this.$refs.modalRef.validateFields().then(()=>{
                this.modal.data._method = 'PATCH';
                this.$inertia.post(route('admin.forms.update',this.modal.data.id), this.modal.data,{
                    onSuccess:(page)=>{
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

        deleteRecord(record){
            if (!confirm('Are you sure want to remove?')) return;
            this.$inertia.delete(route('admin.forms.destroy', {form:record.id}),{
                onSuccess: (page)=>{
                    console.log(page);
                },
                onError: (error)=>{
                    alert(error.message);
                }

            });
        },
    },
}
</script>