<?php

namespace App\Http\Controllers\Admin\FullText;

use App\Models\FullText;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FullTextController extends Controller
{
    public function show(FullText $full_text_config)
    {
        return response()->file(storage_path($full_text_config->showFile()));
    }

    public function update(Request $request, FullText $full_text_config)
    {
        $full_text_config->status = $request->status;

        if ($full_text_config->save()) {
            return redirect()->route('admin.abstraction.edit', $full_text_config->abstraction->id)->with(['status' => 'success', 'message' => 'Status Changed Successfully']);
        }
        return redirect()->route('admin.abstraction.edit', $full_text_config->abstraction->id)->with(['status' => 'danger', 'message' => 'Reply Failed, Contact Developer']);
    }

    public function destroy(FullText $full_text_config)
    {
        if (Storage::exists($full_text_config->url)) {
            Storage::delete($full_text_config->url);
        }

        $parent = $full_text_config->abstraction->id;

        if ($full_text_config->delete()) {
            return redirect()->route('admin.abstraction.edit', $parent)->with(['status' => 'success', 'message' => 'Delete Successfully']);
        }
        return redirect()->route('admin.abstraction.edit', $parent)->with(['status' => 'danger', 'message' => 'Delete Failed, Contact Developer']);
    }
}
