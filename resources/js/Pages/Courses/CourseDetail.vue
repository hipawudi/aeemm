<template>
    <MemberLayout title="Dashboard" >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                表格管理
            </h2>
        </template>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg ">
                <a-row>
                    <a-col :span="18" class="pr-3">
                        <div><img :src="course.media[0].preview_url"/></div>
                        <div v-html="course.title_zh" class="text-3xl text-teal-600"></div>
                        <div v-html="course.title_en" class="text-3xl"></div>
                        <div v-html="course.content"></div>
                    </a-col>
                    <a-col :span="6">
                        <div v-html="course.tutor" class="pt-20 pb-20 bg-blue-500 text-white"></div>
                    </a-col>
                </a-row>

            </div>
        </div>
    </MemberLayout>

</template>

<script>
import MemberLayout from '@/Layouts/MemberLayout.vue';
import dayjs from 'dayjs';


export default {
    components: {
        MemberLayout,
        dayjs,
    },
    props: ['course'],
    data() {
        return {
            dateFormat:'YYYY-MM-DD',
            modal:{
                isOpen:false,
                data:{},
                title:"Modal",
                mode:""
            },
            columns:[
                {
                    title: 'Title Zh',
                    dataIndex: 'title_zh',
                },{
                    title: 'Title En',
                    dataIndex: 'title_en',
                },{
                    title: 'Start Date',
                    dataIndex: 'start_date',
                },{
                    title: 'End Date',
                    dataIndex: 'end_date',
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
        if(!Array.isArray(this.course.class_time)){
            this.course.class_time=JSON.parse(this.course.class_time);
        }
    },
    mounted(){
    },
    computed:{
        classTimeFormat(){
            if(!Array.isArray(this.course.class_time)){
                this.course.class_time=JSON.parse(this.course.class_time);
            }
        }
    }, 
    methods: {
        createRecord(record){
            this.course={};
            this.course.media=[];
            this.modal.mode="CREATE";
            this.modal.isOpen=true;
        },
        editRecord(record){
            this.course={...record};
            this.modal.mode="EDIT";
            this.modal.isOpen=true;
        },
        storeRecord(){
            this.$refs.modalRef.validateFields().then(()=>{
                this.$inertia.post(route('admin.courses.store') , this.course, {
                    onSuccess:(page)=>{
                        console.log(page);
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
            console.log(this.course);
            this.$refs.modalRef.validateFields().then(()=>{
                this.course._method = 'PATCH';
                this.$inertia.post(route('admin.courses.update',this.course.id), this.course,{
                    onSuccess:(page)=>{
                        if(!Array.isArray(this.course.class_time)){
                            this.course.class_time=JSON.parse(this.course.class_time);
                        }

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
<style>
.ant-form-vertical .ant-form-item-label{
    padding-bottom:0px;
}
</style>