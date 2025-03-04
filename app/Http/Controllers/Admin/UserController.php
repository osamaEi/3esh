<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->userRepository->findById($id);
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $this->userRepository->create($data);
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
        ]);

        $this->userRepository->update($id, $data);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    public function attachSubscription(Request $request, $user_id)
    {
        $sub_id = $request->input('subscription_id');
        $this->userRepository->attachSubscription($user_id, $sub_id);
        return redirect()->route('admin.users.show', $user_id)->with('success', 'Subscription attached successfully.');
    }

    public function block($id)
{
    $user = $this->userRepository->findById($id);
    $user->update(['is_blocked' => true]);
    return redirect()->back()->with('success', 'User blocked successfully.');
}

public function unblock($id)
{
    $user = $this->userRepository->findById($id);
    $user->update(['is_blocked' => false]);
    return redirect()->back()->with('success', 'User unblocked successfully.');
}

public function activate($id)
{
    $user = $this->userRepository->findById($id);
    $user->update(['is_active' => true]);
    return redirect()->back()->with('success', 'User activated successfully.');
}

public function deactivate($id)
{
    $user = $this->userRepository->findById($id);
    $user->update(['is_active' => false]);
    return redirect()->back()->with('success', 'User deactivated successfully.');
}
}