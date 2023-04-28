<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div class="basis-1/2 font-semibold text-xl text-gray-800">專業證書</div>
        <div class="basis-1/2 text-right">
          <a-button @click="createRecord()" type="primary" class="!rounded"
            >新增專業證書</a-button
          >
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-table :dataSource="professionals" :columns="columns">
          <template #bodyCell="{ column, text, record, index }">
            <template v-if="column.dataIndex == 'operation'">
              <div class="space-x-2">
                <a-button @click="editRecord(record)">修改</a-button>
                <a-popconfirm
                  title="是否確定刪除這個專業證書"
                  ok-text="是"
                  cancel-text="否"
                  @confirm="deleteRecord(record.id)"
                >
                  <a-button>刪除</a-button>
                </a-popconfirm>
              </div>
            </template>
            <template v-else-if="column.model == 'member'">
              {{ record.member[column.dataIndex] }}
            </template>
            <template v-else-if="column.model == 'certificate'">
              {{ record.certificate[column.dataIndex] }}
            </template>
            <template v-else>
              {{ record[column.dataIndex] }}
            </template>
          </template>
        </a-table>
      </div>
      <!-- Modal Start-->
      <a-modal
        v-model:visible="modal.isOpen"
        :title="modal.mode == 'CREATE' ? '新增' : '修改'"
        width="60%"
      >
        <a-form
          ref="modalRef"
          :model="modal.data"
          name="Teacher"
          :label-col="{ span: 4 }"
          :wrapper-col="{ span: 24 }"
          autocomplete="off"
          :rules="rules"
          :validate-messages="validateMessages"
        >
          <a-form-item label="Certificate Title" name="certificate_id">
            <a-select
              v-model:value="modal.data.certificate_id"
              :options="certificates"
              :field-names="{ label: 'cert_title', value: 'id' }"
              :disabled="modal.mode == 'EDIT'"
            />
          </a-form-item>
          <a-form-item label="Display Name" name="member_id">
            <a-select
              v-model:value="modal.data.member_id"
              :options="members"
              :field-names="{ label: 'display_name', value: 'id' }"
              :disabled="modal.mode == 'EDIT'"
            />
          </a-form-item>
          <a-form-item label="Display Number" name="number_display">
            <a-input
              v-model:value="modal.data.number_display"
              :disabled="modal.mode == 'EDIT'"
            />
          </a-form-item>
          <a-form-item label="Issue Date" name="issue_date">
            <a-date-picker
              v-model:value="modal.data.issue_date"
              :format="dateFormat"
              :valueFormat="dateFormat"
            />
          </a-form-item>
          <a-form-item label="Valid From" name="valid_from">
            <a-date-picker
              v-model:value="modal.data.valid_from"
              :format="dateFormat"
              :valueFormat="dateFormat"
            />
          </a-form-item>
          <a-form-item label="Valid Until" name="valid_until">
            <a-date-picker
              v-model:value="modal.data.valid_until"
              :format="dateFormat"
              :valueFormat="dateFormat"
            />
          </a-form-item>
          <a-form-item label="Authorize by" name="authorize_by">
            <a-input v-model:value="modal.data.authorize_by" />
          </a-form-item>
          <a-form-item label="Rank" name="rank">
            <a-input v-model:value="modal.data.rank" />
          </a-form-item>
          <a-form-item label="Extra" name="extra">
            <a-input v-model:value="modal.data.extra" />
          </a-form-item>
          <a-form-item label="Remark" name="remark">
            <a-textarea v-model:value="modal.data.remark" />
          </a-form-item>
          <a-form-item label="Avata" name="avata">
            <div v-if="modal.data.media.length">
              <inertia-link
                :href="route('admin.certificate-delete-media', modal.data.media[0].id)"
                class="float-right text-red-500"
              >
                <svg
                  focusable="false"
                  class=""
                  data-icon="delete"
                  width="1em"
                  height="1em"
                  fill="currentColor"
                  aria-hidden="true"
                  viewBox="64 64 896 896"
                >
                  <path
                    d="M360 184h-8c4.4 0 8-3.6 8-8v8h304v-8c0 4.4 3.6 8 8 8h-8v72h72v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80h72v-72zm504 72H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zM731.3 840H292.7l-24.2-512h487l-24.2 512z"
                  ></path>
                </svg>
              </inertia-link>
              <img
                :src="
                  '/media/' + modal.data.media[0].id + '/' + modal.data.media[0].file_name
                "
              />
            </div>
            <a-upload
              v-model:file-list="modal.data.avata"
              :multiple="false"
              :beforeUpload="() => false"
              :max-count="1"
              list-type="picture"
            >
              <a-button>
                <upload-outlined></upload-outlined>
                upload
              </a-button>
            </a-upload>
          </a-form-item>
        </a-form>
        <template #footer>
          <a-button
            v-if="modal.mode == 'EDIT'"
            key="Update"
            type="primary"
            @click="updateRecord()"
            >更新</a-button
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
import { UploadOutlined } from "@ant-design/icons-vue";

export default {
  components: {
    AdminLayout,
    UploadOutlined,
  },
  props: ["professionals", "certificates", "members"],
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
          title: "專業認證",
          dataIndex: "cert_title",
          model: "certificate",
        },
        {
          title: "成員名稱",
          dataIndex: "display_name",
          model: "member",
        },
        {
          title: "認證名片號碼",
          dataIndex: "number_display",
        },
        {
          title: "簽發日期",
          dataIndex: "issue_date",
        },
        {
          title: "有效期自",
          dataIndex: "valid_from",
        },
        {
          title: "有效期至",
          dataIndex: "valid_until",
        },
        {
          title: "授權人",
          dataIndex: "authorize_by",
        },
        {
          title: "操作",
          dataIndex: "operation",
          key: "operation",
        },
      ],
      rules: {
        name_zh: { required: true },
        mobile: { required: true },
        state: { required: true },
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
    createRecord(record) {
      this.modal.data = {};
      this.modal.data.media = [];
      (this.modal.data.certificate = {}),
        (this.modal.data.member = {}),
        (this.modal.mode = "CREATE");
      this.modal.isOpen = true;
    },
    editRecord(record) {
      this.modal.data = { ...record };
      this.modal.mode = "EDIT";
      this.modal.title = "修改";
      this.modal.isOpen = true;
    },
    storeRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("admin.professionals.store"), this.modal.data, {
            onSuccess: (page) => {
              this.modal.isOpen = false;
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
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.modal.data._method = "PATCH";
          this.$inertia.post(
            route("admin.professionals.update", this.modal.data.id),
            this.modal.data,
            {
              onSuccess: (page) => {
                this.modal.isOpen = false;
              },
              onError: (error) => {
                console.log(error);
              },
            }
          );
        })
        .catch((err) => {
          console.log("error", err);
        });
    },
    deleteRecord(recordId) {
      this.$inertia.delete("/admin/professionals/" + recordId, {
        onSuccess: (page) => {
          console.log(page);
        },
        onError: (error) => {
          console.log(error);
        },
      });
    },
  },
};
</script>
