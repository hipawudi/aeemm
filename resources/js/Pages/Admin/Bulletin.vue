<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                公告
            </h2>
        </template>
        {{ new Date().getFullYear()-2009+1 }}
        {{ yearLength }}
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">新增公告</button>
            <a-table :dataSource="bulletins.data" :columns="columns" :pagination="pagination" @change="onPaginationChange" ref="dataTable">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <a-button @click="editRecord(record)">修改</a-button>
                        <a-button @click="deleteRecord(record.id)">刪除</a-button>
                    </template>
                    <template v-else-if="column.dataIndex=='category'">
                        {{ bulletinCategories.find(x=>x.value==text)['label']}}
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
            name="Bulletin"
            :label-col="{ span: 4 }"
            :wrapper-col="{ span: 20 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
        >
            <a-form-item label="分類" name="category">
                <a-select v-model:value="modal.data.category" :options="bulletinCategories"/>
            </a-form-item>
            <a-form-item label="年份" name="year">
                <a-select 
                    v-model:value="modal.data.year" 
                    :options="[...Array(yearLength)].map((_, i) => ({ value:  (yearStart-i) }))"
                />
            </a-form-item>
            <a-form-item label="日期" name="date">
                <a-date-picker v-model:value="modal.data.date" :format="dateFormat" :valueFormat="dateFormat" />
            </a-form-item>
            <a-form-item label="標題" name="title">
                <a-input v-model:value="modal.data.title" />
            </a-form-item>
            <a-form-item label="內容" name="content">
                <quill-editor
                    v-model:value="modal.data.content"
                    style="min-height:200px;"
                />
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
import { quillEditor } from 'vue3-quill';

export default {
    components: {
        AdminLayout,
        UploadOutlined,
        RestFilled,
        quillEditor,   
    },
    props: ['bulletinCategories','bulletins'],
    data() {
        return {
            dateFormat:'YYYY-MM-DD',
            yearCurrent:2023,
            yearStart:new Date().getFullYear()+1,
            yearLength:(new Date().getFullYear()-2009)+2,
            modal:{
                isOpen:false,
                data:{},
                title:"公告",
                mode:""
            },
            pagination:{
                total: this.bulletins.total,
                current:this.bulletins.current_page,
                pageSize:this.bulletins.per_page,
            },
            filter:{
            },
            columns:[
                {
                    title: '分類',
                    dataIndex: 'category',
                    width:100,
                },{
                    title: '年份',
                    dataIndex: 'year',
                },{
                    title: '日期',
                    dataIndex: 'date',
                },{
                    title: '標題',
                    dataIndex: 'title',
                },{
                    title: '操作',
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
                this.$inertia.post(route('admin.bulletins.store') , this.modal.data, {
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
            this.$refs.modalRef.validateFields().then(()=>{
                this.modal.data._method = 'PATCH';
                this.$inertia.post(route('admin.bulletins.update',this.modal.data.id), this.modal.data,{
                    onSuccess:(page)=>{
                        this.modal.isOpen=false;
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
        onPaginationChange(page, filters, sorter){
            this.$inertia.get(route('admin.bulletins.index'),{
                page:page.current,
                per_page:5,
                filter:'namejose'
            },{
                onSuccess: (page)=>{
                    console.log(page);
                },
                onError: (error)=>{
                    console.log(error);
                }
            });
        }

    },
}
</script>