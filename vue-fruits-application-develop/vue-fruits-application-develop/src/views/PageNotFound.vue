<template>
  <div class="page-not-found">
    <div class="container">
      <div class="p-[20px]">
        <p>Page Not Found</p>
        <router-link :to="{ name: 'home' }" class="text-green-400">
          Back to home</router-link
        >
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
@Component({})
export default class PageNotFound extends Vue {}
</script>
