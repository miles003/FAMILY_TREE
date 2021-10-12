<template>
    <div class="modal fade" id="setMotherModal" tabindex="-1" role="dialog" aria-labelledby="setMotherModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form @submit.prevent="setmother()">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Select mother</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Select Existing mother</label>
                <select class="form-control" id="exampleFormControlSelect1" v-model="mother.id">
                  <option v-for="data in motherData" :key="data.id" :value="data.id">{{ data.name }}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter mother's Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="form['mother_name']"
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
      props:['motherData', 'mother'],
      data(){
        return{
          form:{}
        }
      },
      methods:{
        setmother(){
          this.$axios.post('/api/setMother', this.form)
          .then(res => {
            this.$store.dispatch('getUserData')
            alert(res.data.message)
            $('#setMotherModal').modal('hide')
          })
        }
      }
    }
  </script>