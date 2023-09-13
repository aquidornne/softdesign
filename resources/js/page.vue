<template>
  <div>
    <router-view></router-view>
    <msg-error></msg-error>
    <msg-success></msg-success>
    <notifications></notifications>
    <loader></loader>   
  </div>
</template>

<script>
  import Loader from './components/Loader.vue';
  import MsgError from './components/MsgError.vue';
  import MsgSuccess from './components/MsgSuccess.vue';

  export default {
      components: {
          Loader,
          MsgError,
          MsgSuccess,
      }
  };
</script>

<style>

body {
  background-color: #cfcfcf !important;
}

a, a:hover, a:focus, a:active, a:visited, a:link, a span, a span:hover, a span:focus, a span:active, a span:visited, a span:link {
  text-decoration: none !important;
}