<template>
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <th>SELECTED USER</th>
          <td colspan="4" class="text-center"> <a :href="'home?users='+userData.id">{{ userData.name }}</a> </td>
        </tr>
        <tr>
          <th style="width: 9%">Grand Father & Grand Mother</th>
          <td class="text-center">
            <a :href="'home?users='+getID('grandFatherToMyFather')">{{ userData.grandFatherToMyFather && userData.grandFatherToMyFather.name}}</a>
          </td>
          <td class="text-center">
            <a :href="'home?users='+getID('grandFatherToMyMother')">{{ userData.grandFatherToMyMother && userData.grandFatherToMyMother.name}}</a>
          <td class="text-center">
            <a :href="'home?users='+getID('grandMotherToMyFather')">{{ userData.grandMotherToMyFather && userData.grandMotherToMyFather.name}}</a>
          </td>
          <td class="text-center">
            <a :href="'home?users='+getID('grandMotherToMyMother')">{{ userData.grandMotherToMyMother && userData.grandMotherToMyMother.name}}</a>
          </td>
        </tr>
        <tr>
          <th>Father & Mother</th>
          <td class="text-center" colspan="2">
            <a :href="'home?users='+getID('father')">{{ userData.father && userData.father.name}}</a>
          </td>
          <td class="text-center" colspan="2">
            <a :href="'home?users='+getID('father')">{{ userData.mother && userData.mother.name}}</a>
          </td>
        </tr>
        <tr v-if="userData.gender === 'female'">
          <th>Husband</th>
          <td colspan="4">
            <ul>
              <li v-for="data in userData.husband">
                <a :href="'home?users='+getID('husband')">{{ data.name}}</a>
              </li>
            </ul>
          </td>
        </tr>
        <tr v-else>
          <th>Wife</th>
          <td colspan="4">
            <ul>
              <li v-for="data in userData.wife">
                <a :href="'home?users='+data.id">{{ data.name}}</a>
              </li>
            </ul>
          </td>
        </tr>
        <tr>
          <th>Child & GrandChild</th>
          <td colspan="4">
            <div class="">
              <div class="col-md-3">
                <h4><strong>Child</strong></h4>
                <ul style="padding-left: 30px">
                  <li v-for="data in userData.childs"><a :href="'home?users='+data.id">{{ data.name }}</a></li>
                </ul>
              </div>
              <div class="clearfix"></div>
              <hr>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
  export default {
    created() {
      this.$store.dispatch('getUserData')
    },
    methods:{
      getID(key){
        return this.userData[key] && this.userData[key].id
      }
    },
    computed: {
      userData() {
        return this.$store.getters?.userData
      },
    }
  }
</script>