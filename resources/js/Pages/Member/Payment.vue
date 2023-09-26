<template>
  <MemberLayout title="會費單列表" class="overflow-hidden">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">會費單列表</h2>
    </template>
    <div class="flex flex-col sm:flex-row relative">
      <div class="sm:w-48 sticky top-[7.2rem] z-10" v-if="left">
        <div
          class="text-sm sm:text-lg flex flex-row sm:flex-col p-2 sm:pt-6 bg-white gap-3 z-40 sm:w-48 sm:fixed h-full"
        >
          <div class="text-center flex-auto sm:flex-none">
            <a
              :class="category == 'all' ? 'text-blue' : 'text-black'"
              @click="searchPayment('all')"
              >所有會費單</a
            >
          </div>
          <div class="text-center flex-auto sm:flex-none">
            <a
              :class="category == 'wait' ? 'text-blue' : 'text-black'"
              @click="searchPayment('wait')"
              >待交會費單</a
            >
          </div>
          <div class="text-center flex-auto sm:flex-none">
            <a
              :class="category == 'paymented' ? 'text-blue' : 'text-black'"
              @click="searchPayment('paymented')"
              >待處理會費單</a
            >
          </div>
          <div class="text-center flex-auto sm:flex-none">
            <a
              :class="category == 'result' ? 'text-blue' : 'text-black'"
              @click="searchPayment('result')"
              >已交及逾期會費單</a
            >
          </div>
        </div>
      </div>
      <div
        class="flex-none flex justify-center -mt-2 sm:h-[50vh] sticky"
        :class="left ? 'top-[9rem]' : 'top-[6.75rem]'"
      >
        <div
          class="bg-white w-10 h-12 rounded-r-full flex justify-center items-center sticky sm:top-[50vh] sm:-left-2 rotate-90 sm:rotate-0 text-center"
        >
          <a v-if="left" @click="closeLeft()"
            ><img
              src="/images/icons/right.png"
              class="w-6 h-6 hover:scale-105 rotate-180"
          /></a>
          <a v-if="!left" @click="openLeft()"
            ><img src="/images/icons/right.png" class="w-6 h-6 hover:scale-105"
          /></a>
        </div>
      </div>
      <div class="flex-auto sm:mx-auto max-w-6xl pt-2" v-if="payments.total">
        <template v-for="p in payments.data" :key="p.id">
          <div
            class="w-full m-2 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg"
          >
            <div class="flex flex-col md:flex-row gap-3">
              <div class="flex items-center gap-3 md:w-1/3">
                <div class="flex-auto md:flex-none text-lg font-bold">{{ p.title }}</div>
                <div class="">
                  <div
                    class="p-1 px-2 rounded-md border border-solid"
                    :class="
                      p.state == 4
                        ? 'text-blue-500 bg-blue-100'
                        : p.state == 3
                        ? 'text-red-500 bg-red-100'
                        : 'text-green-500 bg-green-100'
                    "
                  >
                    {{ payment_states.find((x) => x.value == p.state).label }}
                  </div>
                </div>
              </div>
              <div class="flex flex-auto items-center text-base md:w-1/4 truncate">
                {{ p.reamrk }}
              </div>
              <div
                class="flex flex-auto items-center font-bold gap-3 text-lg md:text-base xs:text-lg"
              >
                <div>繳費時間:</div>
                <div>{{ p.end_date }}前</div>
              </div>
              <div class="flex items-center justify-end gap-3">
                <div>
                  <a-button
                    type="primary"
                    ghost
                    shape="round"
                    @click="openPayment(p, '查看會費單')"
                    >查看會費單</a-button
                  >
                </div>
                <div>
                  <a-button
                    v-if="p.state == 0"
                    :type="p.state == 1 ? 'primary' : ''"
                    shape="round"
                    @click="openPayment(p, '提交會費單')"
                    >提交會費單</a-button
                  >
                </div>
              </div>
            </div>
          </div>
        </template>
        <div class="my-6 text-right">
          <a-pagination
            v-model:current="payments.current_page"
            :total="payments.total"
            :page-size="payments.per_page"
            :page-size-options="pageSizeOptions"
            @change="changePage"
          />
        </div>
      </div>
      <div
        class="flex-auto mx-auto max-w-6xl pt-2 flex items-center justify-center"
        v-else
      >
        <a-empty
          image="https://gw.alipayobjects.com/mdn/miniapp_social/afts/img/A*pevERLJC9v0AAAAAAAAAAABjAQAAAQ/original"
          :image-style="{
            height: '200px',
          }"
        >
          <template #description>
            <div class="text-xl">沒有會費單</div>
          </template>
        </a-empty>
      </div>
    </div>
  </MemberLayout>
  <a-modal v-model:visible="modal.isOpen" width="60%" :title="modal.title">
    <div class="flex flex-col gap-3">
      <div v-if="modal.title == '查看會費單'">
        <a-descriptions title="會費單" bordered>
          <a-descriptions-item label="標題">{{ modal.data.title }}</a-descriptions-item>
          <a-descriptions-item label="繳費開始日期">{{
            modal.data.start_date
          }}</a-descriptions-item>
          <a-descriptions-item label="繳費結束日期">{{
            modal.data.end_date
          }}</a-descriptions-item>
          <a-descriptions-item label="會費">{{ modal.data.cost }}</a-descriptions-item>
          <a-descriptions-item label="會費折扣(%)">{{
            modal.data.cost_percentage
          }}</a-descriptions-item>
          <a-descriptions-item label="總會費">{{
            (modal.data.cost * (modal.data.cost_percentage ?? 100)) / 100
          }}</a-descriptions-item>
          <a-descriptions-item label="備註" :span="2">
            {{ modal.data.remark }}
          </a-descriptions-item>
          <a-descriptions-item label="狀態">
            {{ payment_states.find((x) => x.value == modal.data.state).label }}
          </a-descriptions-item>
          <a-descriptions-item label="會費單">
            <a :href="modal.data.url" v-if="modal.data.url" target="_blank"
              ><img :src="modal.data.url" class="h-64 w-64"
            /></a>
          </a-descriptions-item>
        </a-descriptions>
      </div>
      <a-upload
        v-model:file-list="modal.payment"
        :multiple="false"
        :beforeUpload="() => false"
        :max-count="1"
        list-type="picture-card"
        v-if="modal.title == '提交會費單'"
      >
        <a-button>
          <upload-outlined></upload-outlined>
          上傳
        </a-button>
      </a-upload>
    </div>
    <template #footer>
      <a-button @click="modal.isOpen = false">關閉</a-button>
      <a-button
        type="primary"
        @click="uploadPaymentImage(modal.data.id)"
        v-if="modal.title == '提交會費單'"
        >上傳</a-button
      >
    </template>
  </a-modal>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";
