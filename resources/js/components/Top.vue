<template>
    <div class="header">
      <div class="container">
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="logo">
                    <img src="/img/softdesign.svg" alt="Logo">
                </div>
            </div>
            <div class="col-12 col-md-4">
                <Weather />
            </div>
        </div>
      </div>
    </div>
</template>

<script>
    import Weather from '@/components/Weather.vue';

    export default {
        components: {
            Weather
        }
    };
</script>

  <style>
    .header {
        background-color: white;
        display: flex;
        align-items: center;
        padding: 10px;
        margin-bottom: 50px
    }

    .logo img {
        max-width: 200px;
        padding: 25px
    }
  </style>
