<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\CreateAccountNotification;
use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $userRepository;
    private $roleRepository;

    public function __construct(UserRepositoryInterface $userRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('index_users');
        return ResponseHelper::findSuccess("list", UserResource::collection($this->userRepository->index()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('store_user');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->has('image_file') && $request->get('image_file') != null) {
                $data['image'] = FileHelper::uploadFileBase64($request->get('image_file'),  'users');
            }
            $password = Str::random(8);
            $data['password'] = Hash::make($password);
            $user = $this->userRepository->store($data);
            $roles = $this->roleRepository->findByIds([$request->get('roles')]);
            $user->syncRoles($roles);
            //$user->notify(new CreateAccountNotification($password));
            DB::commit();
            return ResponseHelper::createSuccess("user", new UserResource($user));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('show_user');
        $user->load('roles');
        return ResponseHelper::findSuccess("user", new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update_user');
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if ($request->has('image_file') && $request->get('image_file') != null) {
                $data['image'] = FileHelper::uploadFileBase64($request->get('image_file'),  'users');
            }
            $user = $this->userRepository->update($user->id,  $data);
            $roles = $this->roleRepository->findByIds([$request->get('roles')]);
            $user->syncRoles($roles);
            DB::commit();
            return ResponseHelper::updateSuccess("user", new UserResource($user));
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('destroy_user');
        return ResponseHelper::deleteSuccess("user", $this->userRepository->delete($user->id));
    }
}