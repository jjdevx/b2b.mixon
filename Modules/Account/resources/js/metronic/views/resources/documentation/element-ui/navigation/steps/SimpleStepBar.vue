<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#simple-step-bar"></a>
      Simple step bar
    </h2>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Simple step bars, where <code>align-center</code>,
      <code>description</code>, <code>direction</code> and
      <code>space</code> will be ignored.
    </div>
    <!--end::Block-->

    <div class="rounded border p-10">
      <el-steps :space="200" :active="1" simple>
        <el-step title="Step 1" icon="el-icon-edit"></el-step>
        <el-step title="Step 2" icon="el-icon-upload"></el-step>
        <el-step title="Step 3" icon="el-icon-picture"></el-step>
      </el-steps>

      <el-steps
        :active="1"
        finish-status="success"
        simple
        style="margin-top: 20px"
      >
        <el-step title="Step 1"></el-step>
        <el-step title="Step 2"></el-step>
        <el-step title="Step 3"></el-step>
      </el-steps>

      <CodeHighlighter lang="html">{{ code7 }}</CodeHighlighter>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import CodeHighlighter from "@/metronic/components/highlighters/CodeHighlighter.vue";
import { code7 } from "./data";

export default defineComponent({
  name: "simple-step-bar",
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code7
    };
  }
});
</script>
