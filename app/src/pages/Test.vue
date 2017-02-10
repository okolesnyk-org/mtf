<template>
  <main-layout>
    <p>Tests page</p>
    <grid
            :data="gridData"
            :columns="gridColumns"
            :filter-key="searchQuery">
    </grid>
  </main-layout>
</template>

<script>
  import MainLayout from '../layouts/Main.vue'
  import Grid from '../components/grid/VTest.vue'
  export default {
    components: {
      MainLayout,
      Grid
    },
    data: function () {
      return {
        searchQuery: '',
        gridColumns: ['name', 'description', 'variations'],
        gridData: [
          {name: 'CreateSimpleTest', description: "Test bla", variations: {name: 'Test', summary: 'Test', constraints: ['Name', 'Name2']}},
          {name: 'CreateSimpleTest', description: "Test bla", variations: {name: 'Test', summary: 'Test', constraints: ['Name', 'Name2']}},
          {name: 'CreateSimpleTest', description: "Test bla", variations: {name: 'Test', summary: 'Test', constraints: ['Name', 'Name2']}},
          {name: 'CreateSimpleTest', description: "Test bla", variations: {name: 'Test', summary: 'Test', constraints: ['Name', 'Name2']}},
          {name: 'CreateSimpleTest', description: "Test bla", variations: {name: 'Test', summary: 'Test', constraints: ['Name', 'Name2']}}
        ]
      }
    }
  }
</script>
