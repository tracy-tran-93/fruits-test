<template>
  <div class="pt-[38%] relative">
      <div class="absolute top-0 left-0 w-full h-full">
        <img
          src="@/assets/images/banner.jpg"
          alt="Banner"
          class="w-full max-h-full object-cover"
        />
      </div>
    </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'

@Component({
  components: {}
})
export default class Banner extends Vue {}
</script>
