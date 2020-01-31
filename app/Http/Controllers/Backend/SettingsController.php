<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $data['adminSettings'] = Settings::all()->sortBy('setting_must');
        return view('backend.settings.index', compact('data'));
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $settings = Settings::find(intval($value));
            $settings->settings_must = intval($key);
            $settings->save();
        }

        echo true;
    }

    public function destroy($id)
    {
        $settings = Settings::find($id);
        if ($settings->delete()) {
            return back()->with('success', 'Successfully deleted');
        }
        return back()->with('error', 'Not successfully deleted');
    }

    public function edit($id)
    {
        $settings = Settings::where('id', $id)->first();
        return view('backend.settings.edit')->with('settings', $settings);
    }

    public function update(Request $request, $id)
    {

        if ($request->hasFile('settings_value')) {
            $request->validate([
                'settings_value' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $fileName = uniqid() . '.' . $request->settings_value->getClientOriginalExtension();
            $request->settings_value->move(public_path('images/settings', $fileName));
            $request->settings_value = $fileName;
        }

        $settings = Settings::where('id', $id)->update([
            'settings_value' => $request->settings_value
        ]);

        if ($settings) {

            $path = 'images/settings/' . $request->oldFile; //evvelki fayli silmir
            if (file_exists($path)) {
                @unlink(public_path($path));
            }

            return back()->with("success", "Succesfully updated");
        }

        return back()->with("error", "Not succesfully updated");

    }
}













