<?php

namespace App\Livewire\Admin;


use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SdgReport as SdgReportData;

class SdgReport extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $file;
    public $oldFile;
    public $report;
    public $image;
    public $existingImage;

    protected $rules = [
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048', // max 2MB
        'description' => 'nullable|string',
        'file' => 'nullable|file|max:2048', // nullable and max 2MB
    ];

    public function mount()
    {
        // Load the first existing record (if any)
        $this->report = SdgReportData::first();

        if ($this->report) {
            $this->title = $this->report->title;
            $this->existingImage = $this->report->images;
            $this->description = $this->report->description;
            $this->oldFile = $this->report->file;
        }

    }

    public function updateSdgReportData()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // max 2MB
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:2048', // 2MB
        ]);

        // Handle image upload
        if ($this->image) {
            // Delete old image if exists
            if ($this->existingImage && \Storage::disk('public')->exists($this->existingImage)) {
                \Storage::disk('public')->delete($this->existingImage);
            }
            // Store new image
            $this->existingImage = $this->image->store('sdg_report_images', 'public');
        }

        // Determine old file path if updating
        $oldFilePath = $this->report?->file ?? null;

        // Handle new file upload
        $path = $oldFilePath;
        if ($this->file) {
            // Delete old file if exists
            if ($oldFilePath && \Storage::disk('public')->exists($oldFilePath)) {
                \Storage::disk('public')->delete($oldFilePath);
            }
            // Store new file
            $path = $this->file->store('sdg_reports', 'public');
        }


        // Update existing or create new record
        $this->report = SdgReportData::updateOrCreate(
            ['id' => $this->report?->id], // null will create new
            [
                'title' => $this->title,
                'description' => $this->description,
                'file' => $path,
                'images' => $this->existingImage,
            ]
        );

        $this->dispatch('toast', [
            'icon' => 'success',
            'title' => $this->report->wasRecentlyCreated
                ? 'Report created successfully!'
                : 'Report updated successfully!',
        ]);

        return redirect()->route('admin.sdg-report.index');
    }


    public function render()
    {
        return view('livewire.admin.sdg-report');
    }
}
