<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Setting;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $setting = Setting::first();
        $skills = Skill::orderBy('name','ASC')->get();
        $project_categories = ProjectCategory::orderBy('name','ASC')->get();
        $projects = Project::with('category')->latest()->limit(6)->get();
        return view('frontend.pages.home',[
            'title' => $setting->site_name . ' | ' . $setting->author_role,
            'setting' => $setting,
            'skills' => $skills,
            'project_categories' => $project_categories,
            'projects' => $projects
        ]);
    }
}
