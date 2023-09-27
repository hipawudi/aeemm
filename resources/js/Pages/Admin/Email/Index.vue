<template>
  <AdminLayout title="電郵記錄">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          電郵記錄
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-table
          :dataSource="email_logs.data"
          :columns="columns"
          :pagination="pagination"
        >
          <template #bodyCell="{ column, record }">
            <template v-if="column.dataIndex == 'member_id'">
              <div class="w-16">
                {{ members.find((x) => x.id == record.member_id)?.name_zh }}
              </div>
            </template>
            <template v-if="column.dataIndex == 'status'">
              <div class="w-16">
                {{ record.status == 1 ? "發送成功" : "發送失敗" }}
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
import { message } from "ant-design-vue";

export default {
  components: {
    AdminLayout,
  },
  props: ["email_logs", "members"],
  data() {
    return {
      pagination: {
        total: this.email_logs.total,
        current: this.email_logs.current_page,
        pageSize: this.email_logs.per_page,
      },
      columns: [
        {
          title: "收件人",
          dataIndex: "member_id",
        },
        {
          title: "標題",
          dataIndex: "title",
        },
        {
          title: "內容",
          dataIndex: "content",
        },
        {
          title: "狀態",
          dataIndex: "status",
        },
        {
          title: "錯誤信息",
          dataIndex: "error_message",
        },
      ],
    };
  },
  created() {},
  methods: {
    sendEmail() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("admin.emails.store"), this.email_log, {
            preserveState: false,
            preserveScroll: true,
            resetOnSuccess: false,
            onSuccess: (page) => {
              console.log(page);
              message.success("發送成功");
            },
            onError: (error) => {
              console.log(error);
              message.error(error.message);
            },
          });
        })
        .catch((err) => {
          this.loading = false;
          console.log(err);
        });
    },
    filterOption(input, option) {
      return option.name_zh.toLowerCase().indexOf(input.toLowerCase()) >= 0;
    },
  },
};
</script>
