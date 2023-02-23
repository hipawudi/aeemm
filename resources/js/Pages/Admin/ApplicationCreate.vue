<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                報讀課程
            </h2>
        </template>
        <div>
            <a-alert message="找到相同證件號的學員：" type="success" closable v-if="searchStudents.length>=1">
                <template #description>
                    <table class="w-full">
                        <tr v-for="(student, idx) in searchStudents">
                            <td>{{ student.id_type }}</td>
                            <td>{{ student.id_num }}</td>
                            <td>{{ student.name_zh }}</td>
                            <td>{{ student.name_fn }}</td>
                            <td><a @click="onSelectStudent(idx)">選擇</a></td>
                        </tr>
                    </table>
                    <p>單擊<span style="color: #1890ff">“選擇”</span>進行自動填充。</p>
                </template>
            </a-alert>            
        </div>
        <a-form
            :model="application"
            name="nest-messages"
            :validate-messages="validateMessages"
            :rules="rules"
            layout="vertical"
            @finish="onFinish"
        >
            <a-form-item name="offer_id" label="報讀課程">
                <a-select
                    v-model:value="application.offer_id"
                    :options="offers.map(offer=>({value:offer.id,label:offer.title_zh}))"
                    @change="onChangeOffer"
                ></a-select>
            </a-form-item>
            <a-collapse >
                <a-collapse-panel key="1" :header="selectedOffer.title_zh">
                    <a-row>
                        <a-col :span="12">
                            <a-form-item label="報名開始">
                                <a-input v-bind:value="selectedOffer.apply_start" readonly :bordered="false"/>
                            </a-form-item>
                            <a-form-item label="報名截止">
                                <a-input v-bind:value="selectedOffer.course_start" readonly :bordered="false"/>
                            </a-form-item>
                        </a-col>
                        <a-col :span="12">
                            <a-form-item label="課程開始">
                                <a-input v-bind:value="selectedOffer.apply_end" readonly :bordered="false"/>
                            </a-form-item>
                            <a-form-item label="課程結束">
                                <a-input v-bind:value="selectedOffer.course_end" readonly :bordered="false"/>
                            </a-form-item>
                        </a-col>
                    </a-row>
                    <a-form-item label="課程簡介">
                        <a-textarea v-bind:value="selectedOffer.description" readonly :bordered="false" :rows="5"/>
                    </a-form-item>
                </a-collapse-panel>
            </a-collapse>
            <a-form-item name="id_num" label="證件號編">
                <a-input v-model:value="application.id_num" @blur="onChangeIdNum" minlength="3" :disabled="Object.keys(selectedStudent).length>0"/>
            </a-form-item>
            <a-form-item name="id_type" label="證件類別">
                <a-select
                    v-model:value="application.id_type"
                    :options="idTypes"
                    :disabled="Object.keys(selectedStudent).length>0"
                ></a-select>
            </a-form-item>
            <a-form-item name="student_id" label="學生編號">
                <a-input v-model:value="application.student_id" :disabled="Object.keys(selectedStudent).length>0"/>
            </a-form-item>
            <a-form-item name="name_zh" label="姓名(中文)">
                <a-input v-model:value="application.name_zh"  :disabled="Object.keys(selectedStudent).length>0"/>
            </a-form-item>
            <a-form-item name="name_fn" label="姓名(外文)">
                <a-input v-model:value="application.name_fn"  :disabled="Object.keys(selectedStudent).length>0"/>
            </a-form-item>
            <a-form-item name="gender" label="姓別">
                <a-radio-group v-model:value="application.gender" :disabled="Object.keys(selectedStudent).length>0">
                    <a-radio-button value="M">Male</a-radio-button>
                    <a-radio-button value="F">Female</a-radio-button>
                </a-radio-group>
            </a-form-item>
            <a-form-item name="dob" label="出生日期">
                <a-date-picker v-model:value="application.dob" :format="dateFormat" :valueFormat="dateFormat" :disabled="Object.keys(selectedStudent).length>0"/>
            </a-form-item>
            <a-form-item name="mobile" label="聯繫電話">
                <a-input v-model:value="application.mobile" />
            </a-form-item>
            <a-button type="primary" html-type="submit">確認</a-button>
        </a-form>        
    </AdminLayout>

</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { defineComponent, reactive } from 'vue';
import dayjs, { Dayjs } from 'dayjs';
import axios from 'axios';

export default {
    components: {
        AdminLayout,
    },
    props: ['offers','selectedOfferId','idTypes'],
    data() {
        return {
            dateFormat:'YYYY-MM-DD',
            application:{
                offer_id:parseInt(this.selectedOfferId),
            },
            selectedOffer:{},
            searchStudents:[],
            selectedStudent:{},
            rules:{
                offer_id:{required:true},
                id_type:{required:true},
                id_num:{
                    required:true,
                    min:3,
                    message:"為必填欄位且最少3個字元!"
                },
                name_zh:{required:true},
                gender:{required:true},
                dob:{required:true},
                mobile:{required:true},
            },
            validateMessages:{
                required: '${label}為必填欄位!',
                types: {
                    email: '${label} 不是有效的電子郵件!',
                    number: '${label} 不是有效數字!',
                },
                number: {
                    range: '${label} 必須介於 ${min} 和 ${max} 之間',
                },
            },
        }
    },
    created(){
    },
    mounted(){
        this.selectedOffer=this.offers.find(offer=>offer.id==this.application.offer_id);
    },
    methods: {
        onChangeOffer(){
            this.selectedOffer=this.offers.find(offer=>offer.id==this.application.offer_id);
        },
        onChangeIdNum(){
            //console.log(this.application.birm);
            if(this.application.id_num.length<3){
                alert("身份證號碼太短，可能不是有效號碼，無法搜索。");
                return true;
            }
            axios.post('/admin/search',{
                model:'student',
                key:'id_num',
                value:this.application.id_num
            }).then(response=>{
                this.searchStudents=response.data;
                if(this.searchStudents.length==1){
                    this.onSelectStudent(0);
                }else{
                    console.log(this.searchStudents);
                }
            }).catch(error=> 
                console.log(error)
            )
        },
        onSelectStudent(studentIdx){
            this.selectedStudent=this.searchStudents[studentIdx];
            this.application.student_id=this.selectedStudent.id;
            this.application.id_type=this.selectedStudent.id_type;
            this.application.id_num=this.selectedStudent.id_num;
            this.application.name_zh=this.selectedStudent.name_zh;
            this.application.name_fn=this.selectedStudent.name_fn;
            this.application.gender=this.selectedStudent.gender;
            this.application.dob=this.selectedStudent.dob;
            this.application.mobile=this.selectedStudent.mobile;
        },
        onFinish(){
            this.$inertia.post('/admin/application',this.application)
        }

    },
}
</script>