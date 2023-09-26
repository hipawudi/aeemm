<template>
  <AdminLayout title="Dashboard">
    <div class="p-8 pt-8">
      <div class="flex pb-2">
        <div
          class="flex-auto w-1/2 font-semibold text-xl text-gray-800 truncate whitespace-nowrap"
        >
          電郵發送
        </div>
      </div>
      <div class="card drop-shadow-md pt-4 bg-white p-6 rounded-lg">
        <a-form :model="email_log" ref="modalRef">
          <a-form-item label="會員" name="member">
            <a-select
              v-model:value="email_log.member"
              :options="members"
              :filter-option="filterOption"
              mode="multiple"
              :field-names="{ label: 'name_zh', value: 'id' }"
            ></a-select>
          </a-form-item>
          <a-form-item label="標題" name="title">
            <a-input v-model:value="email_log.title"></a-input>
          </a-form-item>
          <a-form-item label="內容" name="content">
            <a-textarea v-model:value="email_log.content" auto-size></a-textarea>
          </a-form-item>
        </a-form>
        <div class="flex justify-end">
          <a-button type="primary" @click="sendEmail">發送</a-button>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { message } from "ant-design-vue";

export default {
  components: {
    AdminLayout,
  },
  props: ["members"],
  data() {
    return {
      email_log: {},
    };
  },
  created() {},
  methods: {
    sendEmail() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("admin.emails.store"), this.email_log, {
            preserveState: false,
            preserveScroll: true,
            resetOnSuccess: false,
            onSuccess: (page) => {
              console.log(page);
              message.success("發送成功");
            },
            onError: (error) => {
              console.log(error);
              message.error(error.message);
            },
          });
        })
        .catch((err) => {
          this.loading = false;
          console.log(err);
        });
    },
    filterOption(input, option) {
      return option.name_zh.toLowerCase().indexOf(input.toLowerCase()) >= 0;
    },
  },
};
</script>
