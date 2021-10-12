<template>
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          Siblings
        </div>
      </div>
      <div class="card-content">
        <table class="table">
          <tbody>
            <tr v-for="data in userData.siblings">
              <th>Name</th>
              <td><a href="#">{{ data.name }}</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  <script>
    export default {
      computed: {
        userData () {
          return this.$store.getters?.userData
        }
      }
  
    }
  </script>