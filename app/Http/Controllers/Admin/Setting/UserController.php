<?php

namespace App\Http\Controllers\Admin\Setting;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * @var User $user
     */
    protected $user;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['models'] = User::where('level', '<>', 0)->latest()->paginate(10);
        return view('admin.setting.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.setting.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'username' => ['required', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($this->user->create($request->except('password') + ['email' => '-', 'level' => 1, 'password' => bcrypt($request->password)])) {
            return redirect()->route('admin.user.index')->with(['status' => 'success', 'message' => 'Save Successfully']);
        }
        return redirect()->route('admin.user.create')->with(['status' => 'danger', 'message' => 'Save Failed, Contact Developer']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.setting.user.edit', ['model' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
        ]);

        if ($request->username != $user->username) {
            $request->validate([
                'username' => ['required', 'unique:users,username'],
            ]);
        }

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            $update = $user->update($request->except('password') + ['email' => '-', 'password' => bcrypt($request->password)]);
        } else {
            $update = $user->update($request->except('password') + ['email' => '-']);
        }

        if ($update) {
            return redirect()->route('admin.user.index')->with(['status' => 'success', 'message' => 'Update Successfully']);
        }
        return redirect()->route('admin.user.edit', $user->id)->with(['status' => 'danger', 'message' => 'Update Failed, Contact Developer']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            return redirect()->route('admin.user.index')->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.user.index')->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
