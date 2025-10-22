<?php

namespace App\Livewire\Admin;


use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Users extends Component
{
    use WithFileUploads;

    public $pageTitle = "Users";

    public $users, $user_id, $name, $email, $role, $phone, $dob, $gender, $image, $oldImage;
    public $userModalOpen = false;
    public $isEdit = false;

        protected $messages = [
        'name.required' => 'Please enter user name.',
        'name.string' => 'Name must be valid text.',
        'email.required' => 'Please enter email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already registered.',
        'role.required' => 'Please select a user role.',
        'gender.required' => 'Please select gender.',
        'image.image' => 'Only image files are allowed.',
        'image.mimes' => 'Image must be jpg, jpeg, png, webp, or gif.',
        'dob.before' => 'Date of birth must be before today.',
    ];

    public function render()
    {
        $this->users = User::latest()->get();
        return view('livewire.admin.user');
    }

    // Open create modal
    public function openUserModal()
    {
        $this->resetFields();
        $this->userModalOpen = true;
        $this->isEdit = false;
    }

    // Close modal
    public function closeUserModal()
    {
        $this->userModalOpen = false;
        $this->resetValidation();
    }

    // Store or update user
    public function profileUpdate()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                $this->user_id
                    ? Rule::unique('users', 'email')->ignore($this->user_id)
                    : Rule::unique('users', 'email')
            ],
            'role' => 'required|in:2,3',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date|before:today',
            'gender' => 'required|in:male,female,others',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ];

        $this->validate($rules);

        $user = $this->user_id ? User::findOrFail($this->user_id) : new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->phone = $this->phone;
        $user->dob = $this->dob;
        $user->gender = $this->gender;

        if ($this->image) {
            $path = $this->image->store('users', 'public');
            $user->image = $path;
        }

        if (!$this->user_id) {
            $user->password = Hash::make('123456'); // Default password for new users
        }

        $user->save();

        session()->flash('success', $this->user_id ? 'User updated successfully.' : 'User created successfully.');
        $this->closeUserModal();
    }

    // Edit user
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->phone = $user->phone;
        $this->dob = $user->dob;
        $this->gender = $user->gender;
        $this->oldImage = $user->image;

        $this->isEdit = true;
        $this->userModalOpen = true;
    }

    // Delete user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->image && file_exists(storage_path('app/public/' . $user->image))) {
            unlink(storage_path('app/public/' . $user->image));
        }
        $user->delete();
        session()->flash('success', 'User deleted successfully.');
    }

    // Reset fields
    private function resetFields()
    {
        $this->reset(['user_id', 'name', 'email', 'role', 'phone', 'dob', 'gender', 'image', 'oldImage']);
        $this->resetValidation();
    }
}
