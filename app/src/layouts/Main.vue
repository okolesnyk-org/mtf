<template>
  <div class="container">

    <nav>
      <div class="nav-wrapper">
        <a href="#" class="brand-logo">Logo</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><v-link href="/">Home</v-link></li>
          <li><v-link href="/tests">Tests</v-link></li>
          <li><v-link href="/reports">Reports</v-link></li>
        </ul>
      </div>
    </nav>
    <slot></slot>
  </div>
</template>

<script>
  import VLink from '../components/VLink.vue'
  export default {
    components: {
      VLink
    }
  }
</script>
