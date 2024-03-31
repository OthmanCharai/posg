<script setup lang="ts">
import { Form, Field } from "vee-validate";
import { useAxios, route } from "@/src/utils/axios-helper";
import { useRouter } from "vue-router";
import { getErrorMessage, hasError } from "@utils/error-handler";
import { useAuthStore } from '@stores/auth';
import { Toast } from "@utils/toast";

const authStore = useAuthStore();
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
    authStore.isLogin.loggedIn = true;
    Toast.success('Connexion effectuée avec succès.');
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
              <img src="@/src/assets/img/logo/logo-login.png" alt="logo" />
            </div>
            <Form @submit="onSubmit">
              <div class="login-userset">
                <div class="login-userheading">
                  <h3>Se connecter</h3>
                  <h4>
                    Connectez-vous au tableau de bord avec votre e-mail et code d'accès.
                  </h4>
                </div>
                <div class="form-login">
                  <label class="form-label">Adresse e-mail</label>
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
                    <vue-feather type="mail" size="16" :class="{'hide-icon': hasError('email')}"></vue-feather>
                  </div>
                </div>
                <div class="form-login">
                  <label>Mot de passe</label>
                  <div class="pass-group">
                    <Field
                      name="password"
                      :type="showPassword ? 'text' : 'password'"
                      v-model="data.password"
                      class="form-control pass-input mt-2"
                      :class="{ 'is-invalid': hasError('password') }"
                    />
                    <span @click="toggleShow" class="toggle-password">
                      <vue-feather v-if="showPassword" type="eye" size="16" :class="{'hide-icon': hasError('passowrd')}"></vue-feather>
                      <vue-feather v-else type="eye-off" size="16" :class="{'hide-icon': hasError('password')}"></vue-feather>
                    </span>
                    <div class="invalid-feedback">
                      {{ getErrorMessage('password') }}
                    </div>
                  </div>
                </div>
                <div class="form-login authentication-check">
                  <div class="row align-items-center">
                    <div class="col-6">
                      <div class="custom-control custom-checkbox">
                        <label class="checkboxs ps-4 mb-0 pb-0 line-height-1">
                          <input type="checkbox" />
                          <span class="checkmarks"></span>Se souvenir de moi
                        </label>
                      </div>
                    </div>
                    <div class="col-6 text-end">
                      <router-link class="forgot-link" to="/forgot-password-3">
                        Mot de passe oublié ?
                      </router-link>
                    </div>
                  </div>
                </div>
                <div class="form-login">
                  <button :disabled="loading" class="btn btn-login" type="submit">Se connecter</button>
                </div>
              </div>
            </Form>
          </div>
          <div
            class="my-4 d-flex justify-content-center align-items-center copyright-text"
          >
            <p>
              Droit d'auteur &copy; {{ new Date().getFullYear() }} Piston Gabon. Tous droits réservés.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.hide-icon {
  display: none;
}
</style>
