<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSetting;
use Illuminate\Http\RedirectResponse;

class SettingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setting.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSetting  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreSetting $request): RedirectResponse
    {
        $setting = new Setting([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $category = Category::findOrFail($request->input('category_id'));
        $setting->category()->associate($category);

        $setting->save();

        return redirect()->back()->with([
            'success' => 'Successfully created.',
        ]);
    }
}
