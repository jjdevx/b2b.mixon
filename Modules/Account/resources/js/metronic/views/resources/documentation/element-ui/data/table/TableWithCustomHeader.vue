<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#table-with-custom-header"></a>
      Table with custom header
    </h2>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Customize table header so it can be even more customized.
    </div>
    <!--end::Block-->

    <div class="rounded border p-10">
      <el-table
        :data="
          tableData.filter(
            data =>
              !search || data.name.toLowerCase().includes(search.toLowerCase())
          )
        "
        style="width: 100%"
      >
        <el-table-column label="Date" prop="date"> </el-table-column>
        <el-table-column label="Name" prop="name"> </el-table-column>
        <el-table-column align="right">
          <template #header>
            <el-input
              v-model="search"
              size="mini"
              placeholder="Type to search"
            />
          </template>
          <template #default="scope">
            <el-button size="mini" @click="handleEdit(scope.$index, scope.row)"
              >Edit</el-button
            >
            <el-button
              size="mini"
              type="danger"
              @click="handleDelete(scope.$index, scope.row)"
              >Delete</el-button
            >
          </template>
        </el-table-column>
      </el-table>

      <CodeHighlighter :field-height="400" lang="html">{{
        code15
      }}</CodeHighlighter>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import CodeHighlighter from "@/metronic/components/highlighters/CodeHighlighter.vue";
import { code15 } from "./data";

export default defineComponent({
  name: "table-with-custom-header",
  data() {
    return {
      tableData: [
        {
          date: "2016-05-03",
          name: "Tom",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          date: "2016-05-02",
          name: "John",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          date: "2016-05-04",
          name: "Morgan",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          date: "2016-05-01",
          name: "Jessy",
          address: "No. 189, Grove St, Los Angeles"
        }
      ],
      search: ""
    };
  },
  methods: {
    handleEdit(index, row) {
      console.log(index, row);
    },
    handleDelete(index, row) {
      console.log(index, row);
    }
  },
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code15
    };
  }
});
</script>
