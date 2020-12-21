<template>
   <div class="container mt-3">
      <div class="row justify-content-center">
         <div class="col-md-12">
            <div class="card card-default">
               <div class="card-header">Detail Customer</div>
               <div class="card-body">
                  <form>
                     <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="customer.name" readonly>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" v-model="customer.email" readonly>
                     </div>
                     <div class="form-group">
                        <label>Gender</label>
                        <input type="text" class="form-control" v-model="customer.gender" readonly>
                     </div>
                     <div class="form-group">
                        <label>Is Married</label>
                        <input type="text" class="form-control" v-model="customer.is_married" readonly>
                     </div>
                     <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" v-model="customer.address" rows="5" readonly></textarea>
                     </div>
                     <div class="form-group">
                        <router-link :to="{name: 'customers'}" class="btn btn-sm btn-secondary"><i class="fas fa-home"></i> Back to Home</router-link>
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
      created() {
         let uri = `http://localhost:8000/api/customers/${this.$route.params.id}`;
         this.axios.get(uri, {headers: { 'Authorization' : `Bearer ${process.env.MIX_REST_API_PASSPORT_KEY}`}})
         .then((response) => {
            this.customer = response.data.result;
         });
      }
   };
</script>