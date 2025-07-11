<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\Sitemap;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();
        // static
        $sitemap->add(Url::create('/')->setPriority(1))
            ->add(Url::create('contact')->setPriority(1))
            ->add(Url::create('about')->setPriority(1))
            ->add(Url::create('blogs')->setPriority(0.8))
            ->add(Url::create('projects')->setPriority(0.8))
            ->add(Url::create('services/jasa-pembuatan-web')->setPriority(0.8));

        // post atau artikel
        $posts = Post::publish()->latest()->get();
        foreach ($posts as $post) {
            $sitemap->add(Url::create("/blogs/{$post->slug}")->setPriority(0.9)
                ->setLastModificationDate($post->updated_at));
        }

        // projects
        $projects = Project::publish()->latest()->get();
        foreach ($projects as $project) {
            $sitemap->add(Url::create("/projects/{$project->slug}")->setPriority(0.9)
                ->setLastModificationDate($project->updated_at));
        }

        // category post
        $categories = PostCategory::latest()->get();
        foreach ($categories as $category) {
            $sitemap->add(Url::create("/category/{$category->slug}")->setPriority(0.8)
                ->setLastModificationDate($category->updated_at));
        }

        // tag posts
        $post_tags = PostTag::latest()->get();
        foreach ($post_tags as $posttag) {
            $sitemap->add(Url::create("/tag/{$posttag->slug}")->setPriority(0.8)
                ->setLastModificationDate($posttag->updated_at));
        }

        // category project
        $project_categories = ProjectCategory::latest()->get();
        foreach ($project_categories as $pc) {
            $sitemap->add(Url::create("/projects/category/{$pc->slug}")->setPriority(0.8)
                ->setLastModificationDate($pc->updated_at));
        }

        // tag project
        $project_tags = ProjectCategory::latest()->get();
        foreach ($project_tags as $pt) {
            $sitemap->add(Url::create("/projects/tag/{$pt->slug}")->setPriority(0.8)
                ->setLastModificationDate($pt->updated_at));
        }


        $sitemap->writeToFile(public_path('sitemap.xml'));

        return redirect()->route('admin.dashboard')->with('success', 'Sitemap berhasil diupdate');
    }
}
