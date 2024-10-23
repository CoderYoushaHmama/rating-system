<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Notification;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SectionController extends Controller
{
    //Add Section Page Function
    public function addSectionPage()
    {
        return view('sections.add_section');
    }

    //Get Sections Page Function
    public function getSectionsPage(Request $request)
    {
        $section_merge = [];
        $user = Auth::guard('user')->user();
        if ($user->account_type === 'admin' || $user->account_type === 'regular user') {
            if ($request->search) {
                $sections = Section::where('section_name', 'LIKE', '%' . $request->search . '%')->get();
            } else {
                $sections = Section::all();
            }
        } else {
            if ($request->search) {
                $sections = Section::where('section_name', 'LIKE', '%' . $request->search . '%')->where('user_id', $user->id)->get();
            } else {
                $sections = $user->sections;
            }
        }
        foreach ($sections as $section) {
            $total_rate = 0;
            foreach ($section->services as $service) {
                $service_rate = 0;
                foreach ($service->rates as $rate) {
                    $service_rate += $rate->stars;
                }
                if (count($service->rates) > 0)
                    $total_rate = $service_rate / count($service->rates);
            }
            $rate = [
                'total_rate' => $total_rate,
            ];
            $section_merge[] = array_merge($section->toArray(), $rate);
        }

        $sections = $section_merge;
        return view('sections.sections', compact('user', 'sections'));
    }

    //Edit Section Page Function
    public function editSectionPage(Section $section)
    {
        $user = Auth::guard('user')->user();
        $user_section = $user->sections->find($section->id);
        return view('sections.edit_section', compact('section'));
    }

    //Add Section Function
    public function addSection(SectionRequest $sectionRequest)
    {
        $user = Auth::guard('user')->user();
        if ($sectionRequest->file('image')) {
            $path = $sectionRequest->file('image')->storePublicly('sectionsImages', 'public');
        }

        Section::create([
            'user_id' => Auth::guard('user')->user()->id,
            'section_name' => $sectionRequest->section_name,
            'image' => 'storage/' . $path,
        ]);
        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' created a section',
            'type' => 'insert',
        ]);

        return redirect('/sections')->with('success', 'your section added successfully');
    }

    //Edit Section Function
    public function editSection(Request $request, Section $section)
    {
        $user = Auth::guard('user')->user();
        $request->validate([
            'section_name' => 'required',
        ]);

        if ($request->file('image')) {
            if (File::exists($section->image)) {
                File::delete($section->image);
            }
            $path = $request->file('image')->storePublicly('sectionsImages', 'public');
            $section->update([
                'image' => 'storage/' . $path,
            ]);
        }
        $section->update([
            'section_name' => $request->section_name,
        ]);
        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' edited a section: ' . $section->section_name,
            'type' => 'update',
        ]);

        return redirect('/sections')->with('success', 'your section updated successfully');
    }

    //Delete Section Function
    public function deleteSection(Section $section)
    {
        $user = Auth::guard('user')->user();
        Notification::create([
            'user_id' => $user->id,
            'description' => $user->full_name . ' deleted a section: ' . $section->section_name,
            'type' => 'delete',
        ]);
        $section->delete();
        return redirect('/sections')->with('success', 'your section deleted successfully');
    }
}
