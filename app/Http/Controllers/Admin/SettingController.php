<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function updateAppearance(Request $request)
    {
        // Handle Logo Upload separately
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('branding', 'public');
            
            // Delete old logo if exists
            $oldLogo = Setting::where('key', 'customLogo')->first();
            if ($oldLogo && $oldLogo->value) {
                Storage::disk('public')->delete($oldLogo->value);
            }

            Setting::updateOrCreate(
                ['key' => 'customLogo'],
                ['value' => trim($path)]
            );

            return response()->json([
                'message' => 'Logo updated successfully.',
                'logo_url' => asset('storage/' . $path)
            ]);
        }

        // Handle other settings
        $settings = $request->only([
            'theme',
            'customPrimary',
            'customTopbar',
            'customSidebar',
            'customSidebarText',
            'customSidebarActive',
            'customMainBg',
            'customMainText',
            'customSecondaryText',
            'customSurface',
            'applyToTeacher',
            'applyToStudent',
            'navPos',
            'syncNavToTeacher'
        ]);

        foreach ($settings as $key => $value) {
            if ($key === 'applyToTeacher' || $key === 'applyToStudent' || $key === 'syncNavToTeacher') {
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
            }
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => is_array($value) ? json_encode($value) : trim($value)]
            );
        }

        return response()->json(['message' => 'Appearance settings updated successfully.']);
    }

    public function resetLogo()
    {
        $logo = Setting::where('key', 'customLogo')->first();
        if ($logo && $logo->value) {
            Storage::disk('public')->delete($logo->value);
            $logo->delete();
        }
        return response()->json(['message' => 'Logo reset to default.']);
    }

    public function getAppearance()
    {
        $settings = Setting::whereIn('key', [
            'theme',
            'customPrimary',
            'customTopbar',
            'customSidebar',
            'customSidebarText',
            'customSidebarActive',
            'customMainBg',
            'customMainText',
            'customSecondaryText',
            'applyToTeacher',
            'applyToStudent',
            'navPos',
            'syncNavToTeacher',
            'customLogo'
        ])->pluck('value', 'key');

        return response()->json($settings);
    }
}
