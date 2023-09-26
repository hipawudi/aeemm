<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div class="basis-1/2 font-semibold text-xl text-gray-800">申請列表</div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-table
          :dataSource="member_applications.data"
          text-right
          :columns="columns"
          :pagination="pagination"
          @change="onPaginationChange"
          ref="dataTable"
        >
          <template #bodyCell="{ column, record }">
            <template v-if="column.dataIndex == 'state'">
              <div>
                {{ member_application_state.find((x) => x.value == record.state)?.label }}
              </div>
            </template>
            <template v-if="column.dataIndex == 'operation'">
              <div class="space-x-2">
                <a-button @click="viewRecord(record)">查看</a-button>
                <a-button v-if="record.state == 0" @click="passRecord(record)"
                  >接受</a-button
                >
                <a-button v-if="record.state == 0" @click="rejectRecord(record)"
                  >拒絕</a-button
                >
              </div>
            </template>
          </template>
        </a-table>
      </div>
      <!-- Modal Start-->

      <a-modal v-model:visible="modal.isOpen" title="查看" width="60%">
        <a-descriptions title="申請表" bordered>
          <a-descriptions-item label="中文姓名">{{
            modal.data.name_zh
          }}</a-descriptions-item>
          <a-descriptions-item label="性別">{{
            gender.find((x) => x.value == modal.data.gender)?.label
          }}</a-descriptions-item>
          <a-descriptions-item label="英文姓名">{{
            modal.data.name_en
          }}</a-descriptions-item>
          <a-descriptions-item label="出生日期">
            {{ modal.data.birth }}
          </a-descriptions-item>
          <a-descriptions-item label="通迅地址">{{
            modal.data.address
          }}</a-descriptions-item>
          <a-descriptions-item label="聯絡電話">{{
            modal.data.phone
          }}</a-descriptions-item>
          <a-descriptions-item label="電子郵箱">{{
            modal.data.email
          }}</a-descriptions-item>
          <a-descriptions-item label="工作機構">{{
            modal.data.company
          }}</a-descriptions-item>
          <a-descriptions-item label="職位">{{
            modal.data.position
          }}</a-descriptions-item>
          <a-descriptions-item label="申請會籍">{{
            membership_levels.find((x) => x.value == modal.data.membership_level)?.label
          }}</a-descriptions-item>
        </a-descriptions>
        <template #footer>
          <a-button @click="passRecord(record)">接受</a-button>
          <a-button @click="rejectRecord(record)">拒絕</a-button>
          <a-button key="back" @click="modal.isOpen = false">關閉</a-button>
        </template>
      </a-modal>
    </div>
    <!-- Modal End-->
  </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { message } from "ant-design-vue";
import { defineComponent, reactive } from "vue";

export default {
  components: {
    AdminLayout,
  },
  props: [
    "member_applications",
    "gender",
    "membership_levels",
    "member_application_state",
  ],
  data() {
    return {
      columns: [
        {
          title: "姓名(中文)",
          dataIndex: "name_zh",
        },
        {
          title: "姓名(外文)",
          dataIndex: "name_en",
        },
        {
          title: "電子郵箱",
          dataIndex: "email",
        },
        {
          title: "手機",
          dataIndex: "phone",
        },
        {
          title: "狀態",
          dataIndex: "state",
        },
        {
          title: "操作",
          dataIndex: "operation",
          key: "operation",
          width: 300,
        },
      ],
      modal: {
        isOpen: false,
        data: {},
        title: "Modal",
        mode: "",
      },
      pagination: {
        showSizeChanger: this.member_applications.total > 10 ? ture : false,
        total: this.member_applications.total,
        current: this.member_applications.current_page,
        pageSize: this.member_applications.per_page,
      },
      filter: {},
      rules: {
        name_zh: { required: true },
        mobile: { required: true },
        state: { required: true },
        email: { type: "email" },
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
      labelCol: {
        style: {
          width: "150px",
        },
      },
    };
  },
  created() {},
  methods: {
    viewRecord(record) {
      console.log(record);
      this.modal.data = { ...record };
      this.modal.isOpen = true;
    },
    passRecord(record) {
      this.$inertia.post(route("admin.members.applications.pass"), record, {
        onSuccess: (page) => {
          message.success("接受申請成功");
          this.data = {};
          console.log(page);
        },
        onError: (err) => {
          console.log(err);
          message.error("接受申請失敗");
        },
      });
    },
    rejectRecord(record) {
      this.$inertia.post(route("admin.members.applications.reject"), record, {
        onSuccess: (page) => {
          message.success("拒絕申請成功");
          this.data = {};
          console.log(page);
        },
        onError: (err) => {
          console.log(err);
          message.error("拒絕申請失敗");
        },
      });
    },
    onPaginationChange(page, filters, sorter) {
      this.$inertia.get(route("admin.member_applications.index"), {
        page: page.current,
        per_page: page.pageSize,
      });
    },
  },
};
</script>
