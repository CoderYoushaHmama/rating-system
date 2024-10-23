<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddServiceRequest;
use App\Http\Requests\EditServiceRequest;
use App\Models\Notification;
use App\Models\Section;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    //Get Services Page Function
    public function getServicesPage(Request $request)
    {
        $service_merge = [];
        $user = Auth::guard('user')->user();
        if ($user->account_type == 'service provider') {
            $services = Service::whereHas('section', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('service_name', 'LIKE', '%' . $request->search . '%')->with('images')->get();
        } else {
            $services = Service::where('service_name', 'LIKE', '%' . $request->search . '%')->with('images')->get();
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

        $in_section = false;
        $services = $service_merge;
        return view('services.services', compact('services', 'user', 'in_section'));
    }

    //Get Section Services Page Function
    public function getSectionServicesPage(Section $section, Request $request)
    {
        $user = Auth::guard('user')->user();
        $service_merge = [];
        if ($section->user_id != $user->id && $user->account_type == 'service provider') {
            return redirect()->back();
        }
        $services = $section->services()->where('service_name', 'LIKE', '%' . $request->search . '%')->with('images')->get();
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
        $in_section = true;
        $services = $service_merge;
        return view('services.services', compact('services', 'user', 'in_section', 'section'));
    }

    //Add Service Page Function
    public function addServicePage(Section $section)
    {
        $user = Auth::guard('user')->user();
        $service_types = ServiceType::all();
        if ($user->id == $section->user_id) {
            return view('services.add_service', compact('section', 'service_types'));
        }

        return redirect()->back();
    }

    //Edit Service Page Function
    public function editServicePage(Service $service)
    {
        $user = Auth::guard('user')->user();
        $section = Section::find($service->section_id);
        $service_types = ServiceType::all();
        if ($user->account_type == 'service provider' && $section->user_id != $user->id) {
            return redirect()->back();
        }
        return view('services.edit_service', compact('service', 'service_types'));
    }

    //Get Service Information Page Function
    public function getServiceInformationPage(Service $service)
    {
        $user = Auth::guard('user')->user();
        $total_rates = 0;
        foreach ($service->rates as $rate) {
            $total_rates += $rate->stars;
        }
        if ($total_rates > 0)
            $total_rates = $total_rates / count($service->rates);
        return view('services.service_information', compact('service', 'user', 'total_rates'));
    }

    //Add Service Function
    public function addService(AddServiceRequest $addServiceRequest, Section $section)
    {
        $user = Auth::guard('user')->user();
        $service = Service::create([
            'section_id' => $section->id,
            'service_type_id' => $addServiceRequest->service_type,
            'service_name' => $addServiceRequest->service_name,
            'service_price' => $addServiceRequest->service_price,
        ]);
        $images = $addServiceRequest->file('images');
        foreach ($images as $image) {
            $path = $image->storePublicly('ServicesImages', 'public');

            ServiceImage::create([
                'service_id' => $service->id,
                'image' => 'storage/' . $path,
            ]);
        }
        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' created a service',
            'type' => 'insert',
        ]);
        return redirect('/services/' . $section->id)->with('success', 'your service added successfully');
    }

    //Edit Service Function
    public function editService(EditServiceRequest $editServiceRequest, Service $service)
    {
        $user = Auth::guard('user')->user();
        if ($service->imges == '[]') {
            $editServiceRequest->validated([
                'images' => 'required',
            ]);
        }

        if ($editServiceRequest->file('images')) {
            foreach ($editServiceRequest->file('images') as $image) {
                $path = $image->storePublicly('ServicesImages', 'public');
                ServiceImage::create([
                    'service_id' => $service->id,
                    'image' => 'storage/' . $path,
                ]);
            }
        }

        $service->update([
            'service_name' => $editServiceRequest->service_name,
            'service_price' => $editServiceRequest->service_price,
            'service_type_id' => $editServiceRequest->service_type,
        ]);

        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' edited a service: ' . $service->service_name,
            'type' => 'update',
        ]);

        return redirect('/services/' . $service->section_id)->with('success', 'your service updated successfully');
    }

    //Delete Service Image Function
    public function deleteServiceImage(ServiceImage $serviceImage)
    {
        $user = Auth::guard('user')->user();
        $service = Service::find($serviceImage->service_id);
        if (count($service->images) > 1) {
            if (File::exists($serviceImage->image)) {
                File::delete($serviceImage->image);
            }
            $serviceImage->delete();
            Notification::create([
                'user_id' => $user->id,
                'description' => $user->full_name . ' deleted an image of service: ' . $service->service_name,
                'type' => 'delete',
            ]);
        } else {
            return response()->json(['error' => 'you shoulad add at least on image'], 422);
        }
    }

    //Delete Service Function
    public function deleteService(Service $service)
    {
        $user = Auth::guard('user')->user();
        foreach ($service->images as $image) {
            if (File::exists($image->image)) {
                File::delete($image->image);
            }
            $image->delete();
        }

        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' deleted a service: ' . $service->service_name,
            'type' => 'delete',
        ]);
        $service->delete();
        return redirect('/services/' . $service->section_id)->with('success', 'your service deleted successfully');
    }
}