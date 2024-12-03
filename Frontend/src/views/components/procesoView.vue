<template>
    <div class="pagina">
        <div class="grid">
           
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

</style>