<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#basic-usage"></a>
      Basic usage
    </h2>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Affix is fixed at the top of the page by default.
    </div>
    <!--end::Block-->

    <div class="rounded border p-10">
      <el-affix :offset="120">
        <el-button type="primary">Offset top 120px</el-button>
      </el-affix>

      <CodeHighlighter lang="html">{{ code1 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import CodeHighlighter from "@/metronic/components/highlighters/CodeHighlighter.vue";
import { code1 } from "./data";

export default defineComponent({
  name: "basic-usage",
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code1
    };
  }
});
</script>
