<template>
  <component :is="$route.meta.layout || 'div'">
    <router-view />
  </component>
</template>

<script lang="ts">
import { Component, Vue } from 'vue-property-decorator'
@Component({})
export default class App extends Vue {}
</script>
