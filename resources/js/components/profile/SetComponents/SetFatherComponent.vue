<template>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="setFather()">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Select Father</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              {{form['father_id']}}
              <label for="exampleFormControlSelect1">Select Existing Father</label>
              <select class="form-control" id="exampleFormControlSelect1" v-model="father.id">
                <option v-for="data in fatherData" :key="data.id" :value="data.id">{{ data.name }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Enter Father's Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="form['father_name']"
                placeholder="Enter Name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
  export default {
    props:['fatherData', 'father'],
    data(){
      return{
        form:{}
      }
    },
    methods:{
      setFather(){
        this.$axios.post('/api/setFather', this.form)
        .then(res => {
          this.$store.dispatch('getUserData')
          alert(res.data.message)
          $('#exampleModal').modal('hide')
        })
      }
    }
  }
</script>