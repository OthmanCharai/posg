<script setup lang="ts">
  import { useAxios, route } from '@/src/utils/axios-helper';
  import { useRouter } from 'vue-router';
  import { getErrorMessage, isError, clearError } from '@utils/error-handler';
  import { useAuthStore } from '@stores/auth.store';
  import { Toast } from '@utils/toast';
  import { LoadingOutlined } from '@ant-design/icons-vue';

  const authStore = useAuthStore();
  const { request, loading, response } = useAxios();
  const router = useRouter();

  const data = ref({
    email: '',
    password: '',
  });

  const checked = ref(false);

  const onSubmit = async () => {
    await request({
      method: 'POST',
      url: route('auth.login.submit'),
      data: data.value,
    });

    if (response.value && response.value.data) {
      await authStore.getUser();

      Toast.success('Connexion effectuée avec succès.');
      router.push({ name: 'Dashboard' });
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
            <a-form layout="vertical" @submit="onSubmit">
              <div class="login-userset">
                <div class="login-userheading">
                  <h3>Se connecter</h3>
                  <h4>
                    Connectez-vous au tableau de bord avec votre e-mail et code d'accès.
                  </h4>
                </div>
                <div class="mb-4">
                  <a-form-item
                    label="Address e-mail"
                    :validate-status="isError('email')"
                    :help="getErrorMessage('email')"
                  >
                    <a-input
                      size="large"
                      type="email"
                      v-model:value="data.email"
                      @change="clearError('email')"
                    >
                      <template #suffix>
                        <vue-feather type="mail" stroke="#8c8c8c" size="16"></vue-feather>
                      </template>
                    </a-input>
                  </a-form-item>
                </div>
                <div class="mb-4">
                  <a-form-item
                    label="Mot de passe"
                    :validate-status="isError('password')"
                    :help="getErrorMessage('password')"
                  >
                    <a-input-password
                      size="large"
                      v-model:value="data.password"
                      @change="clearError('password')"
                    />
                  </a-form-item>
                </div>
                <div class="form-login flex justify-between">
                  <a-checkbox class="max-w-max" v-model:checked="checked"
                    >Se souvenir de moi</a-checkbox
                  >
                  <div class="">
                    <router-link class="forgot-link" to="/forgot-password-3">
                      Mot de passe oublié ?
                    </router-link>
                  </div>
                </div>
                <div>
                  <a-button size="large" type="primary" htmlType="submit">
                    <template v-if="loading" #icon><LoadingOutlined /></template>
                    <span v-if="loading === false"> Se connecter</span>
                  </a-button>
                </div>
              </div>
            </a-form>
          </div>
          <div class="my-4 flex justify-center items-center copyright-text">
            <p>
              Droit d'auteur &copy; {{ new Date().getFullYear() }} Piston Gabon. Tous
              droits réservés.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
  :deep(.ant-input-affix-wrapper-lg) {
    border-radius: 0 !important;
  }
  :deep(.ant-btn.ant-btn-lg) {
    border-radius: 0 !important;
    width: 100% !important;
    height: 47.14px !important;

    &:is(:hover, :active) {
      background: white !important;
      border: 1px solid #001656;
      color: #001656 !important;
    }
  }
</style>
