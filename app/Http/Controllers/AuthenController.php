<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:12',
        ]);

        $user = $this->userRepository->createUser($request->only(['name', 'email', 'password']));

        if ($user) {
            return redirect()->intended('login')->with('success_message', 'You have registered successfully.');
        } else {
            return back()->with('fail', 'Something went wrong!');
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|max:12',
        ]);

        $user = $this->userRepository->findByEmail($request->email);
        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('loginId', $user->id);
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success_message', 'Login successful!');
        } else {
            return back()->with('error_message', 'Invalid email or password.');
        }
    }

    public function dashboard()
    {
        $data = null;
        if (Session::has('loginId')) {
            $data = $this->userRepository->findById(Session::get('loginId'));
        }

        return view('dashboard', compact('data'));
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('login')->with('success_message', 'Logged out successfully.');
        }
    }

    public function editProfile()
    {
        $userId = $this->userRepository->getCurrentUserId();
        $user = $this->userRepository->findById($userId);
        return view('user.profileedit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $userId = $this->userRepository->getCurrentUserId();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
        ]);

        $user = $this->userRepository->updateUser($userId, $request->only(['name']));
        if ($user) {
            return redirect()->route('dashboard')->with('success_message', 'Profile updated successfully!');
        } else {
            return back()->with('fail', 'Failed to update profile.');
        }
    }

    public function inactiveUser()
    {
        return view('user.inactive');
    }

}
