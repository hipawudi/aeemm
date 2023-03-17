<template>
    <AdminLayout title="Dashboard" >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                表格管理
            </h2>
        </template>
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">新增表格</button>
            <a-table :dataSource="forms" :columns="columns">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <inertia-link :href="route('form.fields.index',{form:record.id})" class="ant-btn">資料欄位</inertia-link>
                        <a-button @click="editRecord(record)">修改</a-button>
                        <a-button @click="deleteRecord(record)">刪除</a-button>
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
            :label-col="{ span: 6 }"
            :wrapper-col="{ span: 18 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
        >
            <a-input type="hidden" v-model:value="modal.data.id"/>
            <a-form-item label="Name" name="name">
                <a-input v-model:value="modal.data.name" />
            </a-form-item>
            <a-form-item label="Title" name="title">
                <a-input v-model:value="modal.data.title" />
            </a-form-item>
            <a-form-item label="Description" name="description">
                <a-input v-model:value="modal.data.description" />
            </a-form-item>
            <a-form-item label="Require Login" name="require_login">
                <a-switch v-model:checked="modal.data.require_login" :unCheckedValue="0" :checkedValue="1"/>
            </a-form-item>
            <a-form-item label="Require Member" name="require_member">
                <a-switch v-model:checked="modal.data.require_member" :unCheckedValue="0" :checkedValue="1"/>
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

export default {
    components: {
        AdminLayout,
    },
    props: ['forms'],
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
        createRecord(record){
            this.modal.data={};
            this.modal.mode="CREATE";
            this.modal.isOpen=true;
        },
        editRecord(record){
            this.modal.data={...record};
            console.log(this.modal.data);
            this.modal.mode="EDIT";
            this.modal.isOpen=true;
        },
        storeRecord(){
            this.$refs.modalRef.validateFields().then(()=>{
                this.$inertia.post(route('forms.store') , this.modal.data, {
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
            console.log(this.modal.data);
            this.$refs.modalRef.validateFields().then(()=>{
                this.$inertia.patch(route('forms.update',this.modal.data.id), this.modal.data,{
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

        deleteRecord(record){
            if (!confirm('Are you sure want to remove?')) return;
            this.$inertia.delete(route('forms.destroy', {form:record.id}),{
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