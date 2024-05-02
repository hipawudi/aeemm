<template>
  <AdminLayout title="申請列表">
    <div class="md:p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >申請列表</div>
      </div>
      <div class="container mx-auto pt-5">
        <div class="bg-white relative shadow rounded-lg overflow-x-auto">
          <a-table
            :dataSource="member_applications.data"
            text-right
            :columns="columns"
            :pagination="pagination"
            @change="onPaginationChange"
            ref="dataTable"
          >
            <template
              #customFilterDropdown="{
                setSelectedKeys,
                selectedKeys,
                confirm,
                clearFilters,
                column,
              }"
            >
              <div style="padding: 8px">
                <a-input
                  ref="searchInput"
                  :placeholder="`Search ${column.dataIndex}`"
                  :value="selectedKeys[0]"
                  style="width: 188px; margin-bottom: 8px; display: block"
                  @change="(e) => setSelectedKeys(e.target.value ? [e.target.value] : [])"
                  @pressEnter="handleSearch(selectedKeys, confirm, column.dataIndex)"
                />
                <a-button
                  type="primary"
                  size="small"
                  style="width: 90px; margin-right: 8px"
                  @click="handleSearch(selectedKeys, confirm, column.dataIndex)"
                >
                  <template #icon><SearchOutlined /></template>
                  Search
                </a-button>
                <a-button
                  size="small"
                  style="width: 90px"
                  @click="handleReset(clearFilters)"
                >
                  Reset
                </a-button>
              </div>
            </template>
            <template #customFilterIcon="{ filtered }">
              <search-outlined :style="{ color: filtered ? '#108ee9' : undefined }" />
            </template>
            <template #bodyCell="{ column, record }">
              <template v-if="column.dataIndex == 'state'">
                <div>
                  {{
                    member_application_state.find((x) => x.value == record.state)?.label
                  }}
                </div>
              </template>

              <template v-if="column.dataIndex == 'operation'">
                <div class="space-x-2">
                  <a-button @click="viewRecord(record)">查看</a-button>
                  <a-button
                    type="primary"
                    v-if="record.state == 0"
                    @click="passRecord(record)"
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
          <a-button
            v-if="modal.data.state == 0"
            type="primary"
            @click="passRecord(modal.data)"
            >接受</a-button
          >
          <a-button v-if="modal.data.state == 0" @click="rejectRecord(modal.data)"
            >拒絕</a-button
          >
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
import { SearchOutlined } from "@ant-design/icons-vue";
import { defineComponent, reactive } from "vue";

export default {
  components: {
    AdminLayout,
    SearchOutlined,
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
          customFilterDropdown: true,
          onFilter: (value, record) =>
            record.name.toString().toLowerCase().includes(value.toLowerCase()),
          onFilterDropdownOpenChange: (visible) => {
            if (visible) {
              setTimeout(() => {
                searchInput.value.focus();
              }, 100);
            }
          },
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
      state: {
        searchText: "",
        searchedColumn: "",
      },
      searchInput: "",
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
