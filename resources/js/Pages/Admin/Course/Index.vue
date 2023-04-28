<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          會員列表
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
              <div class="space-x-2">
                <inertia-link
                  :href="route('admin.courses.edit', record.id)"
                  class="ant-btn"
                  >修改</inertia-link
                >
                <a-popconfirm
                  title="是否確定刪除這個課程"
                  ok-text="是"
                  cancel-text="否"
                  @confirm="deleteRecord(record.id)"
                >
                  <a-button>刪除</a-button>
                </a-popconfirm>
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
  },
};
</script>
