<?php

namespace App\Http\Controllers;

use App\Models\Tips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TipsController extends Controller
{
    public function index()
    {
        $tips = Tips::paginate(9);
        return view('dashboard.tips.tips', ['tips' => $tips]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'banner' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // 2MB max
            'description' => ['required', 'string'],
        ]);

        // Store the uploaded banner image
        $bannerPath = $request->file('banner')->store('tips_banners', 'public');
        $data['banner'] = $bannerPath;

        Tips::create($data);

        return redirect()->route('tips.index');
    }

    public function add()
    {
        return view('dashboard.tips.tipsadd');
    }

    public function show(Tips $tip)
    {
        return view('dashboard.tips.tipsedit', ['tip' => $tip]);
    }

    public function update(Request $request, Tips $tip)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'banner' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // optional on update
            'description' => ['required', 'string'],
        ]);

        // Handle banner update if new image is provided
        if ($request->hasFile('banner')) {
            // Delete old banner if exists
            if ($tip->banner) {
                Storage::disk('public')->delete($tip->banner);
            }

            $bannerPath = $request->file('banner')->store('tips_banners', 'public');
            $data['banner'] = $bannerPath;
        }

        $tip->update($data);

        return redirect()->route('tips.index');
    }

    public function destroy(Tips $tip)
    {
        // Delete associated banner file
        if ($tip->banner) {
            Storage::disk('public')->delete($tip->banner);
        }

        $tip->delete();

        return redirect()->route('tips.index');
    }
}
