<template>
   <div class="container mt-3">
      <div class="row justify-content-center">
         <div class="col-md-12">
            <div class="card card-default">
            <div class="card-header">Customers</div>
               <div class="card-body">
                  <router-link :to="{ name: 'create' }" class="btn btn-md btn-success"><i class="fas fa-plus-square"></i> Add Customer</router-link>
                  <div class="table-responsive mt-2">
                     <table class="table table-hover table-bordered">
                        <thead>
                           <tr>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Gender</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr v-for="(customer, index) in customers" :key="customer.id">
                              <td>{{ customer.name }}</td>
                              <td>{{ customer.email }}</td>
                              <td>{{ customer.gender }}</td>
                              <td class="text-center">
                                 <router-link :to="{name: 'detail', params: { id: customer.id }}" class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i> See Detail</router-link>
                                 <router-link :to="{name: 'edit', params: { id: customer.id }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</router-link>
                                 <button @click.prevent="CustomerDelete(customer.id, index)" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
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
            customers: []
         }
      },
      created() {
         let uri = `${process.env.MIX_API_URL}api/customers`;
         this.axios.get(uri, {headers: { 'Authorization' : `Bearer ${process.env.MIX_REST_API_PASSPORT_KEY}`}})
         .then(response => {
            this.customers = response.data.result;
         });
      },
      methods: {
         CustomerDelete(id, index) {
            let uri = `${process.env.MIX_API_URL}api/customers/${id}`;
            this.axios.delete(uri, {headers: { 'Authorization' : `Bearer ${process.env.MIX_REST_API_PASSPORT_KEY}`}})
            .then(response => {
               this.customers.splice(index, 1);
            }).catch(error => {
               alert('system error!');
            });
         }
      }
   };
</script>