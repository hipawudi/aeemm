<template>
  <AdminLayout title="表格管理">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">表格管理</h2>
    </template>

    {{ course.title_zh }}
    {{ course.title_en }}
    {{ course.description_zh }}
    {{ course.description_en }}
    {{ course.start_date }}
    {{ course.end_date }}
    {{ course.class_time }}
    {{ course.fee }}
    <div v-html="course.content"></div>
    {{ course.language }}
    {{ course.location }}
    {{ course.target }}
    {{ course.published }}
    <hr />
    <div v-html="course.tutor"></div>
  </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import dayjs from "dayjs";

export default {
  components: {
    AdminLayout,
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
