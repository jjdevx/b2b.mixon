<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#how-to-trigger"></a>
      How to trigger
    </h2>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Click the triggering element or hover on it.
    </div>
    <!--end::Block-->

    <div class="rounded border p-10">
      <el-row class="block-col-2">
        <el-col :span="8">
          <span class="demonstration">hover to trigger</span>
          <el-dropdown>
            <span class="el-dropdown-link">
              Dropdown List<i class="el-icon-arrow-down el-icon--right"></i>
            </span>
            <template #dropdown>
              <el-dropdown-menu>
                <el-dropdown-item icon="el-icon-plus"
                  >Action 1</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-plus"
                  >Action 2</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-plus-outline"
                  >Action 3</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-check"
                  >Action 4</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-check"
                  >Action 5</el-dropdown-item
                >
              </el-dropdown-menu>
            </template>
          </el-dropdown>
        </el-col>
        <el-col :span="8">
          <span class="demonstration">click to trigger</span>
          <el-dropdown trigger="click">
            <span class="el-dropdown-link">
              Dropdown List<i class="el-icon-arrow-down el-icon--right"></i>
            </span>
            <template #dropdown>
              <el-dropdown-menu>
                <el-dropdown-item icon="el-icon-plus"
                  >Action 1</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-plus"
                  >Action 2</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-plus-outline"
                  >Action 3</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-check"
                  >Action 4</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-check"
                  >Action 5</el-dropdown-item
                >
              </el-dropdown-menu>
            </template>
          </el-dropdown>
        </el-col>
        <el-col :span="8">
          <span class="demonstration">right click to trigger</span>
          <el-dropdown trigger="contextmenu">
            <span class="el-dropdown-link">
              Dropdown List<i class="el-icon-arrow-down el-icon--right"></i>
            </span>
            <template #dropdown>
              <el-dropdown-menu>
                <el-dropdown-item icon="el-icon-plus"
                  >Action 1</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-plus"
                  >Action 2</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-plus-outline"
                  >Action 3</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-check"
                  >Action 4</el-dropdown-item
                >
                <el-dropdown-item icon="el-icon-circle-check"
                  >Action 5</el-dropdown-item
                >
              </el-dropdown-menu>
            </template>
          </el-dropdown>
        </el-col>
      </el-row>

      <CodeHighlighter :field-height="400" lang="html">{{
        code3
      }}</CodeHighlighter>
    </div>
  </div>
</template>

<style>
.el-dropdown-link {
  cursor: pointer;
  color: #409eff;
}
.el-icon-arrow-down {
  font-size: 12px;
}
.demonstration {
  display: block;
  color: #8492a6;
  font-size: 14px;
  margin-bottom: 20px;
}
</style>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/metronic/components/highlighters/CodeHighlighter.vue";
import { code3 } from "./data";

export default defineComponent({
  name: "how-to-trigger",
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code3
    };
  }
});
</script>
