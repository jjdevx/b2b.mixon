<template>
  <!--begin::Mixed Widget 6-->
  <div
    :class="widgetClasses"
    class="card"
  >
    <!--begin::Beader-->
    <div class="card-header border-0 py-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bolder fs-3 mb-1">Sales Statistics</span>

        <span class="text-muted fw-bold fs-7">Recent sales statistics</span>
      </h3>

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
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body p-0 d-flex flex-column">
      <!--begin::Stats-->
      <div class="card-px pt-5 pb-10 flex-grow-1">
        <!--begin::Row-->
        <div class="row g-0 mt-5 mb-10">
          <!--begin::Col-->
          <div class="col">
            <div class="d-flex align-items-center me-2">
              <!--begin::Symbol-->
              <div class="symbol symbol-50px me-3">
                <div class="symbol-label bg-light-info">
                  <span class="svg-icon svg-icon-1 svg-icon-info">
                    <inline-svg
                      src="/dist/media/icons/duotone/Design/Color-profile.svg"
                    />
                  </span>
                </div>
              </div>
              <!--end::Symbol-->

              <!--begin::Title-->
              <div>
                <div class="fs-4 text-dark fw-bolder">
                  $2,034
                </div>
                <div class="fs-7 text-muted fw-bold">
                  Author Sales
                </div>
              </div>
              <!--end::Title-->
            </div>
          </div>
          <!--end::Col-->

          <!--begin::Col-->
          <div class="col">
            <div class="d-flex align-items-center me-2">
              <!--begin::Symbol-->
              <div class="symbol symbol-50px me-3">
                <div class="symbol-label bg-light-danger">
                  <span class="svg-icon svg-icon-1 svg-icon-danger">
                    <inline-svg src="/dist/media/icons/duotone/Home/Library.svg" />
                  </span>
                </div>
              </div>
              <!--end::Symbol-->

              <!--begin::Title-->
              <div>
                <div class="fs-4 text-dark fw-bolder">
                  $706
                </div>
                <div class="fs-7 text-muted fw-bold">
                  Commision
                </div>
              </div>
              <!--end::Title-->
            </div>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-0">
          <!--begin::Col-->
          <div class="col">
            <div class="d-flex align-items-center me-2">
              <!--begin::Symbol-->
              <div class="symbol symbol-50px me-3">
                <div class="symbol-label bg-light-success">
                  <span class="svg-icon svg-icon-1 svg-icon-success">
                    <inline-svg src="/dist/media/icons/duotone/Shopping/Cart3.svg" />
                  </span>
                </div>
              </div>
              <!--end::Symbol-->

              <!--begin::Title-->
              <div>
                <div class="fs-4 text-dark fw-bolder">
                  $49
                </div>
                <div class="fs-7 text-muted fw-bold">
                  Average Bid
                </div>
              </div>
              <!--end::Title-->
            </div>
          </div>
          <!--end::Col-->

          <!--begin::Col-->
          <div class="col">
            <div class="d-flex align-items-center me-2">
              <!--begin::Symbol-->
              <div class="symbol symbol-50px me-3">
                <div class="symbol-label bg-light-primary">
                  <span class="svg-icon svg-icon-1 svg-icon-primary">
                    <inline-svg
                      src="/dist/media/icons/duotone/Shopping/Barcode-read.svg"
                    />
                  </span>
                </div>
              </div>
              <!--end::Symbol-->

              <!--begin::Title-->
              <div>
                <div class="fs-4 text-dark fw-bolder">
                  $5.8M
                </div>
                <div class="fs-7 text-muted fw-bold">
                  All Time Sales
                </div>
              </div>
              <!--end::Title-->
            </div>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Row-->
      </div>
      <!--end::Stats-->

      <!--begin::Chart-->
      <apexchart
        class="mixed-widget-6-chart card-rounded-bottom"
        :options="chartOptions"
        :series="series"
        :height="chartHeight"
        type="area"
      />
      <!--end::Chart-->
    </div>
    <!--end::Body-->
  </div>
  <!--end::Mixed Widget 6-->
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import Dropdown1 from "@/metronic/components/dropdown/Dropdown1.vue";
import { getCSSVariableValue } from "@/metronic/assets/ts/_utils";

export default defineComponent({
  name: "Widget1",
  components: {
    Dropdown1
  },
  props: {
    widgetClasses: String,
    chartColor: String,
    chartHeight: String
  },
  setup(props) {
    const color = ref(props.chartColor);

    const labelColor = getCSSVariableValue("--bs-" + "gray-800");
    const strokeColor = getCSSVariableValue("--bs-" + "gray-300");
    const baseColor = getCSSVariableValue(`--bs-${  color.value}`);
    const lightColor = getCSSVariableValue(`--bs-light-${  color.value}`);

    const chartOptions = {
      chart: {
        fontFamily: "inherit",
        type: "area",
        height: props.chartHeight,
        toolbar: {
          show: false
        },
        zoom: {
          enabled: false
        },
        sparkline: {
          enabled: true
        }
      },
      plotOptions: {},
      legend: {
        show: false
      },
      dataLabels: {
        enabled: false
      },
      fill: {
        type: "solid",
        opacity: 1
      },
      stroke: {
        curve: "smooth",
        show: true,
        width: 3,
        colors: [baseColor]
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
          show: false,
          style: {
            colors: labelColor,
            fontSize: "12px"
          }
        },
        crosshairs: {
          show: false,
          position: "front",
          stroke: {
            color: strokeColor,
            width: 1,
            dashArray: 3
          }
        },
        tooltip: {
          enabled: false
        }
      },
      yaxis: {
        min: 0,
        max: 60,
        labels: {
          show: false,
          style: {
            colors: labelColor,
            fontSize: "12px"
          }
        }
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
      colors: [lightColor],
      markers: {
        colors: [lightColor],
        strokeColor: [baseColor],
        strokeWidth: 3
      }
    };

    const series = [
      {
        name: "Net Profit",
        data: [30, 25, 45, 30, 55, 55]
      }
    ];

    return {
      series,
      chartOptions
    };
  }
});
</script>
