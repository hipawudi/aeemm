<template>
  <AdminLayout title="專業認證">
    <div class="md:p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          專業認證
        </div>
        <div class="flex-auto w-1/2 text-right">
          <a-button type="primary" class="!rounded" @click="createRecord()"
            >新增專業認證</a-button
          >
        </div>
      </div>
      <div class="container mx-auto pt-5">
        <div class="bg-white relative shadow rounded-lg overflow-x-auto">
          <a-table :dataSource="certificates" :columns="columns">
            <template #bodyCell="{ column, record }">
              <template v-if="column.dataIndex == 'operation'">
                <div class="space-x-2">
                  <a-button @click="editRecord(record)">修改</a-button>
                  <a-button @click="deleteRecord(record.id)">刪除</a-button>
                </div>
              </template>
            </template>
          </a-table>
        </div>
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
          :label-col="{ span: 8 }"
          :wrapper-col="{ span: 16 }"
          autocomplete="off"
          :rules="rules"
          :validate-messages="validateMessages"
        >
          <a-form-item label="認證名稱" name="cert_title">
            <a-input v-model:value="modal.data.cert_title" />
          </a-form-item>
          <a-form-item label="認證機構" name="cert_body">
            <a-input v-model:value="modal.data.cert_body" />
          </a-form-item>
          <a-form-item label="認證內容" name="cert_content">
            <a-textarea v-model:value="modal.data.cert_content" />
          </a-form-item>
          <a-form-item label="編號格式" name="number_format">
            <a-input v-model:value="modal.data.number_format" />
          </a-form-item>
          <a-form-item label="等級" name="rank_caption">
            <a-input v-model:value="modal.data.rank_caption" />
          </a-form-item>
          <a-form-item label="簡介" name="description">
            <a-textarea v-model:value="modal.data.description" />
          </a-form-item>
          <!-- <a-form-item label="機構標誌" name="cert_logo">
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
              v-model:file-list="modal.data.cert_logo"
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
          </a-form-item> -->
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
import Icon, { RestFilled } from "@ant-design/icons-vue";
import { Inertia } from "@inertiajs/inertia";
import { message } from "ant-design-vue";
import { defineComponent, reactive } from "vue";

export default {
  components: {
    AdminLayout,
    UploadOutlined,
    RestFilled,
  },
  props: ["certificates"],
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
          title: "認證名稱",
          dataIndex: "cert_title",
        },
        {
          title: "認證機構",
          dataIndex: "cert_body",
        },
        {
          title: "認證內容",
          dataIndex: "cert_content",
        },
        {
          title: "編號格式",
          dataIndex: "number_format",
        },
        {
          title: "操作",
          dataIndex: "operation",
          key: "operation",
        },
      ],
      rules: {
        cert_title: { required: true },
        cert_body: { required: true },
        number_format: { required: true },
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
      this.modal.mode = "CREATE";
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
          this.$inertia.post(route("admin.certificates.store"), this.modal.data, {
            preserveState: false,
            onSuccess: (page) => {
              console.log(page);
              this.modal.isOpen = false;
              message.success("新增成功");
            },
            onError: (err) => {
              console.log(err);
              message.error("新增失敗");
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
            route("admin.certificates.update", this.modal.data.id),
            this.modal.data,
            {
              preserveState: false,
              onSuccess: (page) => {
                message.success("修改成功");
                this.modal.isOpen = false;
              },
              onError: (error) => {
                message.error("修改成功");
                console.log(error);
              },
            }
          );
        })
        .catch((err) => {
          console.log("error", err);
        });
    },
  },
};
</script>
