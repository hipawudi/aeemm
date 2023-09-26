<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          課程管理
        </div>
        <div class="flex-auto w-1/2 text-right">
          <inertia-link :href="route('admin.courses.create')"
            ><a-button type="primary" class="!rounded">新增課程</a-button></inertia-link
          >
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-table :dataSource="courses" :columns="columns">
          <template #bodyCell="{ column, text, record, index }">
            <template v-if="column.dataIndex == 'operation'">
              <div class="flex flex-wrap gap-3">
                <div class="" v-if="record.form.published === 0">
                  <a-popconfirm
                    title="是否確定公開這個課程報名"
                    ok-text="是"
                    cancel-text="否"
                    @confirm="publishedForm(record.id)"
                  >
                    <a-button>公開報名</a-button>
                  </a-popconfirm>
                </div>
                <div class="" v-if="record.form.published === 1">
                  <a-badge :count="record.form.wait_count">
                    <inertia-link
                      :href="
                        route('admin.forms.applications.index', { id: record.form['id'] })
                      "
                      class="ant-btn"
                      >查看報名</inertia-link
                    >
                  </a-badge>
                </div>
                <div class="">
                  <inertia-link
                    :href="route('admin.courses.edit', record.id)"
                    class="ant-btn"
                    >修改</inertia-link
                  >
                </div>
                <div class="">
                  <a-popconfirm
                    title="是否確定刪除這個課程"
                    ok-text="是"
                    cancel-text="否"
                    @confirm="deleteRecord(record.id)"
                  >
                    <a-button>刪除</a-button>
                  </a-popconfirm>
                </div>
              </div>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { UploadOutlined } from "@ant-design/icons-vue";
import Icon, { RestFilled } from "@ant-design/icons-vue";
import { message } from "ant-design-vue";

export default {
  components: {
    AdminLayout,
    UploadOutlined,
    RestFilled,
  },
  props: ["courses"],
  data() {
    return {
      modal: {
        isOpen: false,
        data: {},
        title: "Modal",
        mode: "",
      },
      columns: [
        {
          title: "標題(中文)",
          dataIndex: "name_zh",
        },
        {
          title: "標題(英文)",
          dataIndex: "name_en",
        },
        {
          title: "開始日期",
          dataIndex: "start_date",
        },
        {
          title: "結束日期",
          dataIndex: "end_date",
        },
        {
          title: "上課時間",
          dataIndex: "class_time",
        },
        {
          title: "時數",
          dataIndex: "hours",
        },
        {
          title: "操作",
          dataIndex: "operation",
          key: "operation",
          width: "20rem",
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
  created() {},
  methods: {
    deleteRecord(recordId) {
      this.$inertia.delete("/admin/courses" + recordId, {
        onSuccess: (page) => {
          console.log(page);
        },
        onError: (error) => {
          alert(error.message);
        },
      });
    },
    publishedForm(recordId) {
      this.$inertia.get(
        route("admin.courses.publishedForm", recordId),
        {},
        {
          onSuccess: (page) => {
            message.success("公開成功");
          },
          onError: (error) => {
            message.error(error.message);
          },
        }
      );
    },
  },
};
</script>
