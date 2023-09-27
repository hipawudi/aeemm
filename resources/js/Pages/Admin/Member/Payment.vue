<template>
  <AdminLayout title="繳費列表">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div class="basis-1/2 font-semibold text-xl text-gray-800">繳費列表</div>
        <div class="basis-1/2 text-right">
          <a-button @click="createRecord()" type="primary" class="!rounded"
            >新增繳費單</a-button
          >
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-table
          :dataSource="payments.data"
          text-right
          :columns="columns"
          :pagination="pagination"
          @change="onPaginationChange"
          ref="dataTable"
        >
          <template #bodyCell="{ column, record }">
            <template v-if="column.dataIndex == 'member_id'">
              {{ members.find((x) => x.id == record.member_id).name_zh }}
            </template>
            <template v-if="column.dataIndex == 'cost'">
              {{ (record.cost * (record.cost_percentage ?? 100)) / 100 }}
            </template>
            <template v-if="column.dataIndex == 'state'">
              {{ payment_states.find((x) => x.value == record.state).label }}
            </template>
            <template v-if="column.dataIndex == 'operation'">
              <div class="space-x-2">
                <a-button @click="editRecord(record)">修改</a-button>
                <a-popconfirm
                  title="是否確定刪除這個繳費單"
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
      <!-- Modal Start-->

      <a-modal v-model:visible="modal.isOpen" :title="modal.title" width="60%">
        <a-form
          ref="modalRef"
          :model="modal.data"
          name="Teacher"
          :label-col="{ span: 8 }"
          :wrapper-col="{ span: 16 }"
          autocomplete="off"
          :rules="rules"
          :validate-messages="validateMessages"
        >
          <!-- <a-input type="hidden" v-model:value="modal.data.id" /> -->
          <a-form-item label="標題" name="title">
            <a-input v-model:value="modal.data.title"></a-input>
          </a-form-item>
          <a-form-item label="會員" name="member_id">
            <a-select v-model:value="modal.data.member_id" :options="options"> </a-select>
          </a-form-item>
          <a-form-item label="會費" name="cost">
            <a-input-number v-model:value="modal.data.cost" :min="1" />
          </a-form-item>
          <a-form-item label="會費折扣(%)" name="cost_percentage">
            <a-input-number v-model:value="modal.data.cost_percentage" :max="100" />
          </a-form-item>
          <a-form-item label="繳費開始日期" name="start_date">
            <a-date-picker
              v-model:value="modal.data.start_date"
              :format="dateFormat"
              :valueFormat="dateFormat"
            />
          </a-form-item>
          <a-form-item label="繳費結束日期" name="end_date">
            <a-date-picker
              v-model:value="modal.data.end_date"
              :format="dateFormat"
              :valueFormat="dateFormat"
            />
          </a-form-item>
          <a-form-item label="備註" name="remark">
            <a-textarea v-model:value="modal.data.remark" />
          </a-form-item>
          <a-form-item label="狀態" name="state">
            <a-select v-model:value="modal.data.state" :options="payment_states" />
          </a-form-item>
          <a-form-item label="會費單相片" v-if="modal.mode == 'EDIT'" name="url">
            <a :href="modal.data.url" v-if="modal.data.url" target="_blank"
              ><img :src="modal.data.url" class="h-64 w-64"
            /></a>
          </a-form-item>
          <a-form-item
            label="發送電郵通知"
            name="send_email"
            v-if="modal.mode == 'CREATE'"
          >
            <a-checkbox v-model:checked="modal.data.send_email"></a-checkbox>
          </a-form-item>
        </a-form>
        <template #footer>
          <a-button key="back" @click="modal.isOpen = false">取消</a-button>
          <a-button
            v-if="modal.mode == 'EDIT'"
            key="Update"
            type="primary"
            @click="updateRecord()"
            >確認</a-button
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
  props: ["payments", "members", "payment_states"],
  setup(props) {
    const options = props.members.map((x) => (x = { label: x.name_zh, value: x.id }));
    options.unshift({ label: "所有人", value: "0" });
    return { options };
  },
  data() {
    return {
      columns: [
        {
          title: "標題",
          dataIndex: "title",
          key: "title",
        },
        {
          title: "會員",
          dataIndex: "member_id",
          key: "member_id",
        },
        {
          title: "會費",
          dataIndex: "cost",
          key: "cost",
        },
        {
          title: "繳費開始日期",
          dataIndex: "start_date",
        },
        {
          title: "繳費結束日期",
          dataIndex: "end_date",
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
      dateFormat: "YYYY-MM-DD",
      pagination: {
        total: this.payments.total,
        current: this.payments.current_page,
        pageSize: this.payments.per_page,
      },
      filter: {},
      rules: {
        title: { required: true },
        member_id: { required: true },
        cost: { required: true },
        start_date: { required: true },
        end_date: { required: true },
        state: { required: true },
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
  mounted() {},
  methods: {
    createRecord() {
      this.modal.data = {
        state: "0",
      };
      this.modal.mode = "CREATE";
      this.modal.title = "新增繳費單";
      this.modal.isOpen = true;
    },
    editRecord(record) {
      this.modal.data = { ...record };
      this.modal.data.payment_image = [
        {
          name: this.modal.data.payment_image_path?.split("/").pop(),
          url: this.modal.data.payment_image_path,
        },
      ];
      this.modal.mode = "EDIT";
      this.modal.title = "修改";
      this.modal.isOpen = true;
    },
    storeRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("admin.members.payments.store"), this.modal.data, {
            onSuccess: (page) => {
              this.modal.data = {};
              this.modal.isOpen = false;
              message.success("新增成功");
            },
            onError: (err) => {
              message.success("新增成功");
              message.error(err.message);
            },
          });
        })
        .catch((err) => {
          console.log(err);
        });
    },
    updateRecord() {
      console.log(this.modal.data);
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.patch(
            "/admin/members/payments/" + this.modal.data.id,
            this.modal.data,
            {
              onSuccess: (page) => {
                this.modal.data = {};
                this.modal.isOpen = false;
                message.success("修改成功");
              },
              onError: (error) => {
                message.warning("修改失敗");
              },
            }
          );
        })
        .catch((err) => {
          console.log("error", err);
        });
    },
    deleteRecord(recordId) {
      this.$inertia.delete("/admin/members/payments/" + recordId, {
        onSuccess: (page) => {
          console.log(page);
          message.success("刪除成功");
        },
        onError: (error) => {
          console.log(error);
        },
      });
    },
    onPaginationChange(page, filters, sorter) {
      console.log(page.current);
      this.$inertia.get(route("admin.members.payments.index"), {
        page: page.current,
        per_page: page.pageSize,
      });
    },
  },
};
</script>
