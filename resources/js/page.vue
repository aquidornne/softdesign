<template>
  <div>
    <top></top>
    <div class="container">
      <router-view></router-view>
    </div>
    <msg-error></msg-error>
    <msg-success></msg-success>
    <loader></loader>   
  </div>
</template>

<script>
  import Top from './components/Top.vue';
  import Loader from './components/Loader.vue';
  import MsgError from './components/MsgError.vue';
  import MsgSuccess from './components/MsgSuccess.vue';

  export default {
      components: {
          Top,
          Loader,
          MsgError,
          MsgSuccess,
      }
  };
</script>

<style>
  body {
    background-color: #64a4ec !important;
    margin-bottom: 50px;
  }
  a, a:hover, a:focus, a:active, a:visited, a:link, a span, a span:hover, a span:focus, a span:active, a span:visited, a span:link {
    text-decoration: none !important
  }
  h1,h2,h3,h4 {
    font-family: Outfit !important
  }
</style>