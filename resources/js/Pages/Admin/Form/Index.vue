<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          表格管理
        </div>
        <div class="flex-auto w-1/2 text-right">
          <a-button type="primary" class="!rounded" @click="createRecord()"
            >新增表格</a-button
          >
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-table :dataSource="forms" :columns="columns">
          <template #bodyCell="{ column, text, record, index }">
            <template v-if="column.key === 'published'">
              {{ record.published === 1 ? "公開" : "未公開" }}
            </template>
            <template v-if="column.key === 'for_course'">
              {{ record.course_id !== null ? "是" : "否" }}
            </template>
            <template v-if="column.key === 'for_member'">
              {{ record.for_member === 1 ? "是" : "否" }}
            </template>
            <template v-if="column.key === 'for_account'">
              {{ record.require_login === 1 ? "是" : "否" }}
            </template>
            <template v-if="column.dataIndex == 'operation'">
              <div class="space-x-2">
                <inertia-link
                  :href="route('admin.forms.fields.index', { form: record.id })"
                  class="ant-btn"
                  >資料欄位</inertia-link
                >
                <a-button @click="editRecord(record)">修改</a-button>
                <a-popconfirm
                  title="是否確定刪除這個表格"
                  ok-text="是"
                  cancel-text="否"
                  @confirm="deleteRecord(record)"
                >
                  <a-button>刪除</a-button>
                </a-popconfirm>
              </div>
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
          :label-col="{ span: 6 }"
          :wrapper-col="{ span: 18 }"
          autocomplete="off"
          :rules="rules"
          :validate-messages="validateMessages"
        >
          <a-form-item label="標題" name="title">
            <a-input v-model:value="modal.data.title" />
          </a-form-item>
          <a-form-item label="描述" name="description">
            <a-textarea v-model:value="modal.data.description" />
          </a-form-item>
          <a-form-item label="必須登錄" name="for_account">
            <a-switch
              v-model:checked="modal.data.for_account"
              :unCheckedValue="0"
              :checkedValue="1"
            />
          </a-form-item>
          <a-form-item label="必須會員" name="for_member">
            <a-switch
              v-model:checked="modal.data.for_member"
              :unCheckedValue="0"
              :checkedValue="1"
            />
          </a-form-item>
          <a-form-item label="公開" name="published">
            <a-switch
              v-model:checked="modal.data.published"
              :unCheckedValue="0"
              :checkedValue="1"
            />
          </a-form-item>
          <!-- <a-form-item label="橫幅" name="cert_logo">
            <div v-if="modal.data?.media?.length">
              <inertia-link
                :href="route('admin.form-delete-media', modal.data.media[0].id)"
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
              v-model:file-list="modal.data.image"
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
          <a-button key="back" @click="modal.isOpen = false">取消</a-button>
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
import { message } from "ant-design-vue";
import Icon, { RestFilled } from "@ant-design/icons-vue";

export default {
  components: {
    AdminLayout,
    UploadOutlined,
    RestFilled,
  },
  props: ["forms"],
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
          title: "標題",
          dataIndex: "title",
        },
        {
          title: "課程表格",
          dataIndex: "course_id",
          key: "for_course",
        },
        {
          title: "必須登錄",
          dataIndex: "for_account",
          key: "for_account",
        },
        {
          title: "必須會員",
          dataIndex: "for_member",
          key: "for_member",
        },
        {
          title: "公開",
          dataIndex: "published",
          key: "published",
        },
        {
          title: "操作",
          dataIndex: "operation",
          key: "operation",
        },
      ],
      rules: {
        name: { required: true },
        title: { required: true },
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
    createRecord(record) {
      this.modalDataReset();
      this.modal.data.media = [];
      this.modal.mode = "CREATE";
      this.modal.isOpen = true;
    },
    editRecord(record) {
      this.modal.data = { ...record };
      this.modal.mode = "EDIT";
      this.modal.isOpen = true;
    },
    storeRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("admin.forms.store"), this.modal.data, {
            onSuccess: (page) => {
              this.modal.data = {};
              this.modal.isOpen = false;
              message.success("新增成功");
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
      console.log(this.modal.data);
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.modal.data._method = "PATCH";
          this.$inertia.post(
            route("admin.forms.update", this.modal.data.id),
            this.modal.data,
            {
              onSuccess: (page) => {
                this.modal.isOpen = false;
                message.success("修改成功");
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
    modalDataReset() {
      this.modal.data = {
        name: "",
        title: "",
        desctiption: "",
        for_account: 0,
        for_member: 0,
        published: 0,
      };
    },
    deleteRecord(record) {
      this.$inertia.delete(route("admin.forms.destroy", { form: record.id }), {
        onSuccess: (page) => {
          message.success("刪除成功");
        },
        onError: (error) => {
          message.error(error.message);
        },
      });
    },
  },
};
</script>
