<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileUpdate extends Component
{
    use WithFileUploads;

    public $pageTitle = "Profile Update";
    public $name;
    public $email;
    public $phone;
    public $dob;
    public $gender;
    public $image;
    public $oldImage;

    public $current_password;
    public $password;
    public $password_confirmation;


    public function passwordUpdate(){
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'current_password.required' => 'Please enter your current password.',
            'current_password.current_password' => 'Your current password is incorrect.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'The new password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        $user = Auth::user();

        // Update the password
        $user->update([
            'password' => Hash::make($this->password),
        ]);

        // Clear the fields
        $this->reset(['current_password', 'password', 'password_confirmation']);

        // Show success toast
        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Password updated successfully!',
        ]);
    }

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
        $this->dob = $user->dob ?? '';
        $this->gender = $user->gender ?? '';
        $this->oldImage = $user->picture;
    }

    protected function rules()
    {
        return [
            'name'   => 'required|string|min:3|max:100',
            'email'  => 'required|email|unique:users,email,' . Auth::id(),
            'phone'  => 'nullable|string|max:20',
            'dob'    => 'nullable|date|before:today',
            'gender' => 'nullable|in:1,2,3',
            'image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'email.unique' => 'This email is already in use.',
        'image.image' => 'The uploaded file must be an image.',
        'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP images are allowed.',
        'image.max' => 'Image size must not exceed 2MB.',
    ];

    public function profileUpdate()
    {

        $this->validate();


        $user = Auth::user();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'dob' =>   $this->dob ?: null,
            'gender' => $this->gender ?: null,
            'status' => STATUS_ACTIVE,
        ];

        // dd($data);

        // Handle image upload
        if ($this->image) {
            $path = $this->image->store('profile_images', 'public');
            $data['picture'] = $path;
        }

        $user->update($data);

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Profile updated successfully!',
        ]);

    }

    public function render()
    {
        return view('livewire.admin.profile-update');
    }
}
