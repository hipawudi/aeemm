<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          表格欄位管理
        </div>
        <div class="flex-auto w-1/2 text-right">
          <a-button type="primary" class="!rounded" @click="createRecord()"
            >新增資料欄位</a-button
          >
        </div>
      </div>
      <div class="card drop-shadow-md pt-4">
        <a-table :dataSource="fields" :columns="columns">
          <template #bodyCell="{ column, text, record, index }">
            <template v-if="column.dataIndex == 'operation'">
              <div class="space-x-2">
                <a-button @click="editRecord(record)">修改</a-button>
                <a-popconfirm
                  title="是否確定刪除這個欄位"
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
          :label-col="{ span: 4 }"
          :wrapper-col="{ span: 20 }"
          autocomplete="off"
          :rules="rules"
          :validate-messages="validateMessages"
        >
          <a-form-item label="名稱" name="field_name">
            <a-input v-model:value="modal.data.field_name" />
          </a-form-item>
          <a-form-item label="標簽" name="field_label">
            <a-input v-model:value="modal.data.field_label" />
          </a-form-item>
          <a-form-item label="類型" name="type">
            <a-select
              v-model:value="modal.data.type"
              placeholder="欄位類型"
              :options="fieldTypes"
            />
          </a-form-item>
          <!-- {{ fieldTypes }} -->
          <div v-if="fieldTypes.find((f) => f.value == this.modal.data.type)?.option">
            <a-form-item label="Options" name="options">
              <ol>
                <li v-for="(option, idx) in modal.data.options">
                  {{ option.value }}: {{ option.label }}
                  <a @click="deleteOptionItem(idx)">X</a>
                </li>
              </ol>
            </a-form-item>
            <a-form-item label="Add">
              <table>
                <tr>
                  <td><a-input v-model:value="optionInput.value" /></td>
                  <td><a-input v-model:value="optionInput.label" /></td>
                  <td><a-button type="primary" @click="addOptionItem">Add</a-button></td>
                </tr>
              </table>
            </a-form-item>
          </div>
          <a-form-item label="必填" name="require">
            <a-switch
              v-model:checked="modal.data.require"
              :unCheckedValue="0"
              :checkedValue="1"
            />
          </a-form-item>
          <!-- <a-form-item label="規則" name="rule">
                <a-input v-model:value="modal.data.rule" />
            </a-form-item>
            <a-form-item label="驗證" name="validate">
                <a-input v-model:value="modal.data.validate" />
            </a-form-item> -->
          <a-form-item label="備注" name="remark">
            <a-textarea v-model:value="modal.data.remark" />
          </a-form-item>
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
import { message } from "ant-design-vue";
import { defineComponent, reactive } from "vue";

export default {
  components: {
    AdminLayout,
  },
  props: ["form", "fields"],
  data() {
    return {
      optionInput: {},
      modal: {
        isOpen: false,
        data: {},
        title: "Modal",
        mode: "",
      },
      fieldTypes: [
        { value: "input", label: "單行文字", option: false },
        { value: "textarea", label: "多行文字", option: false },
        { value: "largetext", label: "大篇幅文字", option: false },
        { value: "radio", label: "單選", option: true },
        { value: "checkbox", label: "多選", option: true },
        { value: "true_false", label: "是/否", option: false },
        { value: "date", label: "日期", option: false },
        { value: "datetime", label: "日期時間", option: false },
        { value: "email", label: "電郵", option: false },
        { value: "number", label: "數值", option: false },
        { value: "richtext", label: "富文本格式", option: false },
        { value: "select", label: "下拉單", option: true },
      ],
      columns: [
        {
          title: "名稱",
          dataIndex: "field_name",
        },
        {
          title: "標簽",
          dataIndex: "field_label",
        },
        {
          title: "類型",
          dataIndex: "type",
        },
        {
          title: "必填",
          dataIndex: "required",
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
        form_id: this.form.id,
        options: [],
        require: 0,
      };
      this.modal.mode = "CREATE";
      this.modal.isOpen = true;
    },
    editRecord(record) {
      this.modal.data = { ...record };
      this.modal.data.options = JSON.parse(this.modal.data.options) ?? [];
      this.modal.mode = "EDIT";
      this.modal.isOpen = true;
    },
    storeRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(
            route("admin.forms.fields.store", {
              form: this.form.id,
            }),
            this.modal.data,
            {
              onSuccess: (page) => {
                this.modal.data = {};
                this.modal.isOpen = false;
                message.success("新增成功");
              },
              onError: (err) => {
                console.log(err);
              },
            }
          );
        })
        .catch((err) => {
          console.log(err);
        });
    },
    updateRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.patch(
            route("admin.forms.fields.update", {
              form: this.form.id,
              field: this.modal.data,
            }),
            this.modal.data,
            {
              onSuccess: (page) => {
                this.modal.data = {};
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
    deleteRecord(record) {
      this.$inertia.delete(
        route("admin.forms.fields.destroy", {
          form: this.form.id,
          field: record.id,
        }),
        {
          onSuccess: (page) => {
            message.success("刪除成功");
          },
          onError: (error) => {
            alert(error.message);
          },
        }
      );
    },
    addOptionItem() {
      console.log(this.modal.data);
      this.modal.data.options.push({
        value: this.optionInput.value,
        label: this.optionInput.label,
      });
      console.log(this.modal.data.options);
    },
    deleteOptionItem(idx) {
      this.modal.data.options.splice(idx, 1);
      console.log(this.modal.data.options);
    },
  },
};
</script>
