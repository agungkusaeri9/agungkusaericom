<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectTag;
use App\Models\Setting;
use App\Models\Socmed;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $setting;
    public function __construct()
    {
        $this->setting = Setting::first();
    }

    public function index()
    {
        $q = request('q');
        if($q)
        {
            $projects = Project::with(['category','tags'])->where('name','LIKE','%' . $q . '%')->latest()->paginate(8);
        }else{

            $projects = Project::with(['category','tags'])->latest()->paginate(8);
        }
        $project_categories = ProjectCategory::withCount('projects')->orderBy('name','ASC')->get();
        $project_tags = ProjectTag::orderBy('name','ASC')->get();
        $socmeds = Socmed::orderBy('name','ASC')->get();
        return view('frontend.pages.project.index',[
            'title' => 'Projects | ' . $this->setting->site_name,
            'projects' => $projects,
            'project_categories' => $project_categories,
            'setting' => $this->setting,
            'socmeds' => $socmeds,
            'project_tags' => $project_tags
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.project.show',[
            'title' => $project->title,
            'project' => $project,
            'setting' => $this->setting
        ]);
    }

    public function category($slug)
    {
        $category = ProjectCategory::where('slug',$slug)->firstOrFail();
        $projects = $category->projects()->paginate(8);

        return view('frontend.pages.project.index',[
            'title' => $category->name . ' | Category Project',
            'projects' => $projects,
            'category' => $category,
            'setting' => $this->setting
        ]);
    }

    public function tag($slug)
    {
        $tag = ProjectTag::where('slug',$slug)->firstOrFail();
        $projects = $tag->projects()->paginate(8);
        return view('frontend.pages.project.index',[
            'title' => $tag->name . ' | Tag Project',
            'projects' => $projects,
            'tag' => $tag,
            'setting' => $this->setting
        ]);
    }
}
