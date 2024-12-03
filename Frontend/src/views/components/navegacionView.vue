
<template>
  <nav class="navigation">
    <ul class="main-nav">
      <div class="main-nav__item">
        <router-link to="/dofa" class="create-account nav-link">Dofa</router-link>
      </div>
      <div class="main-nav__item">
        <router-link to="/clasificacion" class="create-account nav-link">Clasificación</router-link>
      </div>
      <div class="main-nav__item">
        <router-link to="/controles" class="create-account nav-link">Controles</router-link>
      </div>
      <div class="main-nav__item">
        <router-link to="/accion" class="create-account nav-link">Acción</router-link>
      </div>
      <div class="main-nav__item">
        <router-link to="/seguimiento" class="create-account nav-link">Seguimiento</router-link>
      </div>
    </ul>
  </nav>
  </template>
  
<script setup>

</script>


<style scoped>

.navigation {
grid-column: 5 / 17;
grid-row: 2 / 3;
margin-top: 50px;
}

.main-nav {
display: flex;
justify-content: space-around;
}


.nav-link {
padding: 10px 40px;
color: white;
border-radius: 10px;
text-decoration: none;
background-color: #c91717;
}

.nav-link:hover {
background-color: white;
color: red;
}
  
  
  
</style> 