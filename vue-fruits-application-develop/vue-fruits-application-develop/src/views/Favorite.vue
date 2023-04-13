<template>
  <!-- <div class="favorite">Favorite</div> -->
  <div class="home container flex flex-col flex-1 mt-10">
    <div
      v-if="!$store.state?.favorite?.listFavorite.length"
      class="text-[18px] text-center"
    >
      Your favorite list is empty. Add some item
      <router-link :to="{ name: 'home' }" class="text-[#347758] font-bold"
        >here!</router-link
      >
    </div>

    <div
      v-else
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
    >
      <div
        v-for="fruit in $store.state?.favorite?.listFavorite"
        :key="fruit.id"
        class="fruit-item"
      >
        <FruitItem :item="fruit" />
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
import FruitItem from '@/components/FruitItem.vue'

@Component({
  components: { FruitItem }
})
export default class Favorite extends Vue {}
</script>
