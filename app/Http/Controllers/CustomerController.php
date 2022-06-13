<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Notifications\CreateAccountNotification;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Repositories\contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    private $userRepository;
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository, UserRepositoryInterface $userRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_customers');
        return ResponseHelper::findSuccess("list", CustomerResource::collection($this->customerRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $this->authorize('store_customer');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $user = null;
            if ($request->has('email') && $request->get('email') != null) {
                if ($request->has('image_file') && $request->get('image_file') != null) {
                    $data['image'] = FileHelper::uploadFileBase64($request->get('image_file'),  'customers');
                }
                $password = Str::random(8);
                $data['password'] = Hash::make($password);
                $user = $this->userRepository->store($data + ["name" => $request->get('first_name') . " " . $request->get('last_name')]);
                $data['user_id'] = $user->id;
            } else {
                $data['user_id'] = null;
            }
            $customer = $this->customerRepository->store($data);
            if ($user) {
                $user->syncRoles(["Customer"]);
                $user->notify(new CreateAccountNotification($password));
            }
            DB::commit();
            return ResponseHelper::createSuccess("customer", new CustomerResource($customer));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $this->authorize('show_customer');
        $customer->load('user', 'gsOffice');
        return ResponseHelper::findSuccess("customer", new CustomerResource($customer));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $this->authorize('update_customer');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $user = null;
            if ($request->has('email') && $request->get('email') != null) {
                if ($request->has('image_file') && $request->get('image_file') != null) {
                    $data['image'] = FileHelper::uploadFileBase64($request->get('image_file'),  'customers');
                }
                if ($customer->user) {
                    $this->userRepository->update($customer->user->id, $data + ["name" => $request->get('first_name') . " " . $request->get('last_name')]);
                } else {
                    $password = Str::random(8);
                    $data['password'] = Hash::make($password);
                    $user = $this->userRepository->store($data + ["name" => $request->get('first_name') . " " . $request->get('last_name')]);
                    $data['user_id'] = $user->id;
                    $user->syncRoles(["Customer"]);
                    $user->notify(new CreateAccountNotification($password));
                }
            }
            $customer = $this->customerRepository->update($customer->id,  $data);
            DB::commit();
            return ResponseHelper::updateSuccess("customer", new CustomerResource($customer));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $this->authorize('destroy_customer');
        return ResponseHelper::deleteSuccess("customer", $this->customerRepository->delete($customer->id));
    }
}
