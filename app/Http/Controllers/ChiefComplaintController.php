<?php

namespace App\Http\Controllers;

use App\Models\ChiefComplaint;
use App\Http\Responses\GlobalResponse;
use Illuminate\Http\Response;

class ChiefComplaintController extends Controller
{
    public function __invoke()
    {
        try {
            $complaints = ChiefComplaint::select('id', 'name')
                ->orderBy('name')
                ->get()
                ->toArray();

            return GlobalResponse::success($complaints, 'List data berhasil diambil');
        } catch (\Exception $e) {
            return GlobalResponse::error(
                'Failed to retrieve chief complaints',
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
