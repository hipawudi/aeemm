<template>
  <MemberLayout title="課程內容" v-if="$page.props.user.id">
    <template #header>
      <div class="flex">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">課程內容</h2>
        <div class="flex-auto flex justify-end">
          <inertia-link :href="route('forms.show', course.id)">
            <a-button
              type="primary"
              shape="round"
              :disabled="
                new Date(course.end_date) < new Date() || course.form.published == 0
              "
              >立即報名</a-button
            >
          </inertia-link>
        </div>
      </div>
    </template>
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 py-4">
      <div class="flex flex-col sm:flex-row gap-8">
        <div class="flex-auto sm:w-2/3">
          <div class="flex flex-col gap-6">
            <div class="flex flex-col bg-white rounded-md p-4 shadow-md">
              <div class="text-xl font-bold">
                {{ course.name_zh ?? course.name_en }}({{
                  course.name_zh ? course.name_en : ""
                }})
              </div>
              <div class="">
                <img src="/images/course_cover.jpg" class="w-full h-56" />
              </div>
            </div>
            <div
              class="flex flex-col bg-white rounded-md p-4 space-y-2 shadow-md relative"
            >
              <div class="absolute right-4 opacity-20 bottom-4">
                <img class="w-16" src="/images/logo.jpg" />
              </div>
              <div class="text-lg font-bold">課程內容</div>
              <div class="ml-4" v-html="course.content ?? course.description_en"></div>
              <div class="text-lg font-bold">上堂時間(共{{ course.hours }}小時)</div>
              <div class="ml-4">{{ course.class_time }}</div>
            </div>
          </div>
        </div>
        <div class="flex-auto sm:w-1/3">
          <div class="flex flex-col gap-6">
            <div class="flex flex-col bg-white rounded-md p-4">
              <div class="text-center text-lg font-bold">課程導師</div>
              <div class="flex justify-center">
                <img src="/images/logo.jpg" class="h-32 w-28" />
              </div>
              <div class="flex leading-6" v-html="course.tutor"></div>
            </div>
            <div class="flex flex-col bg-white rounded-md p-4 space-y-2">
              <div class="text-sm text-gray-500">
                報名時間:{{ course.start_date }}至{{ course.end_date }}
              </div>
              <div class="flex">
                <div class="flex-auto space-x-2 flex items-center basis-2/3">
                  <img src="/images/icons/dollar.png" class="w-6 h-6" />
                  <div v-if="!course.member_priority">
                    {{ "非會員:" + course.fee }}
                  </div>
                  <div>會員:{{ course.fee_member }}</div>
                </div>
                <div class="flex-auto space-x-2 flex items-center basis-1/3">
                  <img src="/images/icons/clock.png" class="w-6 h-6" />
                  <div>{{ course.hours }}小時</div>
                </div>
              </div>
              <div class="flex">
                <div class="flex-auto space-x-2 flex items-center basis-2/3">
                  <img src="/images/icons/group.png" class="w-6 h-6" />
                  <div>名額:{{ course.quota == 0 ? "無限制" : course.qutoa + "人" }}</div>
                </div>
                <div class="flex-auto space-x-2 flex items-center basis-1/3">
                  <img src="/images/icons/language.png" class="w-6 h-6" />
                  <div>{{ course.language }}</div>
                </div>
              </div>
              <div clas="flex">
                <div class="flex-auto space-x-2 flex items-center basis-2/3">
                  <img src="/images/icons/book.png" class="w-6 h-6" />
                  <div>課程編號:{{ course.number }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MemberLayout>
  <WebLayout title="課程內容" v-else>
    <template #header>
      <div class="flex">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">課程內容</h2>
        <div class="flex-auto flex justify-end">
          <inertia-link :href="route('forms.show', course.id)">
            <a-button
              type="primary"
              shape="round"
              :disabled="
                new Date(course.end_date) < new Date() || course.form.published == 0
              "
              >立即報名</a-button
            >
          </inertia-link>
        </div>
      </div>
    </template>
    <div class="max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 py-4">
      <div class="flex flex-col sm:flex-row gap-8">
        <div class="flex-auto sm:w-2/3">
          <div class="flex flex-col gap-6">
            <div class="flex flex-col bg-white rounded-md p-4 shadow-md">
              <div class="text-xl font-bold">
                {{ course.name_zh ?? course.name_en }}({{
                  course.name_zh ? course.name_en : ""
                }})
              </div>
              <div class="">
                <img src="/images/course_cover.jpg" class="w-full h-56" />
              </div>
            </div>
            <div
              class="flex flex-col bg-white rounded-md p-4 space-y-2 shadow-md relative"
            >
              <div class="absolute right-4 opacity-20 bottom-4">
                <img class="w-16" src="/images/logo.jpg" />
              </div>
              <div class="text-lg font-bold">課程內容</div>
              <div class="ml-4" v-html="course.content ?? course.description_en"></div>
              <div class="text-lg font-bold">上堂時間(共{{ course.hours }}小時)</div>
              <div class="ml-4">{{ course.class_time }}</div>
            </div>
          </div>
        </div>
        <div class="flex-auto sm:w-1/3">
          <div class="flex flex-col gap-6">
            <div class="flex flex-col bg-white rounded-md p-4">
              <div class="text-center text-lg font-bold">課程導師</div>
              <div class="flex justify-center">
                <img src="/images/logo.jpg" class="h-32 w-28" />
              </div>
              <div class="flex flex-col leading-6" v-html="course.tutor"></div>
            </div>
            <div class="flex flex-col bg-white rounded-md p-4 space-y-2">
              <div class="text-sm text-gray-500">
                報名時間:{{ course.start_date }}至{{ course.end_date }}
              </div>
              <div class="flex">
                <div class="flex-auto space-x-2 flex items-center basis-2/3">
                  <img src="/images/icons/dollar.png" class="w-6 h-6" />
                  <div v-if="!course.member_priority">
                    {{ "非會員:" + course.fee }}
                  </div>
                  <div>會員:{{ course.fee_member }}</div>
                </div>
                <div class="flex-auto space-x-2 flex items-center basis-1/3">
                  <img src="/images/icons/clock.png" class="w-6 h-6" />
                  <div>{{ course.hours }}小時</div>
                </div>
              </div>
              <div class="flex">
                <div class="flex-auto space-x-2 flex items-center basis-2/3">
                  <img src="/images/icons/group.png" class="w-6 h-6" />
                  <div>名額:{{ course.quota == 0 ? "無限制" : course.qutoa + "人" }}</div>
                </div>
                <div class="flex-auto space-x-2 flex items-center basis-1/3">
                  <img src="/images/icons/language.png" class="w-6 h-6" />
                  <div>{{ course.language }}</div>
                </div>
              </div>
              <div clas="flex">
                <div class="flex-auto space-x-2 flex items-center basis-2/3">
                  <img src="/images/icons/book.png" class="w-6 h-6" />
                  <div>課程編號:{{ course.number }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import dayjs from "dayjs";
import WebLayout from "@/Layouts/WebLayout.vue";
import { message } from "ant-design-vue";

export default {
  components: {
    MemberLayout,
    dayjs,
    WebLayout,
  },
  props: ["course"],
  data() {
    return {
      dateFormat: "YYYY-MM-DD",
      modal: {
        isOpen: false,
        data: {},
        title: "Modal",
        mode: "",
      },
      columns: [
        {
          title: "Title Zh",
          dataIndex: "title_zh",
        },
        {
          title: "Title En",
          dataIndex: "title_en",
        },
        {
          title: "Start Date",
          dataIndex: "start_date",
        },
        {
          title: "End Date",
          dataIndex: "end_date",
        },
        {
          title: "Action",
          dataIndex: "operation",
          key: "operation",
        },
      ],
      rules: {
        field: { required: true },
        label: { required: true },
      },
      validateMessages: {
        required: "${label} is required!",
        types: {
          email: "${label} is not a valid email!",
          number: "${label} is not a valid number!",
        },
        number: {
          range: "${label} must be between ${min} and ${max}",
        },
      },
      labelCol: {
        style: {
          width: "150px",
        },
      },
    };
  },
  created() {
    if (!Array.isArray(this.course.class_time)) {
      this.course.class_time = this.course.class_time;
    }
  },
  mounted() {
    if (this.$page.props.errors.message) {
      message.error(this.$page.props.errors.message);
    }
  },
  computed: {
    classTimeFormat() {
      if (!Array.isArray(this.course.class_time)) {
        this.course.class_time = this.course.class_time;
      }
    },
  },
  methods: {
    createRecord(record) {
      this.course = {};
      this.course.media = [];
      this.modal.mode = "CREATE";
      this.modal.isOpen = true;
    },
    editRecord(record) {
      this.course = { ...record };
      this.modal.mode = "EDIT";
      this.modal.isOpen = true;
    },
    storeRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("admin.courses.store"), this.course, {
            onSuccess: (page) => {
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
    updateRecord() {
      console.log(this.course);
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.course._method = "PATCH";
          this.$inertia.post(route("admin.courses.update", this.course.id), this.course, {
            onSuccess: (page) => {
              if (!Array.isArray(this.course.class_time)) {
                this.course.class_time = this.course.class_time;
              }

              console.log(page);
            },
            onError: (error) => {
              console.log(error);
            },
          });
        })
        .catch((err) => {
          console.log("error", err);
        });
    },

    deleteRecord(record) {
      if (!confirm("Are you sure want to remove?")) return;
      this.$inertia.delete(route("admin.forms.destroy", { form: record.id }), {
        onSuccess: (page) => {
          console.log(page);
        },
        onError: (error) => {
          alert(error.message);
        },
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
