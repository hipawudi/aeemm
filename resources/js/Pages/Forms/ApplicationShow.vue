<template>
  <MemberLayout title="報名內容">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">報名內容</h2>
    </template>
    <div class="max-w-6xl mt-4 mx-auto">
      <div class="flex flex-col sm:flex-row gap-6">
        <div class="bg-white rounded-md shadow-md p-4 w-full mx-auto">
          <div class="flex flex-col gap-3">
            <div class="flex items-center gap-6">
              <div class="text-xl font-bold">{{ application.form.title }}</div>
              <div class="">
                <div
                  class="p-1 px-2 rounded-md border border-solid"
                  :class="
                    application.state == 1
                      ? 'text-blue-500 bg-blue-100'
                      : 'text-green-500 bg-green-100'
                  "
                >
                  {{ states.find((x) => x.value == application.state).label }}
                </div>
              </div>
            </div>
            <a-descriptions title="表格內容" bordered :column="{ xs: 1, sm: 2 }">
              <a-descriptions-item label="姓名">{{
                $page.props.user.name
              }}</a-descriptions-item>
              <a-descriptions-item label="電郵">{{
                $page.props.user.email
              }}</a-descriptions-item>
              <template v-for="f in form_fields">
                <a-descriptions-item :label="f.field_label" class="overflow-auto">{{
                  f.options
                    ? JSON.parse(f.options).find(
                        (x) =>
                          x.value ==
                          application_fields.find((x) => x.field_id == f.id)?.value
                      )?.label
                    : application_fields.find((x) => x.field_id == f.id)?.value
                }}</a-descriptions-item>
              </template>
            </a-descriptions>
            <div class="text-base font-bold">提交繳費單</div>
          </div>
        </div>
      </div>
    </div>
  </MemberLayout>
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
  props: ["application", "application_fields", "form_fields", "states"],
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
  created() {
    console.log(JSON.parse(this.form_fields[1].options)[0]);
  },
  methods: {},
};
</script>
