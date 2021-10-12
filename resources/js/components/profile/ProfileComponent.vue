<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ userData.name }}</h3>
    </div>
    <div class="panel-body text-center">
      <img src="/assets/images/icon_user_1.png" style="width:100%;max-width:300px">
    </div>
    <div class="card-content">
      <table class="table">
        <tbody>
          <tr>
            <th>Nickname</th>
            <td>{{ userData.name }}</td>
          </tr>
          <tr>
            <th>Gender</th>
            <td>{{ userData.gender }}</td>
          </tr>
          <tr>
            <th>Date Of Birth</th>
            <td>{{ userData.date_of_birth }}</td>
          </tr>
          <tr>
            <th>Birth Order</th>
            <td>{{ userData.birth_order }}</td>
          </tr>
          <tr>
            <th>Age</th>
            <td>
              {{ userData.date_of_birth | age}}
            </td>
          </tr>
          <tr>
            <th>Email</th>
            <td>{{ userData.email }}</td>
          </tr>
          <tr>
            <th>Phone</th>
            <td>{{ userData.phone }}</td>
          </tr>
          <tr>
            <th>Address</th>
            <td>{{ userData.address}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
  import axios from 'axios'
  export default {
    computed: {
      userData () {
        return this.$store.getters.userData
      }
    }
  }
</script>