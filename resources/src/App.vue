<template>
    <!-- <router-view></router-view> -->
     <div id="box">
    <main class="hero is-ligth is-fullheight-with-navbar">
      <section class="hero-body">
        <div class="v-container">
          <router-view />
        </div>
      </section>
    </main>
  </div>
</template>
<style lang="css" scope>
.hero-body {
    padding: 0rem !important;
  }
  .hero.is-halfheight .hero-body,
  .hero.is-fullheight .hero-body,
  .hero.is-fullheight-with-navbar .hero-body {
    align-items: inherit;
    display: flex;
  }
  .hero-foot {
    background-color: #0000;
  }
  .v-container {
    width: calc(100%);
    height: 100vh;
  }
</style>
<script>
export default {
  setup() {

   }
}
</script>
