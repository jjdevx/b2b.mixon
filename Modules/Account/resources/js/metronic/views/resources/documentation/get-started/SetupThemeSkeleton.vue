<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <!--begin::Section-->
      <div class="py-5">
        <!--begin::Heading-->
        <h1
          id="setup_skeleton"
          class="anchor fw-bolder mb-5"
        >
          <router-link to="#setup_skeleton" />
          Setup skeleton
        </h1>
        <!--end::Heading-->

        <!--begin::Block-->
        <div class="py-5">
          To get started with theme skeleton you should change router path to
          new path for clean router file, which is already added inside
          <code>src/router</code> folder. Change router path inside file main.js
          to the following path:
        </div>
        <!--end::Block-->

        <div class="pb-5">
          <CodeHighlighter lang="javascript">
            {{
              `import router from "@/router/clean.ts";`
            }}
          </CodeHighlighter>
        </div>

        <!--begin::Block-->
        <div class="py-5">
          Second thing what you need to change is our menus, in Metronic 8 we
          have two types of menu in header and aside bar.
        </div>
        <!--end::Block-->

        <div class="py-5">
          <!--begin::Information-->
          <div
            class="d-flex align-items-center rounded py-5 px-5 bg-light-info"
          >
            <span class="svg-icon svg-icon-3x svg-icon-info me-5">
              <inline-svg src="/dist/media/icons/duotone/Code/Info-circle.svg" />
            </span>
            <div class="text-gray-600 fw-bold fs-5">
              Main menu is generated from the file
              <code>src/core/config/MainMenuConfig.ts</code>. Header menu is
              generated inside
              <code>src/layout/header/Menu.vue</code>
              and the aside menu is generated inside
              <code>src/layout/aside/Menu.vue</code>.
            </div>
            <!--end::Description-->
          </div>
          <!--end::Information-->
        </div>

        <div class="py-5">
          To get started with clean menu, you can update menu config path in
          both <code>Menu.vue</code> files from
          <code>src/core/config/MainMenuConfig.ts</code>
          to the following code:
        </div>

        <div class="pb-5">
          <CodeHighlighter lang="javascript">
            {{
              `import MainMenuConfig from "@/core/config/CleanMainMenuConfig";`
            }}
          </CodeHighlighter>
        </div>

        <!--begin::Block-->
        <div class="py-5">
          Now you can delete unneeded page view files from folder
          <code>src/views</code>
        </div>
        <!--end::Block-->
      </div>
      <!--end::Section-->

      <!--begin::Section-->
      <div class="py-5">
        <!--begin::Heading-->
        <h1
          id="setup_api"
          class="anchor fw-bolder mb-5"
        >
          <router-link to="#setup_api" />
          Setup API
        </h1>
        <!--end::Heading-->

        <!--begin::Block-->
        <div class="py-5">
          In theme we are using axios-adapter to make http requests. In the real
          app requests will be send to real server api so you can remove
          MockService initialization from the file <code>main.ts</code>.
        </div>
        <!--end::Block-->

        <div class="pb-5">
          <CodeHighlighter lang="javascript">
            {{
              `MockAdapter.init(app);`
            }}
          </CodeHighlighter>
        </div>

        <!--begin::Block-->
        <div class="py-5">
          And change baseURL property of axios to your api url in file
          <code>src/core/services/ApiService.ts</code>.
        </div>
        <!--end::Block-->

        <div class="pb-5">
          <CodeHighlighter lang="javascript">
            {{
              `ApiService.vueInstance.axios.defaults.baseURL = "http://your-url";`
            }}
          </CodeHighlighter>
        </div>
      </div>
      <!--end::Section-->
    </div>
    <!--end::Card Body-->
  </div>
  <!--begin::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import CodeHighlighter from "@/metronic/components/highlighters/CodeHighlighter.vue";
import { setCurrentPageTitle } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "SetupThemeSkeleton",
  components: {
    CodeHighlighter
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Setup theme skeleton");
    });
  }
});
</script>
