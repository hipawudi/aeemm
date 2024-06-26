<template>
  <MemberLayout :title="form.title" v-if="$page.props.user.id">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ form.title }}</h2>
    </template>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div
        class="mt-8 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
      >
        <a-form :model="formData" ref="formRef" name="default" layout="vertical">
          <div class="pb-5">
            <a-alert>
              <template #description>
                <div class="flex flex-col space-y-2">
                  <div class="text-xl font-bold">會員信息</div>
                  <div class="flex gap-3">
                    <div class="text-base font-bold">會員名稱:</div>
                    <div class="text-base">{{ $page.props.user.name }}</div>
                  </div>
                  <div class="flex gap-3">
                    <div class="text-base font-bold">會員電郵:</div>
                    <div class="text-base">{{ $page.props.user.email }}</div>
                  </div>
                </div>
              </template>
            </a-alert>
          </div>
          <div v-for="field in form.fields">
            <div v-if="field.type == 'input'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-input v-model:value="formData[field.id]" />
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'select'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-select
                  v-model:value="formData[field.id]"
                  :options="JSON.parse(field.options)"
                ></a-select>
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'radio'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-radio-group
                  v-model:value="formData[field.id]"
                  :options="JSON.parse(field.options)"
                ></a-radio-group>
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'checkbox'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-checkbox-group
                  v-model:value="formData[field.id]"
                  :options="JSON.parse(field.options)"
                ></a-checkbox-group>
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'textarea'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-textarea v-model:value="formData[field.id]" />
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'richtext'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <quill-editor
                  v-model:value="formData[field.id]"
                  style="min-height: 200px"
                />
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'date'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-date-picker
                  v-model:value="formData[field.id]"
                  :format="dateFormat"
                  :valueFormat="dateFormat"
                />
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'email'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }, { type: 'email' }]"
              >
                <a-input v-model:value="formData[field.id]" />
              </a-form-item>
            </div>
            <div v-else>
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }, { type: 'email' }]"
              >
                <p>Data type undefined</p>
              </a-form-item>
            </div>
          </div>
          <div class="text-center">
            <a-button @click="storeRecord" type="primary">提交</a-button>
          </div>
        </a-form>
      </div>
    </div>
  </MemberLayout>

  <WebLayout title="Dashboard" v-else>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">表格管理</h2>
    </template>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
      <div
        class="mt-8 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
      >
        <a-form :model="formData" ref="formRef" name="default" layout="vertical">
          <div class="pb-5" v-if="form.require_member && $page.props.user">
            <a-alert message="Login Member" type="info">
              <template #description>
                <div><strong>Member: </strong>{{ $page.props.user.name }}</div>
                <div><strong>Email: </strong>{{ $page.props.user.email }}</div>
              </template>
            </a-alert>
          </div>
          <quill-editor v-model:value="formData[field.id]" style="min-height: 200px" />
          <div v-for="field in form.fields">
            <div v-if="form.require_member">
              <a-form-item
                label="Member Id"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-input v-model:value="$page.props.user.id" />
              </a-form-item>
            </div>
            <div v-if="field.type == 'input'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-input v-model:value="formData[field.id]" />
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'select'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-select
                  v-model:value="formData[field.id]"
                  :options="JSON.parse(field.options)"
                ></a-select>
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'radio'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-radio-group
                  v-model:value="formData[field.id]"
                  :options="JSON.parse(field.options)"
                ></a-radio-group>
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'checkbox'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-checkbox-group
                  v-model:value="formData[field.id]"
                  :options="JSON.parse(field.options)"
                ></a-checkbox-group>
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'textarea'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-textarea v-model:value="formData[field.id]" />
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'richtext'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <quill-editor v-model:value="richText" style="min-height: 200px" />
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'date'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }]"
              >
                <a-date-picker
                  v-model:value="formData[field.id]"
                  :format="dateFormat"
                  :valueFormat="dateFormat"
                />
              </a-form-item>
            </div>
            <div v-else-if="field.type == 'email'">
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }, { type: 'email' }]"
              >
                <a-input v-model:value="formData[field.id]" />
              </a-form-item>
            </div>
            <div v-else>
              <a-form-item
                :label="field.field_label"
                :name="field.id"
                :rules="[{ required: field.require }, { type: 'email' }]"
              >
                <p>Data type undefined</p>
              </a-form-item>
            </div>
          </div>
          <div class="text-center pb-10">
            <a-button @click="storeRecord" type="primary">Submit</a-button>
          </div>
        </a-form>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import { quillEditor } from "vue3-quill";

export default {
  components: {
    MemberLayout,
    WebLayout,
    quillEditor,
  },
  props: ["form"],
  data() {
    return {
      formData: {},
      dateFormat: "YYYY-MM-DD",
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
  created() {},
  methods: {
    onFormChange() {
      console.log(this.formData);
    },
    storeRecord() {
      console.log(this.form);
      console.log(this.formData);
      this.$refs.formRef
        .validateFields()
        .then(() => {
          this.$inertia.post(
            route("forms.applications.store", this.form.id),
            {
              fields: this.formData,
            },
            {
              onSuccess: (page) => {
                this.formData = {};
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
  },
};
</script>

<style>
.ant-form-vertical .ant-form-item-label {
  padding: 0px !important;
}
</style>
