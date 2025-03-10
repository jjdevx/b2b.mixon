<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card body-->
    <div class="card-body">
      <!--begin::Stepper-->
      <div
        id="kt_create_account_stepper"
        ref="horizontalWizardRef"
        class="stepper stepper-links d-flex flex-column"
      >
        <!--begin::Nav-->
        <div class="stepper-nav py-5 mt-5">
          <!--begin::Step 1-->
          <div
            class="stepper-item current"
            data-kt-stepper-element="nav"
          >
            <h3 class="stepper-title">
              Account Type
            </h3>
          </div>
          <!--end::Step 1-->

          <!--begin::Step 2-->
          <div
            class="stepper-item"
            data-kt-stepper-element="nav"
          >
            <h3 class="stepper-title">
              Account Info
            </h3>
          </div>
          <!--end::Step 2-->

          <!--begin::Step 3-->
          <div
            class="stepper-item"
            data-kt-stepper-element="nav"
          >
            <h3 class="stepper-title">
              Business Info
            </h3>
          </div>
          <!--end::Step 3-->

          <!--begin::Step 4-->
          <div
            class="stepper-item"
            data-kt-stepper-element="nav"
          >
            <h3 class="stepper-title">
              Billing Details
            </h3>
          </div>
          <!--end::Step 4-->

          <!--begin::Step 5-->
          <div
            class="stepper-item"
            data-kt-stepper-element="nav"
          >
            <h3 class="stepper-title">
              Completed
            </h3>
          </div>
          <!--end::Step 5-->
        </div>
        <!--end::Nav-->

        <!--begin::Form-->
        <form
          id="kt_create_account_form"
          class="mx-auto mw-600px w-100 pt-15 pb-10"
          novalidate="novalidate"
          @submit="handleStep"
        >
          <!--begin::Step 1-->
          <div
            class="current"
            data-kt-stepper-element="content"
          >
            <Step1 />
          </div>
          <!--end::Step 1-->

          <!--begin::Step 2-->
          <div data-kt-stepper-element="content">
            <Step2 />
          </div>
          <!--end::Step 2-->

          <!--begin::Step 3-->
          <div data-kt-stepper-element="content">
            <Step3 />
          </div>
          <!--end::Step 3-->

          <!--begin::Step 4-->
          <div data-kt-stepper-element="content">
            <Step4 />
          </div>
          <!--end::Step 4-->

          <!--begin::Step 5-->
          <div data-kt-stepper-element="content">
            <Step5 />
          </div>
          <!--end::Step 5-->

          <!--begin::Actions-->
          <div class="d-flex flex-stack pt-15">
            <!--begin::Wrapper-->
            <div class="mr-2">
              <button
                type="button"
                class="btn btn-lg btn-light-primary me-3"
                data-kt-stepper-action="previous"
                @click="previousStep"
              >
                <span class="svg-icon svg-icon-4 me-1">
                  <inline-svg src="/dist/media/icons/duotone/Navigation/Left-2.svg" />
                </span>
                Back
              </button>
            </div>
            <!--end::Wrapper-->

            <!--begin::Wrapper-->
            <div>
              <button
                v-if="currentStepIndex === totalSteps - 1"
                type="button"
                class="btn btn-lg btn-primary me-3"
                data-kt-stepper-action="submit"
                @click="formSubmit()"
              >
                <span class="indicator-label">
                  Submit
                  <span class="svg-icon svg-icon-3 ms-2 me-0">
                    <inline-svg
                      src="/dist/media/icons/duotone/Navigation/Right-2.svg"
                    />
                  </span>
                </span>
                <span class="indicator-progress">
                  Please wait...
                  <span
                    class="spinner-border spinner-border-sm align-middle ms-2"
                  />
                </span>
              </button>

              <button
                v-else
                type="submit"
                class="btn btn-lg btn-primary"
              >
                Continue
                <span class="svg-icon svg-icon-4 ms-1 me-0">
                  <inline-svg
                    src="/dist/media/icons/duotone/Navigation/Right-2.svg"
                  />
                </span>
              </button>
            </div>
            <!--end::Wrapper-->
          </div>
          <!--end::Actions-->
        </form>
        <!--end::Form-->
      </div>
      <!--end::Stepper-->
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, ref } from "vue";
import { StepperComponent } from "@/metronic/assets/ts/components";
import { useForm } from "vee-validate";
import Swal from "sweetalert2/dist/sweetalert2.min.js";
import * as Yup from "yup";
import Step1 from "@/metronic/views/pages/wizards/steps/Step1.vue";
import Step2 from "@/metronic/views/pages/wizards/steps/Step2.vue";
import Step3 from "@/metronic/views/pages/wizards/steps/Step3.vue";
import Step4 from "@/metronic/views/pages/wizards/steps/Step4.vue";
import Step5 from "@/metronic/views/pages/wizards/steps/Step5.vue";
import { setCurrentPageBreadcrumbs } from "@/metronic/core/helpers/breadcrumb";

