<template>
  <div class="card mb-2">
    <div class="card-header">
      <div class="card-title">
        Children <a href="#" class="btn btn-sm btn-primary" style="float: right" data-toggle="modal" data-target="#setChildModal" @click="setChild()" v-show="isYourProfile">Set Child</a>
      </div>
    </div>
    <div class="card-content">
      <table class="table">
        <tbody>
          <tr v-for="data in userData.childs" :key="data.id">
            <th>Name</th>
            <td><a :href="'home?users='+data.id">{{ data.name }}</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <SetChildComponent/>
  </div>
</template>
<script>
  import SetChildComponent from '../../components/profile/SetComponents/SetChildComponent'
  export default {
    components:{
      SetChildComponent
    },
    methods:{
      async setChild(){

      }
    },
    computed: {
      userData () {
        return this.$store.getters?.userData
      },
      isYourProfile () {
        return this.$store.getters.authenticated
      }
    }
  }
</script>