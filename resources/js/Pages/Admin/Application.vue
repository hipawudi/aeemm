<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          報名管理
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <!-- {{ new Date().getFullYear() - 2009 + 1 }}
          {{ yearLength }} -->
        <a-table
          :dataSource="applications.data"
          :columns="columns"
          :pagination="pagination"
          @change="onPaginationChange"
          ref="dataTable"
        >
          <template #bodyCell="{ column, text, record, index }">
            <template v-if="column.key == 'form_id'">{{ record.form.title }}</template>
            <template v-if="column.key == 'name'">{{ record.user.name }}</template>
            <template v-if="column.key == 'email'">{{ record.user.email }}</template>
            <template v-if="column.key == 'state'"
              ><div class="flex">
                <div
                  class="p-1 px-2 rounded-md border border-solid"
                  :class="
                    record.state == 1
                      ? 'text-blue-500 bg-blue-100'
                      : 'text-green-500 bg-green-100'
                  "
                >
                  {{ states.find((x) => x.value == record.state).label }}
                </div>
              </div></template
            >
            <template v-if="column.key == 'published'">{{
              record.published == 1 ? "發佈" : "非發佈"
            }}</template>
            <template v-if="column.dataIndex == 'operation'">
              <div class="space-x-2">
                <a-button @click="showRecord(record)">查看</a-button>
                <a-popconfirm
                  v-if="record.state == 0"
                  title="是否確定通過這個報名"
                  ok-text="是"
                  cancel-text="否"
                  @confirm="passRecord(record.id, 1)"
                >
                  <a-button>通過</a-button>
                </a-popconfirm>
                <a-popconfirm
                  v-if="record.state == 2"
                  title="是否確定這個報名的繳費單"
                  ok-text="是"
                  cancel-text="否"
                  @confirm="passRecord(record.id, 3)"
                >
                  <a-button>確定</a-button>
                </a-popconfirm>
                <a-popconfirm
                  v-if="record.state == 0 || record.state == 2"
                  title="是否確定拒絕這個報名"
                  ok-text="是"
                  cancel-text="否"
                  @confirm="rejectRecord(record.id, 4)"
                >
                  <a-button>拒絕</a-button>
                </a-popconfirm>
              </div></template
            >
          </template>
        </a-table>
      </div>
      <!-- Modal Start-->
    </div>
    <!-- Modal End-->
  </AdminLayout>
  <a-modal
    v-model:visible="modal.isOpen"
    :title="modal.mode == 'CREATE' ? '新增' : modal.mode == 'EDIT' ? '修改' : '查看'"
    width="60%"
  >
    <!-- {{ modal.data.form.fields }} -->
    <a-descriptions title="表格內容" bordered :column="{ xs: 1, sm: 2 }">
      <a-descriptions-item label="姓名">{{ modal.data.user.name }}</a-descriptions-item>
      <a-descriptions-item label="電郵">{{ modal.data.user.email }}</a-descriptions-item>
      <template v-for="f in modal.data.form.fields">
        <a-descriptions-item :label="f.field_label">{{
          f.options
            ? JSON.parse(f.options).find(
                (x) => x.value == modal.data.fields.find((x) => x.field_id == f.id)?.value
              )?.label
            : modal.data.fields.find((x) => x.field_id == f.id)?.value
        }}</a-descriptions-item>
      </template>
    </a-descriptions>
    <div class="text-base font-bold mt-4">繳費單</div>
    <a :href="modal.data.url" target="_blank"
      ><img :src="modal.data.url" class="h-64 w-64"
    /></a>
    <template #footer>
      <a-button @click="modal.isOpen = false">Close</a-button>
    </template>
  </a-modal>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { UploadOutlined } from "@ant-design/icons-vue";
import { message } from "ant-design-vue";
import Icon, { RestFilled } from "@ant-design/icons-vue";
import { quillEditor } from "vue3-quill";

export default {
  components: {
    AdminLayout,
    UploadOutlined,
    RestFilled,
    quillEditor,
  },
  props: ["states", "applications"],
  data() {
    return {
      loading: false,
      modal: {
        isOpen: false,
        data: {
          published: 1,
        },
        title: "公告",
        mode: "",
      },
      pagination: {
        total: this.applications.total,
        current: this.applications.current_page,
        pageSize: this.applications.per_page,
      },
      filter: {},
      columns: [
        {
          title: "標題",
          dataIndex: "form_id",
          key: "form_id",
        },
        {
          title: "名稱",
          dataIndex: "user_id",
          key: "name",
        },
        {
          title: "電郵",
          dataIndex: "user_id",
          key: "email",
        },
        {
          title: "狀態",
          dataIndex: "state",
          key: "state",
        },
        {
          title: "操作",
          dataIndex: "operation",
          key: "operation",
        },
      ],
      rules: {
        title: { required: true },
        date: { required: true },
        category: { required: true },
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
    console.log(this.applications);
  },
  compunted: {
    pagination() {
      return {
        total: this.applications.total,
        current: this.applications.current_page,
        pageSize: this.applications.per_page,
      };
    },
  },
  methods: {
    showRecord(record) {
      this.modal.data = { ...record };
      this.modal.mode = "SHOW";
      this.modal.isOpen = true;
    },
    passRecord(id, state, remark) {
      this.$inertia.post(
        "/admin/applications/" + id + "/changeState",
        { state: state, remark: remark },
        {
          onSuccess: (page) => {
            console.log(page);
          },
          onError: (error) => {
            console.log(error);
          },
        }
      );
    },
    deleteRecord(recordId) {
      this.$inertia.delete("/admin/applications/" + recordId, {
        preserveState: false,
        onSuccess: (page) => {
          console.log(page);
        },
        onError: (error) => {
          alert(error.message);
        },
      });
    },
    onPaginationChange(page, filters, sorter) {
      this.$inertia.get(route("admin.applications.index"), {
        page: page.current,
        per_page: page.pageSize,
      });
    },
  },
};
</script>
