<template>
  <MemberLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">課程內容</h2>
    </template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-4">
      <div class="flex gap-8">
        <div class="flex-auto w-2/3">
          <div class="flex flex-col gap-6">
            <div class="flex flex-col bg-white rounded-md p-4">
              <div class="text-xl font-bold text-center">
                {{ course.name_zh ?? course.name_en }}
              </div>
              <div class="">
                <img src="/images/aeemm_banner.jpg" class="w-full h-56" />
              </div>
            </div>
            <div class="flex flex-col bg-white rounded-md p-4 space-y-2">
              <div class="text-lg font-bold">課程內容</div>
              <div class="" v-html="course.content ?? course.description_en"></div>
              <div class="text-lg font-bold">上堂時間(共{{ course.hours }}小時)</div>
              <div class="">{{ course.class_time }}</div>
            </div>
          </div>
        </div>
        <div class="flex-auto w-1/3">
          <div class="flex flex-col bg-white rounded-md p-4">
            <div class="text-center text-lg font-bold">課程導師</div>
            <div class="flex justify-center">
              <img src="/images/aeemm_logo.jpg" class="h-32 w-28" />
            </div>
            <div class="flex leading-6" v-html="course.tutor"></div>
          </div>
        </div>
      </div>
    </div>
  </MemberLayout>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import dayjs from "dayjs";

export default {
  components: {
    MemberLayout,
    dayjs,
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
  mounted() {},
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
