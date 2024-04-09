<template>
  <div class="wrong-page-wrapper">
    <a-result status="404" title="404" sub-title="Désolé, la page que vous avez visitée n'existe pas.">
      <template #extra>
        <a
          href="/"
          class="btn btn-primary"
          >
          Retour à l'accueil
        </a>
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
