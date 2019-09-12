<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreUserSetting;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\View\View
     */
    public function edit(): View
    {
        return view('user.setting.edit', [
            'categories'    => Category::whereDoesntHave('parent')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserSetting  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreUserSetting $request): RedirectResponse
    {
        $settings = collect($request->input('settings'));
        $transformedSettings = $settings->transform(function ($value, $id) {
            return !empty($value) ? ['value' => $value] : null;
        })->filter();

        $request
            ->user()
            ->settings()
            ->syncWithoutDetaching($transformedSettings);

        return redirect()->back()->with([
            'success' => 'Successfully saved.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
