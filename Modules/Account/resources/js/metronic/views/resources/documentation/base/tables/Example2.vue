<template>
  <!--begin::Section-->
  <div class="py-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5" id="cell-spacing">
      <a href="#cell-spacing"></a>
      Cell Spacing
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      To control cell paddings easily
      <a
        href="https://getbootstrap.com/docs/5.0/layout/gutters/"
        class="fw-bolder me-1"
        >Bootstrap Gutters</a
      >
      classes <code>.g-*</code>&nbsp;, <code>.gy-*</code>&nbsp; and
      <code>.gx-*</code>&nbsp; can be used. Use <code>.gs-*</code> to set
      padding left to the first cell and padding right to the last cell in the
      row.
    </div>
    <!--end::Block-->

    <!--begin::Block-->
    <div class="my-5">
      <table class="table gs-7 gy-7 gx-7">
        <thead>
          <tr class="fw-bold fs-5 text-gray-800 border-bottom border-gray-200">
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td>$320,800</td>
          </tr>
          <tr>
            <td>Garrett Winters</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>63</td>
            <td>2011/07/25</td>
            <td>$170,750</td>
          </tr>
          <tr>
            <td>Ashton Cox</td>
            <td>Junior Technical Author</td>
            <td>San Francisco</td>
            <td>66</td>
            <td>2009/01/12</td>
            <td>$86,000</td>
          </tr>
          <tr>
            <td>Cedric Kelly</td>
            <td>Senior Javascript Developer</td>
            <td>Edinburgh</td>
            <td>22</td>
            <td>2012/03/29</td>
            <td>$433,060</td>
          </tr>
          <tr>
            <td>Airi Satou</td>
            <td>Accountant</td>
            <td>Tokyo</td>
            <td>33</td>
            <td>2008/11/28</td>
            <td>$162,700</td>
          </tr>
          <tr>
            <td>Brielle Williamson</td>
            <td>Integration Specialist</td>
            <td>New York</td>
            <td>61</td>
            <td>2012/12/02</td>
            <td>$372,000</td>
          </tr>
          <tr>
            <td>Herrod Chandler</td>
            <td>Sales Assistant</td>
            <td>San Francisco</td>
            <td>59</td>
            <td>2012/08/06</td>
            <td>$137,500</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--end::Block-->

    <!--begin::Code-->
    <div class="py-5">
      <CodeHighlighter :code="code" lang="html"
        >{{`
        <table class="table gs-7 gy-7 gx-7">
          <thead>
            <tr
              class="fw-bold fs-5 text-gray-800 border-bottom border-gray-200"
            >
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
              <th>Salary</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Tiger Nixon</td>
              <td>System Architect</td>
              <td>Edinburgh</td>
              <td>61</td>
              <td>2011/04/25</td>
              <td>$320,800</td>
            </tr>
            <tr>
              <td>Garrett Winters</td>
              <td>Accountant</td>
              <td>Tokyo</td>
              <td>63</td>
              <td>2011/07/25</td>
              <td>$170,750</td>
            </tr>
          </tbody>
        </table>
        `}}</CodeHighlighter
      >
    </div>
    <!--end::Code-->
  </div>
  <!--end::Section-->
</template>

<script lang="ts">
import { defineComponent } from "vue";
import CodeHighlighter from "@/metronic/components/highlighters/CodeHighlighter.vue";

export default defineComponent({
  name: "example-2",
  components: {
    CodeHighlighter
  }
});
</script>
