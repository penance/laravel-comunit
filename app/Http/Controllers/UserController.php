<?php

namespace App\Http\Controllers;
use App\AccessLevel;
use App\User;
use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;
use Gate;
use Redirect;
use Validator;

class UserController extends Controller
{
    protected $userValidationRules = [
        'name'     => 'required|max:255',
        'email'    => 'email|max:255|unique:users',
        'password' => 'sometimes|confirmed|min:6',
    ];

    protected $fillable = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays a user list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // must provide a user instance, so that Gate can resolve the user policy
        if (Gate::denies('view', Auth::user())) {
            return View('common.unauthorized');
        } else {
            $users = User::with('accessLevel')->paginate(15);
            return View('user.index', compact('users'));
        }
    }

    /**
     * Displays a form for editing of an existing User record
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        if (Gate::denies('update', User::findOrFail($id))) {
            return View('common.unauthorized');
        }

        $title = 'Edit User';
        $route = route('user.edit', ['id' => $id]);
        $user  = User::with('accessLevel')->findOrFail($id);
        return View('common.user.edit', compact('title', 'route', 'id', 'user'));
    }

    /**
     * Updates a user
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateUser(Request $request, $id)
    {
        // obtain relevant user
        $user = User::findOrFail($id);

        // authorize the update action on this user, for the current user using
        // a GateContact and a Policy
        if (Gate::denies('update', $user)) {
            return View('common.unauthorized');
        }

        // validate the data requested, if user is not not an admin
        // validate leverages the AuthorizesRequests trait
        if (!Auth::user()->isAdmin()){
            $this->validate($request, $this->userValidationRules);
        }

        // password encryption handled by a Mutator in user model.
        if ($request->has('password')){
            $user->fill($request->all());
        } else {
            $user->fill($request->except('password'));
        }


        $user->save();
        return redirect('users')->with([
            'flashMessageSuccess' => 'User Updated!'
        ]);
    }

    /**
     * Updates a users access level
     * @param Request $request
     * @param $userId
     * @param $accessLevelId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function updateAccessLevel(Request $request, $userId, $accessLevelId)
    {
        if (Gate::denies('updateAccessLevel', User::findOrFail($userId))){
            return View('common.unauthorized');
        }

        // make sure userid and accessid exist
        $validator = Validator::make(array('userId' => $userId, 'accessLevelId' => $accessLevelId), [
            'userId'        => 'exists:users,id',
            'accessLevelId' => 'exists:access_levels,id'
        ]);

        if ($validator->fails()){
            return Redirect::back()->with(['flashMessageError' => 'User ID or access ID not found']);
        }

        // make sure at least one admin is left
        $admins = User::with('accessLevel')->where('level_id', '>', '1')->get();
        if(count($admins) < 2 && $accessLevelId < 2) {
            return Redirect::back()->with(['flashMessageError' => 'Can not delete last admin!']);
        }

        $user = User::find($userId);
        $user->level_id = $accessLevelId;
        $user->save();
        return Redirect::back()->with(['flashMessageSuccess' => 'Permissions updated for '.$user->name.' ('.$user->level_id.')!']);
    }

    /**
     * Deletes a user
     *
     * @param Request $request
     * @param $userId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function delete(Request $request, $userId)
    {
        if (Gate::denies('delete', Auth::user())) {
            return View ('common.unauthorized');
        }

        // get the user in question
        $user = User::findOrFail($userId);

        // make sure we are not deleting the last admin
        $admins = User::with('accessLevel')->where('level_id', '>', '1')->get();
        if ($user->isAdmin() && count($admins) < 2){
            return Redirect::back()->with(['flashMessageError' => 'Can not delete user, this is the last admin!']);
        }

        $user->delete();
        return Redirect::back()->with(['flashMessageSuccess' => 'User deleted.']);
    }

    /**
     * Get a Validator object for the user
     * @param User $user
     * @return \Illuminate\Validation\Validator
     */
    protected function getValidatorForUser (User $user)
    {
        return Validator::make($user->toArray(), $this->userValidationRules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'level_id'  => '1',
        ]);
    }
}

