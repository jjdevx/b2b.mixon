<template>
  <!--begin::Toolbar-->
  <div class="d-flex flex-wrap flex-stack my-5">
    <!--begin::Heading-->
    <h2 class="fs-2 fw-bold my-2">
      Projects
      <span class="fs-6 text-gray-400 ms-1">by Status</span>
    </h2>
    <!--end::Heading-->

    <!--begin::Controls-->
    <div class="d-flex flex-wrap my-1">
      <!--begin::Select wrapper-->
      <div class="m-0">
        <!--begin::Select-->
        <select
          name="status"
          data-control="select2"
          data-hide-search="true"
          class="form-select form-select-white form-select-sm fw-bolder w-125px"
        >
          <option
            value="Active"
            selected
          >
            Active
          </option>
          <option value="Approved">
            In Progress
          </option>
          <option value="Declined">
            To Do
          </option>
          <option value="In Progress">
            Completed
          </option>
        </select>
        <!--end::Select-->
      </div>
      <!--end::Select wrapper-->
    </div>
    <!--end::Controls-->
  </div>
  <!--end::Toolbar-->

  <!--begin::Row-->
  <div class="row g-6 g-xl-9">
    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        :progress="50"
        title="Fitnes App"
        icon="/dist/media/svg/brand-logos/plurk.svg"
        :users="users1"
      />
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="Pending"
        status-data-badge-color="badge-light"
        :progress="30"
        icon="/dist/media/svg/brand-logos/disqus.svg"
        title="Leaf CRM"
        date="May 10, 2021"
        budget="$36,400.00"
        :users="users2"
      />
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="Completed"
        status-data-badge-color="badge-light-success"
        :progress="100"
        icon="/dist/media/svg/brand-logos/figma-1.svg"
        title="Atica Banking"
        date="Mar 14, 2021"
        budget="$605,100.00"
        :users="users3"
      />
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="Pending"
        :progress="60"
        status-data-badge-color="badge-light"
        icon="/dist/media/svg/brand-logos/sentry-3.svg"
        title="Finance Dispatch"
        budget="$36,400.00"
        :users="users4"
      />
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="In Progress"
        :progress="40"
        icon="/dist/media/svg/brand-logos/xing-icon.svg"
        title="9 Degree"
        date="May 10, 2021"
        budget="$36,400.00"
        :users="users5"
      />
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="In Progress"
        :progress="70"
        icon="/dist/media/svg/brand-logos/tvit.svg"
        title="GoPro App"
        date="May 10, 2021"
        budget="$36,400.00"
        :users="users6"
      />
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="In Progress"
        :progress="30"
        icon="/dist/media/svg/brand-logos/aven.svg"
        title="Buldozer CRM"
        date="May 10, 2021"
        budget="$36,400.00"
        :users="users7"
      />
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="Overdue"
        :progress="10"
        status-data-badge-color="badge-light-danger"
        icon="/dist/media/svg/brand-logos/treva.svg"
        title="Aviasales App"
        date="May 10, 2021"
        budget="$36,400.00"
        :users="users8"
      />
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-md-6 col-xl-4">
      <KTCard
        status="Completed"
        :progress="100"
        status-data-badge-color="badge-light-success"
        icon="/dist/media/svg/brand-logos/kanba.svg"
        title="Oppo CRM"
        date="May 10, 2021"
        budget="$36,400.00"
        :users="users9"
      />
    </div>
    <!--end::Row-->

    <!--begin::Pagination-->
    <div class="d-flex flex-stack flex-wrap pt-10">
      <div class="fs-6 fw-bold text-gray-700">
        Showing 1 to 10 of 50 entries
      </div>

      <!--begin::Pages-->
      <ul class="pagination">
        <li class="page-item previous">
          <a
            href="#"
            class="page-link"
          ><i class="previous" /></a>
        </li>

        <li class="page-item active">
          <a
            href="#"
            class="page-link"
          >1</a>
        </li>

        <li class="page-item">
          <a
            href="#"
            class="page-link"
          >2</a>
        </li>

        <li class="page-item">
          <a
            href="#"
            class="page-link"
          >3</a>
        </li>

        <li class="page-item">
          <a
            href="#"
            class="page-link"
          >4</a>
        </li>

        <li class="page-item">
          <a
            href="#"
            class="page-link"
          >5</a>
        </li>

        <li class="page-item">
          <a
            href="#"
            class="page-link"
          >6</a>
        </li>

        <li class="page-item next">
          <a
            href="#"
            class="page-link"
          ><i class="next" /></a>
        </li>
      </ul>
      <!--end::Pages-->
    </div>
    <!--end::Pagination-->
  </div>
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import KTCard from "@/metronic/components/cards/Card1.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

export default defineComponent({
  name: "Projects",
  components: {
    KTCard
  },
  setup() {
    onMounted(() => {
      setCurrentPageBreadcrumbs("Projects", ["Pages", "Profile"]);
    });

    const users1 = [
      { name: "Emma Smith", src: "/dist/media/avatars/150-1.jpg" },
      { name: "Rudy Stone", src: "/dist/media/avatars/150-2.jpg" },
      { name: "Susan Redwood", initials: "S", state: "primary" }
    ];

    const users2 = [
      { name: "Alan Warden", initials: "A", state: "warning" },
      { name: "Brian Cox", src: "/dist/media/avatars/150-4.jpg" }
    ];

    const users3 = [
      { name: "Mad Masy", src: "/dist/media/avatars/150-1.jpg" },
      { name: "Cris Willson", src: "/dist/media/avatars/150-2.jpg" },
      { name: "Mike Garcie", initials: "M", state: "info" }
    ];

    const users4 = [
      { name: "Nich Warden", initials: "N", state: "warning" },
      { name: "Rob Otto", initials: "R", state: "success" }
    ];

    const users5 = [
      { name: "Francis Mitcham", src: "/dist/media/avatars/150-5.jpg" },
      { name: "Michelle Swanston", src: "/dist/media/avatars/150-13.jpg" },
      { name: "Susan Redwood", initials: "S", state: "primary" }
    ];

    const users6 = [
      { name: "Emma Smith", src: "/dist/media/avatars/150-1.jpg" },
      { name: "Rudy Stone", src: "/dist/media/avatars/150-2.jpg" },
      { name: "Susan Redwood", initials: "S", state: "primary" }
    ];

    const users7 = [
      { name: "Meloday Macy", src: "/dist/media/avatars/150-3.jpg" },
      { name: "Rabbin Watterman", initials: "S", state: "success" }
    ];

    const users8 = [
      { name: "Emma Smith", src: "/dist/media/avatars/150-1.jpg" },
      { name: "Rudy Stone", src: "/dist/media/avatars/150-2.jpg" },
      { name: "Susan Redwood", initials: "S", state: "primary" }
    ];

    const users9 = [
      { name: "Meloday Macy", src: "/dist/media/avatars/150-3.jpg" },
      { name: "Rabbin Watterman", initials: "S", state: "danger" }
    ];

    return {
      users1,
      users2,
      users3,
      users4,
      users5,
      users6,
      users7,
      users8,
      users9
    };
  }
});
</script>
