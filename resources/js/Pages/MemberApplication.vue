<template>
  <WebLayout title="會員申請">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">會員申請</h2>
    </template>
    <div class="max-w-6xl mx-auto p-4">
      <div class="rounded-md bg-white shadow-md p-12">
        <div v-if="!member_application">
          <div class="font-bold text-2xl mb-4">會員申請表</div>
          <a-form
            ref="modalRef"
            :model="data"
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
                    ><a-input v-model:value="data.name_zh"></a-input
                  ></a-form-item>
                </div>
                <div class="flex-auto w-1/4">
                  <a-form-item label="性別" name="gender"
                    ><a-select :options="gender" v-model:value="data.gender"></a-select
                  ></a-form-item>
                </div>
              </div>
              <a-form-item label="英文姓名" name="name_en"
                ><a-input v-model:value="data.name_en"></a-input
              ></a-form-item>
              <a-form-item label="出生日期" name="birth"
                ><a-date-picker
                  v-model:value="data.birth"
                  valueFormat="YYYY-MM-DD"
                ></a-date-picker
              ></a-form-item>
              <a-form-item label="通迅地址" name="address"
                ><a-input v-model:value="data.address"></a-input
              ></a-form-item>
              <a-form-item label="聯絡電話" name="phone"
                ><a-input v-model:value="data.phone"></a-input
              ></a-form-item>
              <a-form-item label="電子郵箱" name="email">
                <a-input v-model:value="data.email"></a-input>
              </a-form-item>
              <a-form-item label="工作機構" name="company"
                ><a-input v-model:value="data.company"></a-input
              ></a-form-item>
              <a-form-item label="職位" name="position"
                ><a-input v-model:value="data.position"></a-input
              ></a-form-item>
              <a-form-item label="申請會籍" name="membership_level"
                ><a-select
                  :options="membership_levels"
                  v-model:value="data.membership_level"
                ></a-select
              ></a-form-item>
            </div>
            <div class="flex justify-end">
              <a-button type="primary" @click="storeRecord">提交</a-button>
            </div>
          </a-form>
        </div>
        <div v-else>
          <div class="text-center font-bold text-3xl">你已提交申請</div>
        </div>
      </div>
    </div>
  </WebLayout>
</template>

<script>
import WebLayout from "@/Layouts/WebLayout.vue";
import { message } from "ant-design-vue";
import dayjs from "dayjs";

export default {
  components: {
    WebLayout,
    dayjs,
  },
  props: ["member_application", "gender", "membership_levels"],
  setup() {},
  data() {
    return {
      data: {},
      labelCol: { style: { width: "100px" } },
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
    };
  },
  methods: {
    storeRecord() {
      this.$refs.modalRef
        .validateFields()
        .then(() => {
          this.$inertia.post(route("member.application.store"), this.data, {
            onSuccess: (page) => {
              message.success("提交成功");
              this.data = {};
              console.log(page);
            },
            onError: (err) => {
              console.log(err);
              message.error("提交失敗");
            },
          });
        })
        .catch((err) => {
          console.log(err);
          message.error("提交失敗");
        });
    },
  },
};
</script>
