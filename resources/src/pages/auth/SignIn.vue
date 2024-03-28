<script setup lang="ts">
import { Form, Field } from "vee-validate";
import * as Yup from "yup";
import { ref } from "vue";
import { useAxios } from "@/src/utils/axios-helper";
import {  useRouter } from "vue-router";

// vars
const { request, response, loading, errorMessage } = useAxios()
const router=useRouter();
const showPassword = ref(false);
const password = ref(null);
const email=ref(null);


// Methods
const toggleShow = () => {
  showPassword.value = !showPassword.value;
};

const schema = Yup.object().shape({
  email: Yup.string().required("Email is required").email("Email is invalid"),
  password: Yup.string()
    .min(6, "Password must be at least 6 characters")
    .required("Password is required"),
});

const onSubmit = async() => {
  await request({
    method: 'POST',
    url: route('auth.login.submit'),
    data: {
      email: email.value,
      password: password.value,
      password_confirmation: password.value
    }
  })
  router.push('/admins')
};
</script>

<template>
  <div class="account-page">
    <div class="account-content">
      <div class="login-wrapper login-new">
        <div class="container">
          <div class="login-content user-login">
            <div class="login-logo">
              <img src="" alt="img" />
              <router-link to="/dashboard" class="login-logo logo-white">
                <img src="" alt="" />
              </router-link>
            </div>
            <Form
              @submit="onSubmit"
              :validation-schema="schema"
              v-slot="{ errors }"
            >
              <div class="login-userset">
                <div class="login-userheading">
                  <h3>Sign In</h3>
                  <h4>
                    Access the Dreamspos panel using your email and passcode.
                  </h4>
                </div>
                <div class="form-login">
                  <label class="form-label">Email Address</label>
                  <div class="form-addons">
                    <Field
                      name="email"
                      type="text"
                      v-model:model-value="email"
                      class="form-control"
                      :class="{ 'is-invalid': errors.email }"
                    />
                    <div class="invalid-feedback">{{ errors.email }}</div>
                    <div class="emailshow text-danger" id="email"></div>
                    <img src="" alt="img" />
                  </div>
                </div>
                <div class="form-login">
                  <label>Password</label>
                  <div class="pass-group">
                    <Field
                      name="password"
                      :type="showPassword ? 'text' : 'password'"
                      v-model:model-value="password"
                      class="form-control pass-input mt-2"
                      :class="{ 'is-invalid': errors.password }"
                    />
                    <span @click="toggleShow" class="toggle-password">
                      <i
                        :class="{
                          'fas fa-eye': showPassword,
                          'fas fa-eye-slash': !showPassword,
                        }"
                      ></i>
                    </span>
                    <div class="invalid-feedback">{{ errors.password }}</div>
                    <div class="emailshow text-danger" id="password"></div>
                  </div>
                </div>
                <div class="form-login authentication-check">
                  <div class="row">
                    <div class="col-6">
                      <div class="custom-control custom-checkbox">
                        <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>Remember me
                        </label>
                      </div>
                    </div>
                    <div class="col-6 text-end">
                      <router-link class="forgot-link" to="/forgot-password-3"
                        >Forgot Password?</router-link
                      >
                    </div>
                  </div>
                </div>
                <div class="form-login">
                  <button :disabled="loading" class="btn btn-login" type="submit">Sign In</button>
                </div>
              </div>
            </Form>
          </div>
          <div
            class="my-4 d-flex justify-content-center align-items-center copyright-text"
          >
            <p>
              Copyright &copy; {{ new Date().getFullYear() }} DreamsPOS. All
              rights reserved
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
