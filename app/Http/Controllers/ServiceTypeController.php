<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceTypeRequest;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceTypeController extends Controller
{
    //Get Service Type Page Function
    public function getServiceTypesPage()
    {
        $user = Auth::guard('user')->user();
        $service_types = ServiceType::all();

        return view('service_types.service_types', compact('service_types', 'user'));
    }

    //Add Service Type Page Function
    public function addServiceTypePage()
    {
        return view('service_types.add_service_type');
    }

    //Edit Service Type Page Function
    public function editServiceTypePage(ServiceType $serviceType)
    {
        return view('service_types.edit_service_type', compact('serviceType'));
    }

    //Add Service Type Function
    public function addServiceType(ServiceTypeRequest $serviceTypeRequest)
    {
        ServiceType::create([
            'type' => $serviceTypeRequest->type,
        ]);

        return redirect('/service_types')->with('success', 'this service type added successfully');
    }

    //Edit Service Type Function
    public function editServiceType(ServiceType $serviceType, ServiceTypeRequest $serviceTypeRequest)
    {
        $serviceType->update([
            'type' => $serviceTypeRequest->type,
        ]);

        return redirect('/service_types')->with('success', 'service type updated successfully');
    }

    //Delete Service Type Function
    public function deleteServiceType(ServiceType $serviceType)
    {
        $serviceType->delete();

        return redirect('/service_types')->with('success', 'service type deleted successfully');
    }
}
