<?php

namespace App\Http\Controllers;

use App\Helpers\ReportHelper;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        Gate::authorize('viewReport', Auth::user());

        $reportsRaw = Report::orderBy('created_at','DESC')->paginate(15);
        $reports = [];

        foreach ($reportsRaw as $report){
            $reports[] = new ReportHelper($report);
        }

        return view('reports.reportsMng',[
            'reports' => $reports,
            ]);
    }

    public function create(Request $request){
        $request->validate([
            "imageID" => "required|integer",
            "reason" => "required|string",
        ]);

        $img = Image::findOrFail($request->imageID);

        Report::create([
            'image_id' => $img->id,
            'user_id' => Auth::id(),
            'reason' => $request->reason,
        ]);

        return redirect()->back();
    }


    public function cancelReport(Request $request, Report $report){

        $report->delete();
    }
}
