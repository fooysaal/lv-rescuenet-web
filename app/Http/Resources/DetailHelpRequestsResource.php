<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailHelpRequestsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'requested_user' => [
                'name' => $this->user->name,
                'phone' => $this->user->phone,
            ],
            'type' => $this->type,
            'description' => $this->description,
            'location' => [
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'name' => $this->location_name,
            ],
            'attached_files' => $this->files->map(function ($file) {
                return [
                    'id' => $file->id,
                    'url' => asset('storage/' . $file->file_path),
                    'uploaded_at' => $file->created_at,
                ];
            }),
            'request_logs' => $this->requestLogs->map(function ($log) {
                return [
                    'id' => $log->id,
                    'performed_by' => $log->performedBy ? $log->performedBy->name : 'System',
                    'action' => $log->action,
                    'note' => $log->note,
                    'performed_at' => $log->created_at,
                ];
            }),
            'flagged_reports' => $this->flagReports->map(function ($flag) {
                return [
                    'id' => $flag->id,
                    'reported_user_id' => $flag->reported_by_user_id,
                ];
            }),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
