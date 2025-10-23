<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class UserRolePermission extends Component
{
    protected $listeners = ['delete-goal' => 'delete'];

    public $pageTitle = "Role List";

     use WithPagination;

    public $name, $role_id;

    protected $rules = [
        'name' => 'required|string|max:255|unique:roles,name',
    ];

    public $userModalOpen = false;
    public $isEdit = false;

    public $email_verified_at;
    public $created_by;
    public $roleList;
    public $assignRole;

    protected $messages = [
        'role.required' => 'Please select a user role.',
        'name.required' => 'Please enter user name.',
        'name.string' => 'Name must be valid text.',
        'email.required' => 'Please enter email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
        'role.required' => 'Please select a user role.',
        'gender.required' => 'Please select gender.',
        'image.image' => 'Only image files are allowed.',
        'image.mimes' => 'Image must be jpg, jpeg, png, webp, or gif.',
        'dob.before' => 'Date of birth must be before today.',
    ];

    public function mount()
    {
        $this->roleList = Role::all();
    }


    public function render()
    {
        return view('livewire.admin.user-role-permission');
    }

     public function openUserModal($id = null)
    {
        if ($id) {
            $user = User::with(['roles'])->findOrFail($id);
            $this->user_id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            // $this->role = $user->role;
            $this->phone = $user->phone;
            $this->dob = $user->dob;
            $this->gender = $user->gender;
            $this->oldImage = $user->image;
            $this->isEdit = true;
            $this->role = isset($user->roles[0]) ? $user->roles[0]->id : null;
        } else {
            $this->resetFields();
            $this->isEdit = false;
        }
        $this->userModalOpen = true;
    }

    // Close modal
    public function closeUserModal()
    {
        $this->userModalOpen = false;
        $this->resetValidation();
    }
}
