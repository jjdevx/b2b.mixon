<template>
  <!--begin::Charts Widget 1-->
  <div
    class="card"
    :class="widgetClasses"
  >
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
      <!--begin::Title-->
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bolder fs-3 mb-1">Recent Statistics</span>

        <span class="text-muted fw-bold fs-7">More than 400 new members</span>
      </h3>
      <!--end::Title-->

      <!--begin::Toolbar-->
      <div class="card-toolbar">
        <!--begin::Menu-->
        <button
          type="button"
          class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
          data-kt-menu-trigger="click"
          data-kt-menu-placement="bottom-end"
          data-kt-menu-flip="top-end"
        >
          <span class="svg-icon svg-icon-2">
            <inline-svg
              src="/dist/media/icons/duotone/Layout/Layout-4-blocks-2.svg"
            />
          </span>
        </button>
        <Dropdown1 />
        <!--end::Menu-->
      </div>
      <!--end::Toolbar-->
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body">
      <!--begin::Chart-->
      <apexchart
        type="bar"
        :options="options"
        :series="series"
      />
      <!--end::Chart-->
    </div>
    <!--end::Body-->
  </div>
  <!--end::Charts Widget 1-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { getCSSVariableValue } from "@/metronic/assets/ts/_utils";
import Dropdown1 from "@/metronic/components/dropdown/Dropdown1.vue";

export default defineComponent({
  name: "Widget1",
  components: {
    Dropdown1
  },
  props: {
    widgetClasses: String
  },
  setup() {
    const labelColor = getCSSVariableValue("--bs-gray-500");
    const borderColor = getCSSVariableValue("--bs-gray-200");
    const baseColor = getCSSVariableValue("--bs-primary");
    const secondaryColor = getCSSVariableValue("--bs-gray-300");

    const options = {
      chart: {
        fontFamily: "inherit",
        type: "bar",
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: ["30%"],
          endingShape: "rounded"
        }
      },
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ["transparent"]
      },
      xaxis: {
        categories: ["Feb", "Mar", "Apr", "May", "Jun", "Jul"],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: "12px"
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: "12px"
          }
        }
      },
      fill: {
        opacity: 1
      },
      states: {
        normal: {
          filter: {
            type: "none",
            value: 0
          }
        },
        hover: {
          filter: {
            type: "none",
            value: 0
          }
        },
        active: {
          allowMultipleDataPointsSelection: false,
          filter: {
            type: "none",
            value: 0
          }
        }
      },
      tooltip: {
        style: {
          fontSize: "12px"
        },
        y: {
          formatter(val) {
            return `$${  val  } thousands`;
          }
        }
      },
      colors: [baseColor, secondaryColor],
      grid: {
        borderColor,
        strokeDashArray: 4,
        yaxis: {
          lines: {
            show: true
          }
        }
      }
    };

    const series = [
      {
        name: "Net Profit",
        data: [44, 55, 57, 56, 61, 58]
      },
      {
        name: "Revenue",
        data: [76, 85, 101, 98, 87, 105]
      }
    ];

    return {
      options,
      series
    };
  }
});
</script>
