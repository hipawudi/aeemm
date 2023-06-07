<script setup>
//import { defineProps } from "vue";

defineProps({
  title: String,
  card: Object,
});
</script>

<template>
  <div class="flex justify-center">
    <div class="pt-4 w-xl">
      <div class="absolute z-50 flex flex-col p-4 text-white font-serif">
        <div class="flex-auto">名字:</div>
      </div>
      <img
        class="relative object-cover w-full h-full rounded-lg z-0"
        :src="card.face"
        width="10px"
      />
    </div>
  </div>
  <!-- <div class="md:grid md:grid-cols-3 py-5 md:gap-6">
    <div class="mt-5 md:mt-0 md:col-span-2">
      <div
        class="w-96 h-56 m-auto bg-red-100 rounded-lg relative text-white shadow-2xl transition-transform transform hover:scale-110"
      >
        <img
          class="relative object-cover w-full h-full rounded-lg"
          :src="card.face"
          width="10px"
        />
        <div class="absolute w-full text-center text-lg" style="top: 1em">
          {{ card.cert_title }}
        </div>
        <div class="w-full px-8 absolute top-8">
          <div class="flex justify-between">
            <div class="">
              <p class="font-light">Name</p>
              <p p class="font-medium tracking-widest">{{}}</p>
            </div>
            <img class="w-14 h-14" src="images/aeemm_logo.jpg" />
          </div>
          <div class="grid grid-cols-2 gap-2">
            <div class="pt-1">
              <p class="font-light">編號</p>
              <p class="font-medium tracking-more-wider">
                {{ card }}
              </p>
            </div>
            <div class="pt-1">
              <p class="font-light">
                {{ card.rank_caption }}
              </p>
              <p class="font-medium tracking-more-wider">{{}}</p>
            </div>
          </div>

          <div class="pt-6 pr-6">
            <div class="flex justify-between">
              <div class="">
                <p class="font-light text-xs">Valid</p>
                <p class="font-medium tracking-wider text-sm">
                  {{ card }}
                </p>
              </div>
              <div class="">
                <p class="font-light text-xs">Expiry</p>
                <p class="font-medium tracking-wider text-sm">
                  {{ card }}
                </p>
              </div>

              <div class="">
                <p class="font-light text-xs">CVV</p>
                <p class="font-bold tracking-more-wider text-sm">···</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</template>

<style>
p {
  margin-bottom: 0;
}
</style>
