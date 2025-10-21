<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralSetting;

class GeneralSettings extends Component
{
    use WithFileUploads;

    public $pageTitle = "General Settings";

    public $app_name;
    public $app_email;
    public $app_contact;
    public $app_address;
    public $app_logo;
    public $oldAppLogo;
    public $institute_logo;
    public $oldInstituteLogo;
    public $app_favicon;
    public $oldAppFavicon;


    public function mount()
    {
        // Load existing settings if available
        $settings = GeneralSetting::first();
        if ($settings) {
            $this->app_name = $settings->app_name;
            $this->app_contact = $settings->app_contact;
            $this->app_email = $settings->app_email;
            $this->app_address = $settings->app_address;
            $this->oldAppLogo = $settings->app_logo;
            $this->oldInstituteLogo = $settings->institute_logo;
            $this->oldAppFavicon = $settings->app_favicon;
        }
    }

    protected function rules()
    {
        return [
            'app_name' => 'required|string|max:255',
            'app_contact' => 'nullable|string|max:50',
            'app_email' => 'required|email|max:255',
            'app_address' => 'required|string|max:500',
            'app_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'institute_logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'app_favicon' => 'nullable|image|mimes:png,ico|max:1024',
        ];
    }

    protected array $messages = [
        'app_name.required' => 'Please enter the application name.',
        'app_name.max' => 'Application name cannot exceed 255 characters.',
        'app_email.required' => 'Please enter the application email.',
        'app_email.email' => 'The email must be a valid email address.',
        'app_email.max' => 'Email cannot exceed 255 characters.',
        'app_contact.max' => 'Contact cannot exceed 50 characters.',
        'app_address.required' => 'Please enter the application address.',
        'app_address.max' => 'Address cannot exceed 500 characters.',
        'app_logo.image' => 'The site logo must be an image.',
        'app_logo.mimes' => 'Site logo must be a file of type: jpg, jpeg, png, webp, gif.',
        'app_logo.max' => 'Site logo cannot exceed 2MB.',
        'institute_logo.image' => 'The institute logo must be an image.',
        'institute_logo.mimes' => 'Institute logo must be a file of type: jpg, jpeg, png, webp, gif.',
        'institute_logo.max' => 'Institute logo cannot exceed 2MB.',
        'app_favicon.image' => 'The favicon must be an image.',
        'app_favicon.mimes' => 'Favicon must be a PNG or ICO file.',
        'app_favicon.max' => 'Favicon cannot exceed 1MB.',
    ];



    public function storeGeneralSettingData()
    {
        $this->validate();

        $settings = GeneralSetting::first() ?? new GeneralSetting();

        $settings->app_name = $this->app_name;
        $settings->app_contact = $this->app_contact;
        $settings->app_email = $this->app_email;
        $settings->app_address = $this->app_address;

        if ($this->app_logo) {
            if ($this->oldAppLogo && Storage::disk('public')->exists($this->oldAppLogo)) {
                Storage::disk('public')->delete($this->oldAppLogo);
            }
            $settings->app_logo = $this->app_logo->store('settings', 'public'); // notice 'public' disk
        }

        if ($this->institute_logo) {
            if ($this->oldInstituteLogo && Storage::disk('public')->exists($this->oldInstituteLogo)) {
                Storage::disk('public')->delete($this->oldInstituteLogo);
            }
            $settings->institute_logo = $this->institute_logo->store('settings', 'public');
        }

        if ($this->app_favicon) {
            if ($this->oldAppFavicon && Storage::disk('public')->exists($this->oldAppFavicon)) {
                Storage::disk('public')->delete($this->oldAppFavicon);
            }
            $settings->app_favicon = $this->app_favicon->store('settings', 'public');
        }


        $settings->save();

        $this->oldAppLogo = $settings->app_logo;
        $this->oldInstituteLogo = $settings->institute_logo;
        $this->oldAppFavicon = $settings->app_favicon;

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Settings data updated successfully!',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.general-settings');
    }
}
