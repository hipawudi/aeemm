<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                課程規劃
            </h2>
        </template>
        <a-typography-title :level="3">課程名稱:{{ offerStudents.code }} - {{ offerStudents.title_zh }}</a-typography-title>
        <a-typography-title :level="4">報名期:{{ offerStudents.apply_start }} - {{ offerStudents.apply_end }}</a-typography-title>
        <a-typography-title :level="4">課程期:{{ offerStudents.course_start }} - {{ offerStudents.course_end }}</a-typography-title>
        <a-typography-title :level="4">名額:{{ offerStudents.seat }}</a-typography-title>
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Subject template</button>
            <a-table :dataSource="offerStudents.students" :columns="columns">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <a-button @click="editRecord(record)">Edit</a-button>
                        <a-button @click="deleteRecord(record.id)">Delete</a-button>
                    </template>
                    <template v-else-if="column.dataIndex=='offers'">
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
        <a-form
            ref="modalRef"
            :model="modal.data"
            name="Offer"
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
        >
            <a-input type="hidden" v-model:value="modal.data.id"/>
            <a-form-item label="課程規劃" name="course">
                <a-select 
                    v-model:value="modal.data.course_id"
                    :options="courses.map(course=>({value:course.id,label:course.title_zh}))" 
                    @change="onChangeCourse"
                />
            </a-form-item>
            <a-form-item label="課程編號" name="code">
                <a-input v-model:value="modal.data.code" />
            </a-form-item>
            <a-form-item label="課程名稱" name="title_zh">
                <a-input v-model:value="modal.data.title_zh" />
            </a-form-item>
            <a-form-item label="報名開始" name="apply_start">
                <a-date-picker v-model:value="modal.data.apply_start" :format="dateFormat"/>
            </a-form-item>
            <a-form-item label="報名結束" name="apply_end">
                <a-date-picker v-model:value="modal.data.apply_end" :format="dateFormat"/>
            </a-form-item>
            <a-form-item label="課程開始" name="course_start">
                <a-date-picker v-model:value="modal.data.course_start" :format="dateFormat"/>
            </a-form-item>
            <a-form-item label="課程結束" name="course_end">
                <a-date-picker v-model:value="modal.data.course_end" :format="dateFormat"/>
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
            <a-form-item label="發佈" name="publish">
                <a-switch v-model:checked="modal.data.publish" :checkedValue="1" :unCheckedValue="0"/>
            </a-form-item>
            

        </a-form>
        <template #footer>
            <a-button v-if="modal.mode=='EDIT'" key="Update" type="primary"  @click="updateRecord(modal.data)">Update</a-button>
            <a-button v-if="modal.mode=='CREATE'"  key="Store" type="primary" @click="storeRecord(modal.data)">Add</a-button>
        </template>
    </a-modal>    
    <!-- Modal End-->
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
    props: ['offerStudents'],
    data() {
        return {
            modal:{
                isOpen:false,
                data:{},
                title:"Modal",
                mode:""
            },
            dateFormat:'YYYY-MM-DD',
            columns:[
                {
                    title: '中文姓名',
                    dataIndex: 'name_zh',
                },{
                    title: '外文姓名',
                    dataIndex: 'name_fn',
                },{
                    title: '分數',
                    dataIndex: 'score',
                },{
                    title: '操作',
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
            this.modal.data.apply_start=dayjs(this.dataFormat,this.modal.data.apply_start);
            this.modal.data.apply_end=dayjs(this.dataFormat,this.modal.data.apply_end);
            this.modal.data.course_start=dayjs(this.dataFormat,this.modal.data.course_start);
            this.modal.data.course_end=dayjs(this.dataFormat,this.modal.data.course_end);
            this.modal.mode="EDIT";
            this.modal.title="修改";
            this.modal.isOpen=true;
        },
        storeRecord(data){
            this.$refs.modalRef.validateFields().then(()=>{
                this.$inertia.post('/admin/offers/', data,{
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
        updateRecord(data){
            this.$refs.modalRef.validateFields().then(()=>{
                this.$inertia.patch('/admin/offers/' + data.id, data,{
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
        onChangeCourse(value){
            var courseSelected=this.courses.find(course=>{return course.id==value});
            this.modal.data.code=courseSelected.code;
            this.modal.data.title_zh=courseSelected.title_zh;
            this.modal.data.title_en=courseSelected.title_en;
            console.log(courseSelected);
            console.log(value);
        }
    },
}
</script>