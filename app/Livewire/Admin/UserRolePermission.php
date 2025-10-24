<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class UserRolePermission extends Component
{
    protected $listeners = ['delete-goal' => 'delete'];

    public $pageTitle = "Role List";

    use WithPagination;

    public $roleId;
    public $name;
    public $selectedPermissions = [];

    public $search;

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('roles', 'name')->ignore($this->roleId),
            ],
            'selectedPermissions' => 'required|array|min:1',
        ];
    }

    protected $messages = [
        'name.required' => 'The role name is required.',
        'name.unique' => 'This role name already exists.',
        'selectedPermissions.required' => 'Please select at least one permission.',
        'selectedPermissions.min' => 'Please select at least one permission.',
    ];

    public $roleModalOpen = false;
    public $isEdit = false;

    public function mount()
    {
        // $this->roleList = Role::all();
    }


    public function render()
    {
        $query = Role::query()
            ->when(
                $this->search,
                fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            )
            ->orderBy('id', 'desc');

        return view('livewire.admin.user-role-permission', [
            'roles' => $query->paginate(10),
        ]);
    }

    public function openRoleModal($id = null)
    {
        if ($id) {
             $role = Role::findOrFail($id);
            $this->roleId = $role->id;
            $this->name = $role->name;
            $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
            $this->isEdit = true;
        } else {
            $this->resetFields();
            $this->isEdit = false;
        }
        $this->roleModalOpen = true;
    }

    // Close modal
    public function closeRoleModal()
    {
        $this->roleModalOpen = false;
        $this->resetValidation();
    }

    private function resetFields()
    {
        $this->reset(['roleId', 'name', 'selectedPermissions']);
        $this->resetValidation();
    }

    public function roleStore()
    {
        $this->validate($this->rules(), $this->messages);

        if ($this->roleId) {
            // 🔹 Update existing role
            $role = Role::findOrFail($this->roleId);
            $role->update(['name' => $this->name]);
            $role->syncPermissions($this->selectedPermissions);
        } else {
            // 🔹 Create new role
            $role = Role::create([
                'name' => $this->name,
                'guard_name' => 'web',
            ]);
            $role->syncPermissions($this->selectedPermissions);
        }


        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => $this->roleId ? 'Role updated successfully.' : 'Role created successfully.',
        ]);

        $this->resetFields();

        // Optional event for modal or toast refresh
        $this->closeRoleModal();
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => 'Deleted successfully!',
        ]);

        return redirect()->route('admin.users.role-and-permission');
    }
}
