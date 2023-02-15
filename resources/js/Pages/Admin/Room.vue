<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                課程規劃
            </h2>
        </template>
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Subject template</button>
            <a-table :dataSource="rooms" :columns="columns">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <a-button @click="editRecord(record)">Edit</a-button>
                        <a-button @click="deleteRecord(record.id)">Delete</a-button>
                    </template>
                    <template v-else-if="column.dataIndex=='type'">
                        {{roomTypeLabels[text]}}
                    </template>
                    <template v-else-if="column.dataIndex=='status'">
                        {{roomStatuLabels[text]}}
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
            name="Survey"
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
        >
            <a-input type="hidden" v-model:value="modal.data.id"/>
            <a-form-item label="編號" name="code">
                <a-input v-model:value="modal.data.code" />
            </a-form-item>
            <a-form-item label="名稱" name="name">
                <a-input v-model:value="modal.data.name" />
            </a-form-item>
            <a-form-item label="座位" name="seat">
                <a-input v-model:value="modal.data.seat" />
            </a-form-item>
            <a-form-item label="類型" name="type">
                <a-select v-model:value="modal.data.type" :options="roomTypes"/>
            </a-form-item>
            <a-form-item label="狀態" name="status">
                <a-select v-model:value="modal.data.status" :options="roomStatus"/>
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
    props: ['rooms','roomStatus','roomTypes'],
    data() {
        return {
            modal:{
                isOpen:false,
                data:{},
                title:"Modal",
                mode:""
            },
            roomTypeLabels:{},
            roomStatuLabels:{},
            columns:[
                {
                    title: '編號',
                    dataIndex: 'code',
                },{
                    title: '名稱',
                    dataIndex: 'name',
                },{
                    title: '類型',
                    dataIndex: 'type',
                },{
                    title: '座位狀態',
                    dataIndex: 'status',
                },{
                    title: '操作',
                    dataIndex: 'operation',
                    key: 'operation',
                },
            ],
            rules:{
                code:{required:true},
                type:{required:true},
                seat:{required:true},
                status:{required:true},
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
        this.roomTypes.forEach(type => {
            this.roomTypeLabels[type.value] = type.label;
        })
        this.roomStatus.forEach(type => {
            this.roomStatuLabels[type.value] = type.label;
        })
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
                this.$inertia.post('/admin/rooms/', this.modal.data,{
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
                this.$inertia.patch('/admin/rooms/' + this.modal.data.id, this.modal.data,{
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
            this.$inertia.delete('/admin/rooms/' + recordId,{
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