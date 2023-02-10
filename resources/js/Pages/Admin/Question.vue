<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Subjects
            </h2>
        </template>
        {{ survey }}
        <br>
        <button @click="createRecord()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Create Question</button>
            <a-table :dataSource="questions" :columns="columns">
                <template #bodyCell="{column, text, record, index}">
                    <template v-if="column.dataIndex=='operation'">
                        <a :href="'/essential/subjects/'+record.id">View</a>
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
        <a-modal v-model:visible="modal.isOpen" :title="modal.title" width="60%" @update="updateRecord(modal.data)" @onCancel="closeModal()">
        <a-form
            ref="modalRef"
            :model="modal.data"
            name="Survey"
            :label-col="{ span: 8 }"
            :wrapper-col="{ span: 16 }"
            autocomplete="off"
            :rules="rules"
            :validate-messages="validateMessages"
            @validate="handleValidate"
            @finish="onFinish"
            @onFinishFailed="onFinishFailed"
        >
            <a-input type="hidden" v-model:value="modal.data.id"/>
            <a-input type="hidden" v-model:value="modal.data.survey_id"/>
            <a-form-item label="欄位名稱" name="field_name">
                <a-input v-model:value="modal.data.field_name" />
            </a-form-item>
            <a-form-item label="題目" name="title_cn">
                <a-input v-model:value="modal.data.title_cn" />
            </a-form-item>
            <a-form-item label="必填" name="mandatory">
                <a-switch v-model:checked="modal.data.mandatory" :checkedValue="1" :unCheckedValue="0"/>
            </a-form-item>
            <a-form-item label="答案類型" name="title_en">
                <a-select
                    v-model:value="modal.data.format" 
                    style="width: 100%"
                    placeholder="Select Item..."
                    max-tag-count="responsive"
                    :options="questionFormats"
                ></a-select>
            </a-form-item>
            <span v-if="optionBox.includes(modal.data.format)">
                <a-form-item label="答案" name="option_text_cn" >
                    <a-textarea v-model:value="modal.data.option_text_cn" @blur="onOptionCnBlur"/>
                </a-form-item>
                <a-form-item label="答案" name="modal.data.option_en">
                    <a-list size="small" bordered :data-source="modal.data.option_cn">
                        <template #renderItem="{ item }">
                            <a-list-item>{{ item }}</a-list-item>
                        </template>
                    </a-list>
                </a-form-item>
                <a-form-item label="其他" name="other">
                    <a-switch v-model:checked="modal.data.other" :checkedValue="1" :unCheckedValue="0"/>
                </a-form-item>
                <a-form-item label="其他標題" name="other_label" v-if="modal.data.other==1">
                    <a-input v-model:value="modal.data.other_label" />
                </a-form-item>
            </span>

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

export default {
    components: {
        AdminLayout,
    },
    props: ['survey','questions'],
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
                    title: '欄位名稱',
                    dataIndex: 'field_name',
                },{
                    title: 'Title cn',
                    dataIndex: 'title_cn',
                },{
                    title: 'Title en',
                    dataIndex: 'title_en',
                },{
                    title: 'Operation',
                    dataIndex: 'operation',
                    key: 'operation',
                },
            ],
            optionBox:['SHORTMULTI','SELECTONE','SELECTMULTI'],
            questionFormats:[
                {   
                    value: 'SHORT',
                    label: '短文字',
                },{   
                    value: 'SHORTMULTI',
                    label: '多項短文字',
                },{
                    value: 'LONG',
                    label: '長文字',
                },{
                    value: 'TEXT',
                    label: '段落文字',
                },{
                    value: 'NUMBER',
                    label: '數字',
                },{
                    value: 'TRUEFALSE',
                    label: '是否',
                },{
                    value: 'GENDER',
                    label: '姓別',
                },{
                    value: 'DATE',
                    label: '日期',
                },{
                    value: 'DATERANGE',
                    label: '日期範圍',
                },{
                    value: 'SELECTONE',
                    label: '單選',
                },{
                    value: 'SELECTMULTI',
                    label: '多選',
                },{
                    value: 'FIVE',
                    label: '五選一',
                },{
                    value: 'ARRAY',
                    label: '矩陣',
                }
            ],
            rules:{
                survey_id:{
                    required:true,
                },
                field_name:{
                    required:true,
                },
                title_cn:{
                    required:true,
                },
                option_text_cn:{
                    required:true,
                },
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
            this.modal.data.survey_id=this.survey.id;
            this.modal.mode="CREATE";
            this.modal.title="新增題目";
            this.modal.isOpen=true;
        },
        editRecord(record){
            this.modal.data={...record};
            console.log(JSON.parse(this.modal.data.option_cn).join("\n"));
            this.modal.data.option_text_cn=JSON.parse(this.modal.data.option_cn).join("\n");
            this.modal.data.option_cn=JSON.parse(this.modal.data.option_cn);
            this.modal.mode="EDIT";
            this.modal.title="修改";
            this.modal.isOpen=true;
        },
        storeRecord(data){
            this.$refs.modalRef.validateFields().then(()=>{
                this.$inertia.post('/admin/questions/', data,{
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
                this.$inertia.patch('/admin/questions/' + data.id, data,{
                    onSuccess:(page)=>{
                        this.modal.data={};
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
        deleteRecord(recordId){
            console.log(recordId);
            if (!confirm('Are you sure want to remove?')) return;
            this.$inertia.delete('/essential/klasses/' + recordId,{
                onSuccess: (page)=>{
                    console.log(page);
                },
                onError: (error)=>{
                    console.log(error);
                }
            });
            this.ChangeModalMode('Close');
        },

        handleValidate(field){
            console.log("handleValidate: "+field);
        },
        onOptionCnBlur(event){
            this.modal.data.option_cn=event.target.value.split("\n");
        },
        onFinish(value){
            console.log("onFinish"+value);
        },
        onFinishFailed(errorInfo){
            console.log('errorInfo: '+errorInfo);
        }
    },
}
</script>