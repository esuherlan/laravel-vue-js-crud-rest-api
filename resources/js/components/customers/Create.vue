<template>
   <div class="container mt-3">
      <div class="row justify-content-center">
         <div class="col-md-12">
            <div class="card card-default">
               <div class="card-header">Add Customer</div>
               <div class="card-body">
                  <form @submit.prevent="CustomerStore">
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="customer.name" placeholder="Enter Name">
                        <div v-if="validation.name">
                           <div class="alert alert-danger mt-1" role="alert">
                              {{ validation.name[0] }}
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="customer.email" placeholder="Enter Email">
                        <div v-if="validation.email">
                           <div class="alert alert-danger mt-1" role="alert">
                              {{ validation.email[0] }}
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" v-model="customer.password" placeholder="Enter Password">
                        <div v-if="validation.password">
                           <div class="alert alert-danger mt-1" role="alert">
                              {{ validation.password[0] }}
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Gender</label>
                        <div class="form-control">
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="male" value="male" v-model="customer.gender" checked>
                              <label class="form-check-label" for="male">Male</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="female" value="female" v-model="customer.gender">
                              <label class="form-check-label" for="female">Female</label>
                           </div>
                        </div>
                        <div v-if="validation.gender">
                           <div class="alert alert-danger mt-1" role="alert">
                              {{ validation.gender[0] }}
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Married</label>
                        <div class="form-control">
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="no" value="no" v-model="customer.is_married" checked>
                              <label class="form-check-label" for="no">No</label>
                           </div>
                           <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" id="yes" value="yes" v-model="customer.is_married">
                              <label class="form-check-label" for="male">Yes</label>
                           </div>
                        </div>                        
                        <div v-if="validation.is_married">
                           <div class="alert alert-danger mt-1" role="alert">
                              {{ validation.is_married[0] }}
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" v-model="customer.address" rows="5" placeholder="Enter Address"></textarea>
                        <div v-if="validation.address">
                           <div class="alert alert-danger mt-1" role="alert">
                              {{ validation.address[0] }}
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> Save</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
   export default {
      data() {
         return {
            customer: {},
            validation: []
         }
      },
      methods: {
         CustomerStore() {
         let uri = 'http://localhost:8000/api/customers/store';
         this.axios.post(uri, this.customer, {headers: { 'Authorization' : `Bearer ${process.env.MIX_REST_API_PASSPORT_KEY}`}})
            .then((response) => {
               this.$router.push({
                  name: 'customers'
               });
            }).catch(error => {
               this.validation = error.response.data.result;
            });
         }
      }
   };
</script>