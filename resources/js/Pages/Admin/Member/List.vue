<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div class="basis-1/2 font-semibold text-xl text-gray-800">會員列表</div>
        <div class="basis-1/2 text-right">
          <a-button @click="createRecord()" type="primary" class="!rounded"
            >新增會員</a-button
          >
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-table
          :dataSource="members.data"
          text-right
          :columns="columns"
          :pagination="pagination"
          @change="onPaginationChange"
          ref="dataTable"
        >
          <template #bodyCell="{ column, text, record, index }">
            <template v-if="column.dataIndex == 'state'">
              {{ employmentStates.find((x) => x.value == record.state).label }}
            </template>
            <template v-if="column.dataIndex == 'operation'">
              <div class="space-x-2">
                <a-button @click="editRecord(record)">修改</a-button>
                <a-popconfirm
                  title="是否確定刪除這個成員"
                  ok-text="是"
                  cancel-text="否"
                  @confirm="deleteRecord(record.id)"
                >
                  <a-button>刪除</a-button>
                </a-popconfirm>
                <a-button v-if="!record.user" @click="createLogin(record)"
                  >建立帳號</a-button
                >
              </div>
            </template>
          </template>
        </a-table>
      </div>
      <!-- Modal Start-->

      <a-modal v-model:visible="modal.isOpen" :title="modal.title" width="60%">
        <a-form
          ref="modalRef"
          :model="modal.data"
          name="Teacher"
          autocomplete="off"
          layout="horizontal"
          :rules="rules"
          :label-col="labelCol"
          :validate-messages="validateMessages"
        >
          <div class="flex flex-col">
            <div class="flex justify-between gap-3">
              <div class="flex-auto w-3/4">
                <a-form-item label="中文姓名" name="name_zh"
                  ><a-input v-model:value="modal.data.name_zh"></a-input
                ></a-form-item>
              </div>
              <div class="flex-auto w-1/4">
                <a-form-item label="性別" name="gender"
                  ><a-select
                    :options="gender"
                    v-model:value="modal.data.gender"
                  ></a-select
                ></a-form-item>
              </div>
            </div>
            <a-form-item label="英文姓名" name="name_en"
              ><a-input v-model:value="modal.data.name_en"></a-input
            ></a-form-item>
            <a-form-item label="出生日期" name="birth"
              ><a-date-picker
                v-model:value="modal.data.birth"
                valueFormat="YYYY-MM-DD"
              ></a-date-picker
            ></a-form-item>
            <a-form-item label="通迅地址" name="address"
              ><a-input v-model:value="modal.data.address"></a-input
            ></a-form-item>
            <a-form-item label="聯絡電話" name="phone"
              ><a-input v-model:value="modal.data.phone"></a-input
            ></a-form-item>
            <a-form-item label="電子郵箱" name="email">
              <a-input v-model:value="modal.data.email"></a-input>
            </a-form-item>
            <a-form-item label="工作機構" name="company"
              ><a-input v-model:value="modal.data.company"></a-input
            ></a-form-item>
            <a-form-item label="職位" name="position"
              ><a-input v-model:value="modal.data.position"></a-input
            ></a-form-item>
            <a-form-item label="申請會籍" name="membership_level"
              ><a-select
                :options="membership_levels"
                v-model:value="modal.data.membership_level"
              ></a-select
            ></a-form-item>
          </div>
        </a-form>
        <template #footer>
          <a-button key="back" @click="modal.isOpen = false">取消</a-button>
          <a-button
            v-if="modal.mode == 'EDIT'"
            key="Update"
            type="primary"
            @click="updateRecord()"
            >確定</a-button
          >
          <a-button
            v-if="modal.mode == 'CREATE'"
            key="Store"
            type="primary"
            @click="storeRecord()"
            >新增</a-button
          >
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
  props: ["members", "gender", "membership_levels"],
  data() {
    return {
      columns: [
        {
          title: "姓名(中文)",
          dataIndex: "name_zh",
        },
        {
          title: "姓名(英文)",
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
      employmentStates: [
        {
          label: "活躍",
          value: 1,
        },
        {
          label: "非活躍",
          value: 2,
        },
        {
          label: "退會",
          value: 3,
        },
      ],
      modal: {
        isOpen: false,
        data: {},
        title: "Modal",
        mode: "",
      },
      pagination: {
        showSizeChanger: this.members.total > 10 ? ture : false,
        total: this.members.total,
        current: this.members.current_page,
        pageSize: this.members.per_page,
      },
      filter: {},
      rules: {
        name_zh: { required: true },
        name_en: { required: true },
        gender: { required: true },
        birth: { required: true },
        address: { required: true },
        name_en: { required: true },
        phone: { required: true },
        company: { required: true },
        position: { required: true },
        membership_level: { required: true },
        email: { required: true, type: "email" },
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
    createRecord() {
      this.modal.data = {
        state: 1,
      };
      this.modal.mode = "CREATE";
      this.modal.title = "新增會員";
      this.modal.isOpen = true;
    },
    editRecord(record) {
      console.log(record);
      this.modal.data = { ...record };
      this.modal.mode = "EDIT";
      this.modal.title = "修改";
      this.modal.isOpen = true;
    },
    storeRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("admin.members.store"), this.modal.data, {
            onSuccess: (page) => {
              this.modal.data = {};
              this.modal.isOpen = false;
              message.success("新增成功");
            },
            onError: (err) => {
              console.log(err);
              message.success("新增失敗");
            },
          });
        })
        .catch((err) => {
          console.log(err);
          message.success("新增失敗");
        });
    },
    updateRecord() {
      console.log(this.modal.data);
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.patch("/admin/members/" + this.modal.data.id, this.modal.data, {
            onSuccess: (page) => {
              this.modal.data = {};
              this.modal.isOpen = false;
              message.success("修改成功");
            },
            onError: (error) => {
              message.warning("修改失敗");
            },
          });
        })
        .catch((err) => {
          console.log("error", err);
          message.success("新增失敗");
        });
    },
    deleteRecord(recordId) {
      this.$inertia.delete("/admin/members/" + recordId, {
        onSuccess: (page) => {
          console.log(page);
          message.success("刪除成功");
        },
        onError: (error) => {
          console.log(error);
          message.success("刪除失敗");
        },
      });
    },
    createLogin(record) {
      if (record.email == null) {
        message.warning("此會員沒有電郵不能建立帳號");
      } else {
        this.$inertia.post(
          route("admin.members.createLogin"),
          { id: record.id },
          {
            onSuccess: (page) => {
              message.success("發送驗證郵件成功");
            },
            onError: (error) => {
              console.log(error);
              message.success("發送驗證郵件失敗");
            },
          }
        );
      }
    },
    onPaginationChange(page, filters, sorter) {
      this.$inertia.get(route("admin.members.index"), {
        page: page.current,
        per_page: page.pageSize,
      });
    },
  },
};
</script>
