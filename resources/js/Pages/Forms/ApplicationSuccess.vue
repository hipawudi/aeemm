<template>
  <div class="h-screen w-screen flex justify-center items-center">
    <div class="bg-white rounded-md shadow-md p-4">
      <div class="flex flex-col gap-3">
        <div class="text-xl font-bold">恭喜您,已成功報名</div>
        <div class="text-lg text-gray-600">三秒後將自動回到課程頁面</div>
        <inertia-link :href="route('courses.index')">
          <a class="text-blue-500">如果沒有回到課程頁面,請點擊這裏</a>
        </inertia-link>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  created() {
    setTimeout(() => {
      this.$inertia.get(
        route("courses.index"),
        {},
        {
          onSuccess(page) {
            console.log(page);
          },
          onError(err) {
            console.log(err);
          },
        }
      );
    }, 3000);
  },
};
</script>