import WebLayout from "@/Layouts/WebLayout.vue";
import { UploadOutlined } from "@ant-design/icons-vue";
import { message } from "ant-design-vue";

export default {
  components: {
    MemberLayout,
    WebLayout,
    UploadOutlined,
  },
  props: ["payments", "payment_states", "category"],
  data() {
    return {
      modal: {
        isOpen: false,
        data: {
          title: "",
          payment: "",
        },
        title: "公告",
        mode: "",
      },
      left: true,
      columns: [
        {
          title: "報名表名稱",
          dataIndex: "form_id",
        },
        {
          title: "狀態",
          dataIndex: "state",
        },
        {
          title: "備註",
          dataIndex: "remark",
          width: "45%",
        },
        {
          title: "操作",
          dataIndex: "operation",
          key: "operation",
        },
      ],
      pageSizeOptions: ["10", "20", "30", "40"],
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
    openPayment(data, title) {
      console.log(data);
      this.modal.isOpen = true;
      this.modal.title = title;
      this.modal.data = data;
    },
    searchPayment(category) {
      console.log(this.payments);
      this.$inertia.get(
        route("payments.index"),
        { category: category ?? this.category },
        {
          preserveScroll: true,
          preserveState: true,
          onSuccess: (visit) => {
            console.log(this.courses);
            this.loading = false;
          },
          onError: (error) => {
            this.loading = false;
          },
        }
      );
    },
    changePage(page, pageSize) {
      this.$inertia.get(
        route("payments.index"),
        { payments: this.payments, page: page, per_page: pageSize },
        {
          preserveScroll: false,
          preserveState: false,
          onSuccess: (visit) => {
            this.loading = false;
          },
          onError: (error) => {
            this.loading = false;
          },
        }
      );
    },
    uploadPaymentImage(payment_id) {
      this.$inertia.post(
        route("payments.uploadPaymentImage", payment_id),
        {
          payment: this.modal.payment,
        },
        {
          onSuccess: (page) => {
            this.modal.isOpen = false;
            message.success("上傳成功");
          },
          onError: (error) => {
            message.error(error.message);
          },
        }
      );
    },
    closeLeft() {
      this.left = false;
    },
    openLeft() {
      this.left = true;
    },
  },
};
</script>
