<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Section;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //Home Page Function
    public function homePage(Request $request)
    {
        $user = Auth::guard('user')->user();
        $section_merge = [];
        $service_merge = [];
        if ($request->all) {
            $sections = Section::where('section_name', 'LIKE', '%' . $request->all . '%')->get();
            $services = Service::with('images')->where('service_name', 'LIKE', '%' . $request->all . '%')->get();
        } else if ($request->sections) {
            $sections = Section::where('section_name', 'LIKE', '%' . $request->sections . '%')->get();
            $services = Service::with('images')->get();
        } else if ($request->services) {
            $sections = Section::all();
            $services = Service::with('images')->where('service_name', 'LIKE', '%' . $request->services . '%')->get();
        } else {
            $sections = Section::all();
            $services = Service::with('images')->get();
        }
        foreach ($sections as $section) {
            $total_rate = 0;
            foreach ($section->services as $service) {
                $service_rate = 0;
                foreach ($service->rates as $rate) {
                    $service_rate += $rate->stars;
                }
                if (count($service->rates) > 0)
                    $total_rate += $service_rate / count($service->rates);
            }
            if (count($section->services) > 0) {
                $total_rate = $total_rate / count($section->services);
            }
            $rate = [
                'total_rate' => $total_rate,
            ];
            $section_merge[] = array_merge($section->toArray(), $rate);
        }

        foreach ($services as $service) {
            $total_rate = 0;
            foreach ($service->rates as $rate) {
                $total_rate += $rate->stars;
            }
            if (count($service->rates) > 0)
                $total_rate = $total_rate / count($service->rates);
            $rate = [
                'total_rate' => $total_rate,
            ];

            $service_merge[] = array_merge($service->toArray(), $rate);
        }

        $sections = $section_merge;
        $services = $service_merge;
        $about_us = AboutUs::first();
        return view('home.home', ['sections' => $sections, 'services' => $services, 'user' => $user, 'about_us' => $about_us]);
    }
}