interface Step1 {
  accountType: string;
}

interface Step2 {
  accountTeamSize: string;
  accountName: string;
  accountPlan: string;
}

interface Step3 {
  businessName: string;
  businessDescriptor: string;
  businessType: string;
  businessDescription: string;
  businessEmail: string;
}

interface Step4 {
  nameOnCard: string;
  cardNumber: string;
  cardExpiryMonth: string;
  cardExpiryYear: string;
  cardCvv: string;
  saveCard: string;
}

interface CreateAccount extends Step1, Step2, Step3, Step4 {}

export default defineComponent({
  name: "KtHorizontalWizard",
  components: {
    Step1,
    Step2,
    Step3,
    Step4,
    Step5
  },
  setup() {
    const _stepperObj = ref<StepperComponent | null>(null);
    const horizontalWizardRef = ref<HTMLElement | null>(null);
    const currentStepIndex = ref(0);

    const formData = ref<CreateAccount>({
      accountType: "personal",
      accountTeamSize: "50+",
      accountName: "",
      accountPlan: "1",
      businessName: "Keenthemes Inc.",
      businessDescriptor: "KEENTHEMES",
      businessType: "1",
      businessDescription: "",
      businessEmail: "corp@support.com",
      nameOnCard: "Max Doe",
      cardNumber: "4111 1111 1111 1111",
      cardExpiryMonth: "1",
      cardExpiryYear: "2",
      cardCvv: "123",
      saveCard: "1"
    });

    onMounted(() => {
      _stepperObj.value = StepperComponent.createInsance(
        horizontalWizardRef.value as HTMLElement
      );

      setCurrentPageBreadcrumbs("Horizontal", ["Pages", "Wizards"]);
    });

    const createAccountSchema = [
      Yup.object({
        accountType: Yup.string()
          .required()
          .label("Account Type")
      }),
      Yup.object({
        accountName: Yup.string()
          .required()
          .label("Account Name")
      }),
      Yup.object({
        businessName: Yup.string()
          .required()
          .label("Business Name"),
        businessDescriptor: Yup.string()
          .required()
          .label("Shortened Descriptor"),
        businessType: Yup.string()
          .required()
          .label("Corporation Type"),
        businessEmail: Yup.string()
          .required()
          .label("Contact Email")
      }),
      Yup.object({
        nameOnCard: Yup.string()
          .required()
          .label("Name On Card"),
        cardNumber: Yup.string()
          .required()
          .label("Card Number"),
        cardExpiryMonth: Yup.string()
          .required()
          .label("Expiration Month"),
        cardExpiryYear: Yup.string()
          .required()
          .label("Expiration Year"),
        cardCvv: Yup.string()
          .required()
          .label("CVV")
      })
    ];

    const currentSchema = computed(() => {
      return createAccountSchema[currentStepIndex.value];
    });

    const { resetForm, handleSubmit } = useForm<Step1 | Step2 | Step3 | Step4>({
      validationSchema: currentSchema
    });

    const totalSteps = computed(() => {
      if (!_stepperObj.value) {
        return;
      }

      return _stepperObj.value.totatStepsNumber;
    });

    resetForm({
      values: {
        ...formData.value
      }
    });

    const handleStep = handleSubmit(values => {
      console.log(values);

      formData.value = {
        ...formData.value,
        ...values
      };

      currentStepIndex.value++;

      if (!_stepperObj.value) {
        return;
      }

      _stepperObj.value.goNext();
    });

    const previousStep = () => {
      if (!_stepperObj.value) {
        return;
      }

      currentStepIndex.value--;

      _stepperObj.value.goPrev();
    };

    const formSubmit = () => {
      Swal.fire({
        text: "All is cool! Now you submit this form",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Ok, got it!",
        customClass: {
          confirmButton: "btn fw-bold btn-light-primary"
        }
      }).then(() => {
        window.location.reload();
      });
    };

    return {
      horizontalWizardRef,
      previousStep,
      handleStep,
      formSubmit,
      totalSteps,
      currentStepIndex
    };
  }
});
</script>
