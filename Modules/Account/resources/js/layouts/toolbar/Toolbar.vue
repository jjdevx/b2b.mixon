<template>
  <div id="kt_toolbar" class="toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
      <div class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
        <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">
          {{ title }}
        </h1>
        <span v-if="breadcrumbs" class="h-20px border-gray-200 border-start mx-4" />
        <ul v-if="breadcrumbs" class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
          <li class="breadcrumb-item pe-3">
            <InertiaLink href="/" class="text-muted text-hover-primary"> Home </InertiaLink>
          </li>
          <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px" />
          </li>
          <template v-for="(item, index) in breadcrumbs" :key="index">
            <li class="breadcrumb-item text-muted">
              {{ item }}
            </li>
            <li class="breadcrumb-item">
              <span class="bullet bg-gray-200 w-5px h-2px" />
            </li>
          </template>
          <li class="breadcrumb-item pe-3 text-dark">
            {{ title }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  props: {
    breadcrumbs: { type: Array, required: true },
    title: { type: String, required: true },
  },
})
</script>
