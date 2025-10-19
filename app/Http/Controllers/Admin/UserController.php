<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use \App\Enums\UserStatus;
use App\Http\Requests\UserRequest;
use App\Mail\confirmMail;
use App\Models\Role;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\mail;
use Illuminate\Support\Facades\log;

class UserController extends Controller
{
    public $users;
    public $locale;


    public function __construct()
    {
        $this->locale = session()->get('locale');
        if ($this->locale == 'fa') {
            app()->setLocale('fa');
        } else {
            app()->setLocale('en');
        }
        log::info('information');
        Log::warning("warning");
        $data = Cache::remember('users', 24 * 60, function () {
            return User::query()->get();
        });
        $this->users = $data;
    }
    public function index()
    {
        session()->put('locale', 'en');
        $users = $this->users;
        return view('Admin.index', compact('users'));
    }



    public function deletedUsers()
    {
        $users = User::query()->onlyTrashed()->get();
        return view('Admin.index', compact('users'));
    }
    public function create()
    {
        return view('Admin.create');
    }
    public function user(User $id)
    {
        if (Gate::authorize('editUser', $id)) {
            $user = $id;
            return view('Admin.user', compact('user'));
        } else {
            return redirect()->route('admin.user');
        }
    }

    public function destroy($id)
    {
        $user = User::query()->find($id);
        Storage::disk('public')->delete('images/' . $user->image);
        // User::destroy($id);
        return redirect()->route('admin.deletedUsers');
    }
    public function hardDelete($id)
    {
        $user = User::query()->onlyTrashed()->find($id);
        $user->forceDelete();
        return redirect()->route('admin.deletedUsers');
    }




    public function store(Request $request)
    {
        $name = time() . '_' . $request->image->getClientOriginalName();
        $request->image->storeAs('images', $name, 'public');
        User::query()->create([
            'name' => $request->name,
            'family' => $request->family,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $name,
            'password' => Hash::make($request->password),
            'status' => $request->input('status', UserStatus::Active->value)
        ]);
        return redirect()->route('admin.users');
    }


    public function update(Request $request, User $id)
    {
        $user = User::query()->find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
        return redirect()->route('admin.users');
    }

    public function restore($id)
    {
        $user = User::query()->onlyTrashed()->find($id);
        $user->restore();
        return redirect()->route('admin.deletedUsers');
    }

    public function downloadImage($id)
    {
        $user = User::query()->find($id);
        return response()->download(public_path('images/' . $user->image));
    }
}
