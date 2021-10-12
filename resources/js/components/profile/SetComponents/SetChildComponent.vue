<template>
  <div class="modal fade" id="setChildModal" tabindex="-1" role="dialog" aria-labelledby="setChildModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form @submit.prevent="setchild()">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Select Child</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Enter child's Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                v-model="form['child_name']" placeholder="Enter Name">
              <span class="text-danger" v-if="errors.child_name">
                <strong>{{errors.child_name[0]}}</strong>
              </span>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Select Gender</label>
              <select class="form-control" id="exampleFormControlSelect1" v-model="form['gender']">
                <option value="male">MALE</option>
                <option value="female">FEMALE</option>
              </select>
              <span class="text-danger" v-if="errors.gender">
                <strong>{{errors.gender[0]}}</strong>
              </span>
            </div>
            <div class="form-group">
              <label for="spouse">Parent Mother of this Child ( your spouse )</label>
              <select class="form-control" id="spouse" v-model="form['pivot_id']">
                <option v-for="data in userData.wife" :value="data.pivot.id" :key="data.id">{{ data.name }}</option>
              </select>
              <span class="text-danger" v-if="errors.pivot_id">
                <strong>{{errors.pivot_id[0]}}</strong>
              </span>
            </div>
            <div class="form-group">
              <label for="marriageDate">Birth Date</label>
              <input type="date" class="form-control" id="marriageDate" aria-describedby="emailHelp"
                v-model="form['bod']" placeholder="Enter Name">
              <span class="text-danger" v-if="errors.bod">
                <strong>{{errors.bod[0]}}</strong>
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
    data() {
      return {
        form: {
          'gender': 'male'
        },
        errors:{}
      }
    },
    methods: {
      setchild() {
        console.log(this.form)
        this.$axios.post('/api/setChild', this.form)
        .then(res => {
          this.$store.dispatch('getUserData')
          alert(res.data.message)
          $('#setChildModal').modal('hide')
        }).catch(e => {
          this.errors = e.response.data.errors
        })
      }
    },
    computed: {
      userData () {
        return this.$store.getters?.userData
      }
    }
  }
</script>