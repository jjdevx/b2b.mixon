<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h2 class="anchor fw-bolder mb-5">
      <a href="#select-any-level-of-options"></a>
      Select any level of options
    </h2>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      In single selection, only the leaf nodes can be checked, and in multiple
      selection, check parent nodes will lead to leaf nodes be checked
      eventually. When enable this feature, it can make parent and child nodes
      unlinked and you can select any level of options.
    </div>
    <!--end::Block-->

    <div class="rounded border p-10">
      <div class="block mb-5">
        <span class="demonstration" style="margin-right: 5px"
          >Select any level of options (Single selection)</span
        >
        <el-cascader
          :options="options"
          :props="{ checkStrictly: true }"
          clearable
        ></el-cascader>
      </div>
      <div class="block">
        <span class="demonstration" style="margin-right: 5px"
          >Select any level of options (Multiple selection)</span
        >
        <el-cascader
          :options="options"
          :props="{ multiple: true, checkStrictly: true }"
          clearable
        ></el-cascader>
      </div>

      <CodeHighlighter :field-height="400" lang="html">{{
        code6
      }}</CodeHighlighter>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import CodeHighlighter from "@/metronic/components/highlighters/CodeHighlighter.vue";
import { code6 } from "./data";

export default defineComponent({
  name: "select-any-lever-of-options",
  data() {
    return {
      options: [
        {
          value: "guide",
          label: "Guide",
          children: [
            {
              value: "disciplines",
              label: "Disciplines",
              children: [
                {
                  value: "consistency",
                  label: "Consistency"
                },
                {
                  value: "feedback",
                  label: "Feedback"
                },
                {
                  value: "efficiency",
                  label: "Efficiency"
                },
                {
                  value: "controllability",
                  label: "Controllability"
                }
              ]
            },
            {
              value: "navigation",
              label: "Navigation",
              children: [
                {
                  value: "side nav",
                  label: "Side Navigation"
                },
                {
                  value: "top nav",
                  label: "Top Navigation"
                }
              ]
            }
          ]
        },
        {
          value: "component",
          label: "Component",
          children: [
            {
              value: "basic",
              label: "Basic",
              children: [
                {
                  value: "layout",
                  label: "Layout"
                },
                {
                  value: "color",
                  label: "Color"
                },
                {
                  value: "typography",
                  label: "Typography"
                },
                {
                  value: "icon",
                  label: "Icon"
                },
                {
                  value: "button",
                  label: "Button"
                }
              ]
            },
            {
              value: "form",
              label: "Form",
              children: [
                {
                  value: "radio",
                  label: "Radio"
                },
                {
                  value: "checkbox",
                  label: "Checkbox"
                },
                {
                  value: "input",
                  label: "Input"
                },
                {
                  value: "input-number",
                  label: "InputNumber"
                },
                {
                  value: "select",
                  label: "Select"
                },
                {
                  value: "cascader",
                  label: "Cascader"
                },
                {
                  value: "switch",
                  label: "Switch"
                },
                {
                  value: "slider",
                  label: "Slider"
                },
                {
                  value: "time-picker",
                  label: "TimePicker"
                },
                {
                  value: "date-picker",
                  label: "DatePicker"
                },
                {
                  value: "datetime-picker",
                  label: "DateTimePicker"
                },
                {
                  value: "upload",
                  label: "Upload"
                },
                {
                  value: "rate",
                  label: "Rate"
                },
                {
                  value: "form",
                  label: "Form"
                }
              ]
            },
            {
              value: "data",
              label: "Data",
              children: [
                {
                  value: "table",
                  label: "Table"
                },
                {
                  value: "tag",
                  label: "Tag"
                },
                {
                  value: "progress",
                  label: "Progress"
                },
                {
                  value: "tree",
                  label: "Tree"
                },
                {
                  value: "pagination",
                  label: "Pagination"
                },
                {
                  value: "badge",
                  label: "Badge"
                }
              ]
            },
            {
              value: "notice",
              label: "Notice",
              children: [
                {
                  value: "alert",
                  label: "Alert"
                },
                {
                  value: "loading",
                  label: "Loading"
                },
                {
                  value: "message",
                  label: "Message"
                },
                {
                  value: "message-box",
                  label: "MessageBox"
                },
                {
                  value: "notification",
                  label: "Notification"
                }
              ]
            },
            {
              value: "navigation",
              label: "Navigation",
              children: [
                {
                  value: "menu",
                  label: "NavMenu"
                },
                {
                  value: "tabs",
                  label: "Tabs"
                },
                {
                  value: "breadcrumb",
                  label: "Breadcrumb"
                },
                {
                  value: "dropdown",
                  label: "Dropdown"
                },
                {
                  value: "steps",
                  label: "Steps"
                }
              ]
            },
            {
              value: "others",
              label: "Others",
              children: [
                {
                  value: "dialog",
                  label: "Dialog"
                },
                {
                  value: "tooltip",
                  label: "Tooltip"
                },
                {
                  value: "popover",
                  label: "Popover"
                },
                {
                  value: "card",
                  label: "Card"
                },
                {
                  value: "carousel",
                  label: "Carousel"
                },
                {
                  value: "collapse",
                  label: "Collapse"
                }
              ]
            }
          ]
        },
        {
          value: "resource",
          label: "Resource",
          children: [
            {
              value: "axure",
              label: "Axure Components"
            },
            {
              value: "sketch",
              label: "Sketch Templates"
            },
            {
              value: "docs",
              label: "Design Documentation"
            }
          ]
        }
      ]
    };
  },
  components: {
    CodeHighlighter
  },
  setup() {
    return {
      code6
    };
  }
});
</script>
