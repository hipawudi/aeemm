<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                課程規劃
            </h2>
        </template>
            <a-typography-title :level="3">課程名稱:{{ offer.code }} - {{ offer.title_zh }}</a-typography-title>
            <a-typography-title :level="4">報名期:{{ offer.apply_start }} - {{ offer.apply_end }}</a-typography-title>
            <a-typography-title :level="4">課程期:{{ offer.course_start }} - {{ offer.course_end }}</a-typography-title>
            <a-typography-title :level="4">名額:{{ offer.seat }}</a-typography-title>

            <p></p>
            <inertia-link :href="'/admin/application/create?oid='+offer.id" class="px-3 py-2 mr-2 rounded text-white text-sm font-bold whitespace-no-wrap bg-blue-600 hover:bg-blue-800">新增報名</inertia-link>
            <p></p>
            <a-table :dataSource="offer.applications" :columns="columns">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <a-button @click="editRecord(record)">Edit</a-button>
                        <a-button @click="deleteRecord(record.id)">Delete</a-button>
                    </template>
                    <template v-else-if="column.dataIndex=='offer_id'">
                        {{ offer.code }}
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
            
            <a-form-item name="offer_id" label="報讀課程" :bordered="false" readonly>
                {{ offers.find(offer=>offer.id==modal.data.offer_id).title_zh }}
            </a-form-item>
            <a-form-item label="學生編號" name="student_id">
                {{ modal.data.student_id }}
            </a-form-item>
            <a-form-item label="證件類別" name="id_type">
                {{ idTypes.find(id=>id.value==modal.data.id_type).label }}
            </a-form-item>
            <a-form-item label="證件編號" name="id_num">
                {{ modal.data.id_num }}
            </a-form-item>
            <a-form-item label="姓名(中文)" name="name_zh">
                {{ modal.data.name_zh }}
            </a-form-item>
            <a-form-item label="姓名(外文)" name="name_fn">
                {{ modal.data.name_fn }}
            </a-form-item>
            <a-form-item label="性別" name="gender">
                {{ modal.data.gender }}
            </a-form-item>
            <a-form-item label="出生日期" name="dob">
                {{ modal.data.dob }}
            </a-form-item>
            <a-form-item label="聯繫電話" name="mobile">
                <a-input v-model:value="modal.data.mobile" />
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
    props: ['offer','offers','idTypes'],
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
        editRecord(record){
            console.log(record);
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
            this.$inertia.delete('/admin/application/' + recordId,{
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