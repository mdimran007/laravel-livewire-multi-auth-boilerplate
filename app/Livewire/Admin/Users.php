<?php

namespace App\Livewire\Admin;


use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Mail\UserCreatedMail;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    protected $listeners = ['delete-goal' => 'delete'];

    use WithFileUploads;

    public $pageTitle = "Users";

    public $users, $user_id, $name, $email, $role, $phone, $dob, $gender, $image, $oldImage, $password;
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
        $userList = User::query()
            ->where('role', '!=', USER_ROLE_ADMIN)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('livewire.admin.user', [
            'userList' => $userList,
        ]);
    }

    // Open create modal
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

    // Store or update user
    public function userStore()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'role' => 'required',
            'email' => [
                'required',
                'email',
                $this->user_id
                    ? Rule::unique('users', 'email')->ignore($this->user_id)
                    : Rule::unique('users', 'email')
            ],
            'password' => $this->user_id ? 'nullable|min:8' : 'required|min:8',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date|before:today',
            'gender' => 'nullable|in:' . GENDER_MALE . ',' . GENDER_FEMALE . ',' . GENDER_OTHERS,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
        ];


        $this->validate($rules);

        $user = $this->user_id ? User::findOrFail($this->user_id) : new User();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = USER_ROLE_STAFF;
        $user->phone = $this->phone;
        $user->dob = $this->dob;
        $user->gender = $this->gender;

        if (!$this->user_id) {
            $user->email_verified_at = now();
            $user->created_by = auth()->id();
        }

        if ($this->image) {
            $path = $this->image->store('users', 'public');
            $user->picture = $path;
        }

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();


        // $user->syncRoles($this->role);

        $role = Role::findOrFail($this->role);
        $user->syncRoles($role->name);

        if (!$this->user_id) {
            Mail::to($user->email)->send(new UserCreatedMail($user, $this->password));
        }

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => $this->user_id ? 'User updated successfully.' : 'User created successfully.',
        ]);

        $this->closeUserModal();
    }


    public function delete($id)
    {
        $data = User::findOrFail($id);

        // Delete image if exists
        if ($data->images && \Storage::disk('public')->exists($data->images)) {
            \Storage::disk('public')->delete($data->images);
        }

        $data->delete();

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Deleted successfully!',
        ]);

        return redirect()->route('admin.users');
    }

    // Reset fields
    private function resetFields()
    {
        $this->reset(['user_id', 'name', 'email', 'role', 'phone', 'dob', 'gender', 'image', 'oldImage']);
        $this->resetValidation();
    }
}
