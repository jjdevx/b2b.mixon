<template>
  <div
    class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
    style="background-image: url('/dist/media/illustrations/progress-hd.png')"
  >
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
      <!--begin::Logo-->
      <a
        href="#"
        class="mb-12"
      >
        <img
          alt="Logo"
          src="/dist/media/logos/logo-2-dark.svg"
          class="h-45px"
        >
      </a>
      <!--end::Logo-->

      <!--begin::Wrapper-->
      <div class="w-lg-500px bg-white rounded shadow-sm p-10 p-lg-15 mx-auto">
        <!--begin::Form-->
        <Form
          id="kt_login_password_reset_form"
          class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework"
          :validation-schema="forgotPassword"
          @submit="onSubmitForgotPassword"
        >
          <!--begin::Heading-->
          <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
              Forgot Password ?
            </h1>
            <!--end::Title-->

            <!--begin::Link-->
            <div class="text-gray-400 fw-bold fs-4">
              Enter your email to reset your password.
            </div>
            <!--end::Link-->
          </div>
          <!--begin::Heading-->

          <!--begin::Input group-->
          <div class="fv-row mb-10">
            <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
            <Field
              class="form-control form-control-solid"
              type="email"
              placeholder=""
              name="email"
              autocomplete="off"
            />
            <div class="fv-plugins-message-container">
              <div class="fv-help-block">
                <ErrorMessage name="email" />
              </div>
            </div>
          </div>
          <!--end::Input group-->

          <!--begin::Actions-->
          <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button
              id="kt_password_reset_submit"
              ref="submitButton"
              type="submit"
              class="btn btn-lg btn-primary fw-bolder me-4"
            >
              <span class="indicator-label">
                Submit
              </span>
              <span class="indicator-progress">
                Please wait...
                <span
                  class="spinner-border spinner-border-sm align-middle ms-2"
                />
              </span>
            </button>

            <router-link
              to="/sign-up"
              class="btn btn-lg btn-light-primary fw-bolder"
            >
              Cancel
            </router-link>
          </div>
          <!--end::Actions-->
        </Form>
        <!--end::Form-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Content-->

    <!--begin::Footer-->
    <div class="d-flex flex-center flex-column-auto p-10">
      <!--begin::Links-->
      <div class="d-flex align-items-center fw-bold fs-6">
        <a
          href="#"
          class="text-muted text-hover-primary px-2"
        >About</a>

        <a
          href="#"
          class="text-muted text-hover-primary px-2"
        >Contact</a>

        <a
          href="#"
          class="text-muted text-hover-primary px-2"
        >Contact Us</a>
      </div>
      <!--end::Links-->
    </div>
    <!--end::Footer-->
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import { ErrorMessage, Field, Form } from "vee-validate";
import { useStore } from "vuex";
import { useRouter } from "vue-router";
import * as Yup from "yup";
import { Actions } from "@/store/enums/StoreEnums";
import Swal from "sweetalert2/dist/sweetalert2.min.js";

export default defineComponent({
  name: "PasswordReset",
  components: {
    Field,
    Form,
    ErrorMessage
  },
  setup() {
    const store = useStore();
    const router = useRouter();

    const submitButton = ref<HTMLElement | null>(null);

    //Create form validation object
    const forgotPassword = Yup.object().shape({
      email: Yup.string()
        .email()
        .required()
        .label("Email")
    });

    //Form submit function
    const onSubmitForgotPassword = values => {
      // Activate loading indicator
      submitButton.value?.setAttribute("data-kt-indicator", "on");

      // dummy delay
      setTimeout(() => {
        // Send login request
        store
          .dispatch(Actions.FORGOT_PASSWORD, values)
          .then(() => {
            Swal.fire({
              text: "All is cool! Now you submit this form",
              icon: "success",
              buttonsStyling: false,
              confirmButtonText: "Ok, got it!",
              customClass: {
                confirmButton: "btn fw-bold btn-light-primary"
              }
            }).then(function() {
              // Go to page after successfully login
              router.push({ name: "dashboard" });
            });
          })
          .catch(() => {
            // Alert then login failed
            Swal.fire({
              text: store.getters.getErrors[0],
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Try again!",
              customClass: {
                confirmButton: "btn fw-bold btn-light-danger"
              }
            });
          });

        submitButton.value?.removeAttribute("data-kt-indicator");
      }, 2000);
    };

    return {
      onSubmitForgotPassword,
      forgotPassword,
      submitButton
    };
  }
});
</script>
