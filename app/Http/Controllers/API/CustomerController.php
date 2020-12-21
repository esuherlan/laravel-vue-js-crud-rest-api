<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->get();
        return response([
        'success' => true,
          'message' => 'List of Customers',
          'result' => $customers
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'name'     => 'required',
          'email'   => 'required',
          'password'   => 'required',
          'gender'   => 'required',
          'is_married'   => 'required',
          'address'   => 'required',
        ],
        [
          'name.required' => 'Please enter your name.',
          'email.required' => 'Please enter your email.',
          'password.required' => 'Please enter your password.',
          'gender.required' => 'Please enter your gender.',
          'is_married.required' => 'Please enter your status.',
          'address.required' => 'Please enter your address.',
        ]);

        if($validator->fails()) {
          return response()->json([
                'success' => false,
                'message' => 'Please fill in the blank fields.',
                'result'    => $validator->errors()
          ],400);
       } else {
          $customer = Customer::create([
                'name'          => $request->input('name'),
                'email'         => $request->input('email'),
                'password'      => $request->input('password'),
                'gender'        => $request->input('gender'),
                'is_married'    => $request->input('is_married'),
                'address'       => $request->input('address')
          ]);


          if($customer) {
                return response()->json([
                    'success' => true,
                    'message' => 'Customer data saved successfully.',
                ], 200);
          } else {
             return response()->json([
                'success' => false,
                'message' => 'Customer data failed to save.',
             ], 400);
          }
        }
    }

   public function show($id)
   {
      $customer = Customer::whereId($id)->first();

      if($customer) {
         return response()->json([
            'success' => true,
            'message' => 'Detail of Customer.',
            'result'  => $customer
         ], 200);
      } else {
         return response()->json([
            'success' => false,
            'message' => 'No Customer found.',
            'data'    => ''
         ], 404);
      }
   }

   public function update(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'name'     => 'required',
         'email'   => 'required',
         'password'   => 'required',
         'gender'   => 'required',
         'is_married'   => 'required',
         'address'   => 'required',
      ],
      [
         'name.required' => 'Please enter your name.',
         'email.required' => 'Please enter your email.',
         'password.required' => 'Please enter your password.',
         'gender.required' => 'Please enter your gender.',
         'is_married.required' => 'Please enter your status.',
         'address.required' => 'Please enter your address.',
      ]);

      if($validator->fails()) {
         return response()->json([
            'success' => false,
            'message' => 'Please fill in the blank fields.',
            'result'  => $validator->errors()
         ],400);
      } else {
         $customer = Customer::whereId($request->input('id'))->update([
            'name'         => $request->input('name'),
            'email'        => $request->input('email'),
            'password'     => $request->input('password'),
            'gender'       => $request->input('gender'),
            'is_married'   => $request->input('is_married'),
            'address'      => $request->input('address')
         ]);

         if($customer) {
            return response()->json([
               'success' => true,
               'message' => 'Customer data updated successfully.',
            ], 200);
         } else {
            return response()->json([
              'success' => false,
              'message' => 'Customer data failed to update.',
            ], 500);
         }
      }
   }

   public function destroy($id)
   {
      $customer = Customer::findOrFail($id);
      $customer->delete();

      if($customer) {
         return response()->json([
            'success' => true,
            'message' => 'Customer data deleted successfully.',
         ], 200);
      } else {
         return response()->json([
            'success' => false,
            'message' => 'Customer data failed to delete.',
         ], 500);
      }
   }
}