<?php

namespace App\Http\Controllers\Customers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\Customers\CustomerService;
use JWTAuth;

class CustomerController extends Controller
{

    private $customerService;
    protected $user;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
        // $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function getCustomers(Request $request)
    {
        $data = $request->only('id', 'first_name', 'email', 'pagination');
        $validator = Validator::make($data, [
            'id' => 'numeric',
            'first_name' => 'string',
            'email' => 'email',
            'pagination' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages(), 'code' => 422]);
        }

        $customers = $this->customerService->getCustomers($data);
        return response()->json(['success' => true, 'customers' => $customers, 'code' => 200]);
    }
}