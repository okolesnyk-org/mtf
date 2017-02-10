<template>
    <td>
      <span>{{getName}}</span>

    </td>

</template>

<script>
  import Grid from '../VTest.vue'
  export default {
    components: {
      Grid
    },
    props: [
      'name'
    ],
    computed: {
      getName() {
        var name;
        if (typeof this.name === "string") {
          name = this.name;
        } else if (typeof this.name === "object") {
          name = ''
        }
        return name;
      }
    }
  };
</script>
