<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          創建課程
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-form
          ref="modalRef"
          :model="course"
          name="Teacher"
          layout="vertical"
          autocomplete="off"
          :rules="rules"
          :validate-messages="validateMessages"
        >
          <div class="pb-4">
            <a-steps :current="current">
              <a-step title="基本資料"> </a-step>
              <a-step title="課程內容"> </a-step>
              <a-step title="導師資料"> </a-step>
            </a-steps>
          </div>
          <div class="card bg-white rounded-md p-4" v-if="current === 0">
            <div class="text-lg font-bold pb-2">基本資料</div>
            <div class="flex-col">
              <div class="flex gap-6">
                <div class="flex-1">
                  <a-form-item label="課程名稱(中文)" name="name_zh">
                    <a-input v-model:value="course.name_zh" />
                  </a-form-item>
                </div>
                <div class="flex-1">
                  <a-form-item label="課程名稱(英文)" name="name_en">
                    <a-input v-model:value="course.name_en" />
                  </a-form-item>
                </div>
                <div class="flex-1">
                  <a-form-item label="課程編號" name="number">
                    <a-input v-model:value="course.number"></a-input>
                  </a-form-item>
                </div>
              </div>
              <a-form-item label="課程簡介(中文)" name="description_zh">
                <a-textarea v-model:value="course.description_zh" />
              </a-form-item>
              <a-form-item label="課程簡介(英文)" name="description_en">
                <a-textarea v-model:value="course.description_en" />
              </a-form-item>
              <div class="flex gap-6">
                <div class="flex flex-auto w-1/2 gap-6">
                  <a-form-item label="報名開始日期" name="start_date">
                    <a-date-picker
                      v-model:value="course.start_date"
                      :format="dateFormat"
                      :valueFormat="dateFormat"
                    />
                  </a-form-item>
                  <a-form-item label="報名結束日期" name="end_date">
                    <a-date-picker
                      v-model:value="course.end_date"
                      :format="dateFormat"
                      :valueFormat="dateFormat"
                    />
                  </a-form-item>
                  <a-form-item label="上課時間" name="class_time">
                    <a-input
                      v-model:value="course.class_time"
                      format="HH:mm"
                      valueFormat="HH:mm"
                    />
                  </a-form-item>
                  <a-form-item label="時數" name="hours">
                    <a-input-number v-model:value="course.hours" :min="0" />
                  </a-form-item>
                </div>
                <div class="flex flex-auto w-1/2 gap-6">
                  <a-form-item label="學費(非會員)" name="fee">
                    <a-input-number v-model:value="course.fee" :min="0" />
                  </a-form-item>
                  <a-form-item label="學費(會員)" name="fee_member">
                    <a-input-number v-model:value="course.fee_member" :min="0" />
                  </a-form-item>
                  <a-form-item label="名額" name="quota">
                    <a-input-number v-model:value="course.quota" :min="1" />
                  </a-form-item>
                  <a-form-item label="語言" name="language">
                    <a-input v-model:value="course.language" />
                  </a-form-item>
                  <a-form-item label="對象" name="target">
                    <a-input v-model:value="course.target" />
                  </a-form-item>
                </div>
              </div>
              <div class="flex gap-6">
                <div class="flex-auto w-1/2">
                  <a-form-item label="地點" name="location">
                    <a-input v-model:value="course.location" />
                  </a-form-item>
                </div>
                <div class="flex-auto w-1/2">
                  <a-form-item label="認可範疇" name="scope">
                    <a-input v-model:value="course.scope" />
                  </a-form-item>
                </div>
              </div>
              <div class="flex gap-6">
                <div class="flex-auto w-1/2">
                  <a-form-item label="發佈" name="published">
                    <a-switch
                      v-model:checked="course.published"
                      :unCheckedValue="0"
                      :checkedValue="1"
                    />
                  </a-form-item>
                </div>
                <div class="flex-auto w-1/2">
                  <a-form-item label="單張" name="poster">
                    <a-upload
                      v-model:file-list="course.poster"
                      :multiple="false"
                      :beforeUpload="openCropModal"
                      :max-count="1"
                      list-type="picture-card"
                    >
                      <a-button>
                        <upload-outlined></upload-outlined>
                        上傳
                      </a-button>
                    </a-upload>
                  </a-form-item>
                </div>
              </div>
            </div>
            <div class="text-right">
              <a-button type="primary" @click="nextPage">下一頁</a-button>
            </div>
          </div>
          <div class="card bg-white p-4 rounded-md" v-if="current === 1">
            <div class="text-lg font-bold pb-2">課程內容</div>
            <a-form-item label="內容" name="content">
              <div class="bg-white">
                <quill-editor v-model:value="course.content" style="min-height: 300px" />
              </div>
            </a-form-item>
            <div class="text-right space-x-4">
              <a-button @click="current--">上一頁</a-button>
              <a-button type="primary" @click="current++">下一頁</a-button>
            </div>
          </div>
          <div class="card bg-white p-4 rounded-md" v-if="current === 2">
            <div class="text-lg font-bold pb-2">導師資料</div>
            <a-form-item label="導師" name="tutor">
              <div class="bg-white">
                <quill-editor v-model:value="course.tutor" style="min-height: 300px" />
              </div>
            </a-form-item>
            <div class="text-right space-x-4">
              <a-button @click="current--">上一頁</a-button>
              <a-button key="Store" type="primary" @click="storeRecord">新增</a-button>
            </div>
          </div>
        </a-form>
      </div>
    </div>
  </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { UploadOutlined } from "@ant-design/icons-vue";
import { quillEditor } from "vue3-quill";
import Icon, { RestFilled } from "@ant-design/icons-vue";
import { message } from "ant-design-vue";
import dayjs from "dayjs";

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
      course: {},
      current: 0,
      dateFormat: "YYYY-MM-DD",
      rules: {
        name_zh: { required: true },
      },
      validateMessages: {
        required: "請输入${label}",
        types: {
          email: "${label} 不是正確的郵箱格式",
          number: "${label} 不是正確的數字格式",
        },
        number: {
          range: "${label} 必須在${min}和${max}之間",
        },
      },
    };
  },
  created() {},
  mounted() {},
  computed: {},
  methods: {
    storeRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("admin.courses.store"), formData, {
            onSuccess: (page) => {
              message.success("新增成功");
              console.log(page);
            },
            onError: (err) => {
              console.log(err);
            },
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },
    nextPage() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.current++;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
<style>
.ant-form-vertical .ant-form-item-label {
  padding-bottom: 0px;
}
</style>
