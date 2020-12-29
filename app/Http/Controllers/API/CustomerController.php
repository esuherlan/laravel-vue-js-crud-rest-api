<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
   public function __construct()
   {
      $this->middleware('auth');
   }

   public function index()
   {
      $customers = Customer::latest()->get();
      return response()->json([
         'status' => [
            'code' => 200,
            'response' => 'success',
            'message' => 'List of Customers'
         ],
         'result' => $customers
      ]);
   }

   public function store(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'name'     => 'required|min:4',
         'email'   => 'required|email',
         'password'   => 'required|alpha_num|min:5',
         'gender'   => 'required',
         'is_married'   => 'required',
         'address'   => 'required'
      ]);

      if($validator->fails()) {
         return response()->json([
            'status' => [
               'code' => 400,
               'response' => 'failed',
               'message' => 'please fill required fields.'
            ],
            'result' => '',
            'validation_errors' => $validator->errors()
         ]);
      }

      $inputs = $request->all();
      $customer = Customer::create([
         'name' => $inputs['name'],
         'email' => $inputs['email'],
         'password' => bcrypt($inputs['password']),
         'gender' => $inputs['gender'],
         'is_married' => $inputs['is_married'],
         'address' => $inputs['address']
      ]);

      if($customer) {
         return response()->json([
            'status' => [
               'code' => 201,
               'response' => 'success',
               'message' => 'insert new customer data successfully.'
            ],
            'result' => $customer
         ]);
      }

      return response()->json([
         'status' => [
             'code' => 409,
             'response' => 'failed',
             'message' => 'insert new customer data failed.'
         ],
         'result' => []
      ]);
   }

   public function detail($id)
   {
      $customer = Customer::findOrfail($id);

      if($customer) {
         return response()->json([
            'status' => [
               'code' => 201,
               'response' => 'success',
               'message' => 'customer found.'
            ],
            'result' => $customer
         ]);
      }

      return response()->json([
         'status' => [
            'code' => 404,
            'response' => 'failed',
            'message' => 'customer not found.'
         ],
         'result' => []
      ]);
   }

   public function update($id, Request $request)
   {
      $validator = Validator::make($request->all(), [
         'name' => 'required|min:4',
         'email' => 'required|email',
         'password' => 'required|alpha_num|min:5',
         'gender' => 'required',
         'is_married' => 'required',
         'address' => 'required'
      ]);

      if($validator->fails()) {
         return response()->json([
            'status' => [
               'code' => 400,
               'response' => 'failed',
               'message' => 'please fill required fields.'
            ],
            'result' => [],
            'validation_errors' => $validator->errors()
         ]);
      }

      $inputs = $request->all();
      $customer = Customer::whereId($inputs['id'])->update([
         'name' => $inputs['name'],
         'email' => $inputs['email'],
         'password' => bcrypt($inputs['email']),
         'gender' => $inputs['gender'],
         'is_married' => $inputs['is_married'],
         'address' => $inputs['address']
      ]);

      if($customer) {
         return response()->json([
            'status' => [
               'code' => 201,
               'response' => 'success',
               'message' => 'update customer data successfully.'
            ],
            'result' => $customer
         ]);
      }
      
      return response()->json([
         'status' => [
            'code' => 404,
            'response' => 'failed',
            'message' => 'Sorry, customer data not found.'
         ],
         'result' => []
      ]);
   }

   public function delete($id)
   {
      $customer = Customer::findOrFail($id);
      $customer->delete();

      if($customer) {
         return response()->json([
            'status' => [
               'code' => 200,
               'response' => 'success',
               'message' => 'customer deleted successfully.'
            ],
            'result' => []
         ]);
      }
      
      return response()->json([
         'status' => [
            'code' => 404,
            'response' => 'failed',
            'message' => 'customer not found.'
         ],
         'result' => []
      ]);
   }
}