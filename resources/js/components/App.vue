<template>
  <div class="layout">
    <!-- Encabezado fijo -->
    <header class="header">
    </header>

    <!-- Menú lateral -->

    <!-- Contenedor de la página -->
    <main class="page-container">
      <router-view> </router-view><!-- Aquí se cargan las páginas basadas en las rutas -->
    </main>

  </div>
</template>

<script>
export default {
    name: 'App',
  data() {
    return {
      leftDrawerOpen: false
    };
  },
  methods: {
    toggleLeftDrawer() {
      this.leftDrawerOpen = !this.leftDrawerOpen;
    }
  }
};
</script>
