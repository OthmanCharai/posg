<template>
  <div class="wrong-page-wrapper">
    <a-result status="404" title="404" sub-title="Désolé, la page que vous avez visitée n'existe pas.">
      <template #extra>
        <a-button type="primary" href="/">
          <vue-feather :size="16" type="arrow-left"></vue-feather>
          <span>Retour à l'accueil</span>
        </a-button>
      </template>
    </a-result>
  </div>
</template>

<style scoped>
  .wrong-page-wrapper {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }
</style>
