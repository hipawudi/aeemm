<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          公告管理
        </div>
        <div class="flex-auto w-1/2 text-right">
          <a-button type="primary" class="!rounded" @click="createRecord()"
            >新增公告</a-button
          >
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <!-- {{ new Date().getFullYear() - 2009 + 1 }}
        {{ yearLength }} -->
        <a-table
          :dataSource="bulletins.data"
          :columns="columns"
          :pagination="pagination"
          @change="onPaginationChange"
          ref="dataTable"
        >
          <template #bodyCell="{ column, text, record, index }">
            <template v-if="column.key == 'published'">{{
              record.published == 1 ? "發佈" : "非發佈"
            }}</template>
            <template v-if="column.dataIndex == 'operation'">
              <div class="space-x-2">
                <a-button @click="editRecord(record)">修改</a-button>
                <a-popconfirm
                  title="是否確定刪除這個公告"
                  ok-text="是"
                  cancel-text="否"
                  @confirm="deleteRecord(record.id)"
                >
                  <a-button>刪除</a-button>
                </a-popconfirm>
              </div></template
            >
            <template v-else-if="column.dataIndex == 'category'">
              {{ bulletinCategories.find((x) => x.value == text)["label"] }}
            </template>
          </template>
        </a-table>
      </div>
      <!-- Modal Start-->
      <a-modal v-model:visible="modal.isOpen" :title="modal.title" width="60%">
        <a-form
          ref="modalRef"
          :model="modal.data"
          name="Bulletin"
          :label-col="{ span: 4 }"
          :wrapper-col="{ span: 20 }"
          autocomplete="off"
          :rules="rules"
          :validate-messages="validateMessages"
        >
          <a-form-item label="分類" name="category">
            <a-select v-model:value="modal.data.category" :options="bulletinCategories" />
          </a-form-item>
          <a-form-item label="日期" name="date">
            <a-date-picker
              v-model:value="modal.data.date"
              :format="dateFormat"
              :valueFormat="dateFormat"
            />
          </a-form-item>
          <a-form-item label="標題" name="title">
            <a-input v-model:value="modal.data.title" />
          </a-form-item>
          <a-form-item label="描述" name="description">
            <a-input v-model:value="modal.data.description" />
          </a-form-item>
          <a-form-item label="內容" name="content">
            <quill-editor v-model:value="modal.data.content" style="min-height: 200px" />
          </a-form-item>
          <a-form-item label="發佈" name="published">
            <a-switch
              v-model:checked="modal.data.published"
              :unCheckedValue="0"
              :checkedValue="1"
            />
          </a-form-item>
          <a-form-item label="封面" name="cover">
            <a-upload
              v-model:file-list="modal.data.cover"
              :multiple="false"
              :beforeUpload="openCropModal"
              :max-count="1"
              list-type="picture-card"
            >
              <div>
                <upload-outlined></upload-outlined>
                <div style="margin-top: 8px">Upload</div>
              </div>
            </a-upload>
          </a-form-item>
        </a-form>
        <template #footer>
          <a-button
            v-if="modal.mode == 'EDIT'"
            key="Update"
            type="primary"
            @click="updateRecord()"
            >Update</a-button
          >
          <a-button
            v-if="modal.mode == 'CREATE'"
            key="Store"
            type="primary"
            @click="storeRecord()"
            >Add</a-button
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
import { quillEditor } from "vue3-quill";

export default {
  components: {
    AdminLayout,
    UploadOutlined,
    RestFilled,
    quillEditor,
  },
  props: ["bulletinCategories", "bulletins"],
  data() {
    return {
      dateFormat: "YYYY-MM-DD",
      yearCurrent: 2023,
      yearStart: new Date().getFullYear() + 1,
      yearLength: new Date().getFullYear() - 2009 + 2,
      modal: {
        isOpen: false,
        data: {
          published: 1,
        },
        title: "公告",
        mode: "",
      },
      pagination: {
        total: this.bulletins.total,
        current: this.bulletins.current_page,
        pageSize: this.bulletins.per_page,
      },
      filter: {},
      columns: [
        {
          title: "標題",
          dataIndex: "title",
        },
        {
          title: "日期",
          dataIndex: "date",
        },
        {
          title: "分類",
          dataIndex: "category",
        },
        {
          title: "發佈",
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
  created() {
  },
  methods: {
    createRecord(record) {
      this.modal.data = {
        published: 1,
      };
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
          this.$inertia.post(route("admin.bulletins.store"), this.modal.data, {
            onSuccess: (page) => {
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
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.modal.data._method = "PATCH";
          this.$inertia.post(
            route("admin.bulletins.update", this.modal.data.id),
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

    deleteRecord(recordId) {
      this.$inertia.delete("/admin/bulletins/" + recordId, {
        onSuccess: (page) => {
          console.log(page);
        },
        onError: (error) => {
          alert(error.message);
        },
      });
    },
    onPaginationChange(page, filters, sorter) {
      this.$inertia.get(
        route("admin.bulletins.index"),
        {
          page: page.current,
          per_page: 5,
          filter: "namejose",
        },
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
  },
};
</script>
