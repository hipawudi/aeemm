<template>
  <MemberLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">專業認證</h2>
    </template>

    <div class="py-12 h-full">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-3">
          <template v-for="professional in professionals" :key="professional.id">
            <div class="bg-white rounded-md w-1/3 flex-initial p-4">
              <div class="flex flex-col gap-3">
                <div class="text-lg font-bold">
                  {{ professional.certificate.cert_title }}
                </div>
                <div class="">
                  {{ professional.certificate.cert_content }}
                </div>
                <div class="text-gray-500">
                  {{ professional.certificate.cert_body }}
                </div>
              </div>
            </div>
          </template>
        </div>
      </div>
    </div>
  </MemberLayout>
</template>

<script>
import MemberLayout from "@/Layouts/MemberLayout.vue";

export default {
  components: {
    MemberLayout,
  },
  props: ["member", "professionals"],
  data() {
    return {
      title: "",
      card: {},
    };
  },
  created() {},
  methods: {},
};
</script>
