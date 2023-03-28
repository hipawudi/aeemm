<template>
    <AdminLayout title="Dashboard" >
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                表格管理
            </h2>
        </template>
        {{course.media}}
        <a-form
            ref="modalRef"
            :model="course"
            name="Teacher"
            layout="vertical"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
        >
            <a-form-item label="Title Zh" name="title_zh">
                <a-input v-model:value="course.title_zh" />
            </a-form-item>
            <a-form-item label="Title En" name="title_en">
                <a-input v-model:value="course.title_en" />
            </a-form-item>
            <a-form-item label="Description Zh" name="description_zh">
                <a-textarea v-model:value="course.description_zh" />
            </a-form-item>
            <a-form-item label="Description En" name="description_en">
                <a-textarea v-model:value="course.description_en" />
            </a-form-item>
            <a-form-item label="Start Date" name="start_date">
                <a-date-picker v-model:value="course.start_date" :format="dateFormat" :valueFormat="dateFormat" />
            </a-form-item>
            <a-form-item label="End Date" name="end_date">
                <a-date-picker v-model:value="course.end_date" :format="dateFormat" :valueFormat="dateFormat" />
            </a-form-item>
            <a-form-item label="class_time" name="class_time">
                <a-time-range-picker v-model:value="course.class_time" format="HH:mm" valueFormat="HH:mm" />
            </a-form-item>
            <a-form-item label="Fee" name="fee">
                <a-input-number v-model:value="course.fee" :min="0"/>
            </a-form-item>
            <a-form-item label="Content" name="content">
                <div class="bg-white">
                    <quill-editor v-model:value="course.content" :toolbar="'full'" style="min-height: 300px;"/>
                </div>
            </a-form-item>
            <a-form-item label="Language" name="language">
                <a-input v-model:value="course.language" />
            </a-form-item>
            <a-form-item label="Location" name="location">
                <a-input v-model:value="course.location" />
            </a-form-item>
            <a-form-item label="Target" name="target">
                <a-input v-model:value="course.target" />
            </a-form-item>
            <a-form-item label="Published" name="published">
                <a-switch v-model:checked="course.published" :unCheckedValue="0" :checkedValue="1"/>
            </a-form-item>
            <a-form-item label="Tutor" name="tutor">
                <div class="bg-white">
                    <quill-editor v-model:value="course.tutor" style="min-height: 300px;"/>
                </div>
            </a-form-item>

            <a-form-item label="Poster" name="poster">
                <a-upload
                    v-model:file-list="course.poster"
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
            <a-button key="Store" type="primary" @click="storeRecord">新增</a-button>
        </a-form>
        <template #footer>
            
        </template>
    </AdminLayout>

</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { UploadOutlined } from '@ant-design/icons-vue';
import { quillEditor } from 'vue3-quill';
import Icon, { RestFilled } from '@ant-design/icons-vue';
import dayjs from 'dayjs';


export default {
    components: {
        AdminLayout,
        UploadOutlined,
        RestFilled,
        quillEditor,
        dayjs,
    },
    props: [],
    data() {
        return {
            course:{},
            dateFormat:'YYYY-MM-DD',
        }
    },
    created(){
    },
    mounted(){
    },
    computed:{
    }, 
    methods: {
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
    },
}
</script>
<style>
.ant-form-vertical .ant-form-item-label{
    padding-bottom:0px;
}
</style>