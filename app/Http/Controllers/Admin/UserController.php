<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Models\User;
use App\UserRole;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\UserRepository;
use jeremykenedy\LaravelRoles\Models\Role;
use Hash;


class UserController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;

    }

    // Fetch all records from User Repository
    public function index()
    {
        try {
            $allUsers=User::where('id','!=',1)
                        ->where('id','!=',auth()->user()->id)
                        ->latest()
                        ->paginate($limit = 10, $columns = ['*']);
            /**
             * TODO: use for future work in user profile page
             * $allUsers = $this->userRepository->paginate($limit = 10, $columns = ['*']);
             */ 
            $i = 1;
            $states = State::all();
            return view('admin.layouts.pages.users.users', compact('allUsers', 'i', 'states'));
        } 
        catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function searchByName(){
        $title = $_GET['name'];
        $email = $_GET['email'];
        $i = 1;
        $allUsers = Role::where('name', 'User')->first()->users()->where([
            ['name', 'LIKE', '%' . $title . '%'],
            ['email', 'LIKE', '%' . $email . '%'],
            ])->paginate(10);

        return view('admin.layouts.pages.users.users', compact('allUsers','i'));
    }

    public function addPropertyManagerForm()
    {   
        return view('admin.layouts.pages.users.addPropertyManagerForm');
    }

    public function storePropertyManager(Request $request)
    {
        try 
        {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            
            $input = $request->all();
            $user = User::where('email',$request->email)->first();
            if (!empty($user)) 
            {
                return response()->json(['status' => true, 'message' => 'Property Manager already exists.']);
            }
            
            $user = User::create(
                [
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'phone' => $request->get('phone'),
                    'email' => $request->get('email'),
                    'password'=>Hash::make($request->password),
                    'status'=> 1,
                    'verified'=>1
                ]);

            $role=\App\Models\Role::whereName('Property Manager')->first();
            $user->attachRole($role);
            return redirect('admin/users')->with('success','Property Manager added successfully.');
        } 
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
        return $request;
    }

    public function addSubAdminForm()
    {
        return view('admin.layouts.pages.users.addSubAdminForm');
    }

    public function storeSubAdmin(Request $request)
    {

        try 
        {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $input = $request->all();
            $user = User::where('email',$request->email)->first();
            if (!empty($user)) 
            {
                return response()->json(['status' => true, 'message' => 'Admin already exists.']);
            }
            
            $user = User::create(
                [
                    'first_name' => $request->get('first_name'),
                    'last_name' => $request->get('last_name'),
                    'phone' => $request->get('phone'),
                    'email' => $request->get('email'),
                    'password'=>Hash::make($request->password),
                    'status'=> 1,
                    'verified'=>1
                ]);

            $role=\App\Models\Role::whereName('Admin')->first();
            $user->attachRole($role);
            return redirect('admin/users')->with('success','Admin added successfully.');
        } 
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
        return $request;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $currentUser = User::findorfail($request->input('userid'));
            if($request->input('status')){
            if ($request->input('status') == 'false') {
                $currentUser->status = 0;
            } else {
                $currentUser->status = 1;
            }
            }elseif ($request->input('verified')){
                if ($request->input('verified') == 'false') {
                    $currentUser->verified = 0;
                } else {
                    $currentUser->verified = 1;
                }
            }
            $currentUser->save();
            return response()->json(['success' => 'User Status Updated .']);

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $currentUser = $this->userRepository->with('plan')->find($id);
            return view('admin.layouts.pages.users.show', compact('currentUser'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }   //
    }

    // functiopn for update user status
    public function changeStatus(Request $request)
    {
        $input = $request->all();
        $currentUser = User::findorfail($input->userid);
        $currentUser->status = $input->status;
        $currentUser->save();
        return response()->json(['success' => 'User Status Updated .']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {        
        try {
            $currentUser = $this->userRepository->with(['roles', 'statuses'])->find($id);
            $allRoles = Role::get();
            $states = State::get();

            $allStatuses = Status::where('type', 'User')->get();
            return view('admin.layouts.pages.users.edit', compact('currentUser', 'allRoles', 'allStatuses','states'));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function updatePassword(Request $request, $id)
    {
        try
        {
            $validator = Validator::make($request->all(), [
                'new_password' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $user = User::findorfail($id);
            $user->password = Hash::make($request->new_password);
            $user->save();
            
            return back()->with('success','Password updated successfully.');
        }
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function cancelUserSubscription(Request $request)
    {
        $userId = $request->userID; 
        $user = User::findorfail($userId);        
        $user->email = $user->email.'_'.time();
        $user->save();

        if($user->role->role->id==2 && $user->stripe_id!=null)
        {
            $user->subscription('default')->cancel();
        }
        if($user->delete())
        {
            return response()->json(['status' => true, 'message' => 'User deleted successfully.']);
        }        
        else
        {
            return response()->json(['status' => false, 'message' => 'Could not delete user.']);
        }
        // return $request->all();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try 
        {
            $currentUser = User::findorfail($id);

            if(!empty($currentUser))
            {
                if($currentUser->role->role->id==2)
                {
                    $validator = Validator::make($request->all(), [
                        'name' => 'required',
                        'email' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
                    }
                    $input = $request->all();
                    // TODO: For future Use
                    // if ($input['role']) 
                    // {
                    //     $exists = UserRole::where('user_id', $id)->first();
                    //     if ($exists) 
                    //     {
                    //         $exists->update([
                    //             'role_id' => $input['role'],
                    //         ]);
                    //     } 
                    //     else 
                    //     {
                    //         UserRole::create([
                    //             'user_id' => $id,
                    //             'role_id' => $input['role'],
                    //         ]);
                    //     }

                    // }
                    if (isset($input['photo'])) 
                    {
                        if ($request->hasFile('photo')) 
                        {
                            $imageName = $this->fileUpload($request);
                            if ($currentUser->photo && \File::exists(public_path('/uploads/user_profile/') . $currentUser->photo)) 
                            {
                                unlink(public_path('/uploads/user_profile/') . $currentUser->photo);
                            }
                            $input['photo'] = $imageName;
                        }
                    } 
                    else 
                    {
                        $input['photo'] = $currentUser->photo;
                    }

                    $this->userRepository->update(
                        [
                            'name' => $request->get('name'),
                            'email' => $request->get('email'),
                            'photo' => $input['photo'],
                            'first_name' => $input['first_name'],
                            'last_name' => $input['last_name'],
                            'phone' => $input['phone'],
                            'date_of_birth' => $input['date_of_birth'],
                            'social_security_number' => $input['social_security_number'],
                            'street' => $input['street'],
                            'city' => $input['city'],
                            'state' => $input['state'],
                            'state' => $input['state'],
                        ], $id);
                    return back()->with('success','Data updated successfully.');
                }
                else
                {
                    $validator = Validator::make($request->all(), [
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'phone' => 'required',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
                    }
                    $input = $request->all();
                    $this->userRepository->update(
                        [
                            'first_name' => $request->get('first_name'),
                            'last_name' => $request->get('last_name'),
                            'phone' => $request->get('phone'),
                        ], $id);
                    return back()->with('success','Data updated successfully.');
                }
            }
        } 
        catch (\Exception $e) 
        {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::where('id',$id)->first();
            $user->email = $user->email.'_'.time();
            $user->save();
            if($user->role->role->id==2 && $user->stripe_id!=null)
            {
                $user->subscription('default')->cancel();
            }
            $this->userRepository->delete($id);
            return back();
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /* =========================================================================================
            Description: stripe billing detail of all user
            ----------------------------------------------------------------------------------------
            ========================================================================================== */
    public function billingInfo()
    {
        try {
            // $allUsers = $this->userRepository->with('plan')->paginate($limit = 10, $columns = ['*']);
            $userIds = UserRole::where('role_id',2)->pluck('user_id');
            $allUsers=User::whereIn('id',$userIds)
                        ->latest()
                        ->paginate($limit = 10, $columns = ['*']);
            $i = 1;
            return view('admin.layouts.pages.users.billingInfo.index', compact('allUsers', 'i'));
        } catch (\Exception $e) {
            return back();
        }
    }

    /* =========================================================================================
          Description: stripe billing detail of selected user
          ----------------------------------------------------------------------------------------
          ========================================================================================== */
    public function billingDetail($id)
    {
        try {
            $currentUser = $this->userRepository->with('plan')->find($id);
            return view('admin.layouts.pages.users.billingInfo.show', compact('currentUser'));
        } catch (\Exception $e) {
            return back();
        }
    }

    private function fileUpload($request)
    {
        try {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/user_profile');
            $image->move($destinationPath, $imageName);
            return $imageName;

        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }
}


