<template>
    <div class="pagina">
        <div class="grid">
            <div class="main-nav__item">
                <router-link to="/dofa" class="create-account nav-link">Crear dofa </router-link>
            </div>
            <div class="main-nav__item">
                <router-link to="/VerDofa" class="create-account nav-link">Ver dofa</router-link>
            </div>
            <div class="main-nav__item">
                <router-link to="/proceso" class="create-account nav-link">Crear proceso</router-link>
            </div>
        </div>
    </div>

</template>
  
<script>
  export default {
    name: 'AboutView'
  }
</script>  

<style scoped> 

.pagina {
  display: grid;
  grid-template-columns: repeat(15, 1fr);
  grid-template-rows:  repeat(15, 1fr);
  background-image: url("/src/assets/img/Fondo2.png");
  background-position: center center;
  background-size: cover;
  font-family: Arial, sans-serif;
  height: 100vh;
}
.grid{
grid-column: 3 / 15;
grid-row: 7 / 8;
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