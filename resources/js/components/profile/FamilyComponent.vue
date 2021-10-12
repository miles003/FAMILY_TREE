<template>
  <div class="card mb-2">
    <div class="card-header">
      <div class="card-title">Family</div>
    </div>
    <div class="card-content">
      <table class="table">
        <tbody>
          <tr>
            <th>Father</th>
            <td><a :href="'home?users='+getID('father')"> {{ userData.father && userData.father.name }} </a></td>
            <td><a href='#' data-toggle="modal" data-target="#exampleModal" @click="setFather()" v-show="isYourProfile">Set Father</a></td>
          </tr>
          <tr>
            <th>Mother</th>
            <td><a :href="'home?users='+getID('mother')"> {{ userData.mother && userData.mother.name }} </a></td>
            <td><a href="#" data-toggle="modal" data-target="#setMotherModal" @click="setMother()" v-show="isYourProfile">Set Mother</a></td>
          </tr>
          <tr v-if="userData.gender == 'male'">
            <th>Wife</th>
            <td>
              <a :href="'home?users='+data.id" :key="data.id" v-for="data in userData.wife"> {{data.name}}  <br></a>
            </td>
            <td><a href="#" data-toggle="modal" data-target="#setWifeModal" @click="setWife()" v-show="isYourProfile">Set Wife</a></td>
          </tr>
          <tr v-else>
            <th>Husband</th>
            <td>
              <a :href="'home?users='+data.id" :key="data.id" v-for="data in userData.husband"> {{data.name}}  <br></a>
            </td>
            <td><a href="#" data-toggle="modal" data-target="#setHusbandModal" @click="setHusband()" v-show="isYourProfile">Set Husband</a></td>
          </tr>
        </tbody>
      </table>
    </div>
    <SetFatherComponent :fatherData="fatherData" :father="father"/>
    <SetMotherComponent :motherData="motherData" :mother="mother"/>
    <SetWifeComponent :wifeData="wifeData" :wife="wife"/>
    <SetHusbandComponent :husbandData="husbandData" :husband="husband"/>
  </div>
</template>
<script>
  import SetFatherComponent from '../../components/profile/SetComponents/SetFatherComponent'
  import SetMotherComponent from '../../components/profile/SetComponents/SetMotherComponent'
  import SetWifeComponent from '../../components/profile/SetComponents/SetWifeComponent'
  import SetHusbandComponent from '../../components/profile/SetComponents/SetHusbandComponent'
  export default {
    components:{
      SetFatherComponent, SetMotherComponent, SetWifeComponent, SetHusbandComponent
    },
    data(){
      return{
        fatherData:{},
        father:{},
        motherData:{},
        mother:{},
        wifeData:{},
        wife:{},
        husbandData:{},
        husband:{}
      }
    },
    methods:{
      async setFather(){
        let response = await this.$axios.get('/api/getFatherList')
        this.fatherData = response.data
        this.father = this.userData.father ?? {}
      },
      async setMother(){
        let response = await this.$axios.get('/api/getMotherList')
        this.motherData = response.data
        this.mother = this.userData.mother ?? {}
      },
      async setWife(){
        let response = await this.$axios.get('/api/getWifeList')
        this.wifeData = response.data
        this.wife = this.userData.wife ?? {}
      },
      async setHusband(){
        let response = await this.$axios.get('/api/getHusbandList')
        this.husbandData = response.data
        this.husband = this.userData.husband ?? {}
      },
      authenticated(){

        return this.userData.authenticated_id ? this.userData.authenticated_id === this.userData.id : false
      },
      getID(key){
        return this.userData[key] && this.userData[key].id
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