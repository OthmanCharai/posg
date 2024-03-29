<script setup lang="ts">
import { Form, Field } from "vee-validate";
import { useAxios, route } from "@/src/utils/axios-helper";
import { useRouter } from "vue-router";
import { getErrorMessage, hasError } from "@utils/error-handler";
import { store } from '@store/index';
import { Toast } from "@utils/toast";

const authStore = store.auth();
const { request, loading, response } = useAxios();
const router = useRouter();
const showPassword = ref(false);

// Methods
const toggleShow = () => {
  showPassword.value = !showPassword.value;
};

const data = ref({
  email: '',
  password: '',
})

const onSubmit = async() => {
  await request({
    method: 'POST',
    url: route('auth.login.submit'),
    data: data.value
  })

  if (response.value && response.value.data) {
    // we need to add Cookie here
    authStore.authenticated = true;
    Toast.success('Login success');
    router.push({name: 'Dashboard'});
  }
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
            </div>
            <Form @submit="onSubmit">
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
                      v-model="data.email"
                      class="form-control"
                      :class="{ 'is-invalid': hasError('email') }"
                    />
                    <div class="invalid-feedback">
                      {{ getErrorMessage('email') }}
                    </div>
                  </div>
                </div>
                <div class="form-login">
                  <label>Password</label>
                  <div class="pass-group">
                    <Field
                      name="password"
                      :type="showPassword ? 'text' : 'password'"
                      v-model="data.password"
                      class="form-control pass-input mt-2"
                      :class="{ 'is-invalid': hasError('password') }"
                    />
                    <span @click="toggleShow" class="toggle-password">
                      <i
                        :class="{
                          'fas fa-eye': showPassword,
                          'fas fa-eye-slash': !showPassword,
                        }"
                      ></i>
                    </span>
                    <div class="invalid-feedback">
                      {{ getErrorMessage('password') }}
                    </div>
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
                      <router-link class="forgot-link" to="/forgot-password-3">
                        Forgot Password?
                      </router-link>
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
              Copyright &copy; {{ new Date().getFullYear() }} DreamsPOS. All rights reserved
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
