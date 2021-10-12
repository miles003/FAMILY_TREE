<template>
    <div class="modal fade" id="setWifeModal" tabindex="-1" role="dialog" aria-labelledby="setWifeModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form @submit.prevent="setwife()">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Select Wife</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                {{form['wife_id']}}
                <label for="exampleFormControlSelect1">Select Existing Wife</label>
                <select class="form-control" id="exampleFormControlSelect1" v-model="wife.id">
                  <option v-for="data in wifeData" :key="data.id" :value="data.id">{{ data.name }}</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Enter wife's Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="form['wife_name']"
                  placeholder="Enter Name">
                  <span class="text-danger" v-if="errors.wife_name">
                    <strong>{{errors.wife_name[0]}}</strong>
                  </span>
              </div>
              <div class="form-group">
                <label for="marriageDate">Marriage Date</label>
                <input type="date" class="form-control" id="marriageDate" aria-describedby="emailHelp" v-model="form['marriage_date']"
                  placeholder="Enter Name">
                <span class="text-danger" v-if="errors.marriage_date">
                  <strong>{{errors.marriage_date[0]}}</strong>
                </span>
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
      props:['wifeData', 'wife'],
      data(){
        return{
          form:{},
          errors:{}
        }
      },
      methods:{
        setwife(){
          this.$axios.post('/api/setWife', this.form)
          .then(res => {
            this.$store.dispatch('getUserData')
            alert(res.data.message)
            $('#setWifeModal').modal('hide')
          }).catch(e => {
            this.errors = e.response.data.errors
          })
        }
      }
    }
  </script>