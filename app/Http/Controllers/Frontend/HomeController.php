<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
use App\Models\Blog;
use App\Models\Service;
use App\Models\About;
use App\Models\Experience;
use App\Models\Feedback;
use App\Models\Category;
use App\Models\PortfolioItem;
use App\Models\SkillItem;
use App\Models\TyperTitle;
use App\Models\PortfolioSettingSection;
use App\Models\FeedbackSectionSetting;
use App\Models\BlogSectionSetting;
use App\Models\SkillSectionSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $blogs = Blog::latest()->take(5)->get();
        $typerTitles = TyperTitle::all();
        $services = Service::all();
        $portfolioCategories = Category::all();
        $portfolioItems = PortfolioItem::all();
        $skillItems = SkillItem::all();
        $feedbacks = Feedback::all();
        $about = About::first();
        $experience = Experience::first();
        $blogTitle = BlogSectionSetting::first();
        $skill = SkillSectionSetting::first();
        $portfolioTitle = PortfolioSettingSection::first();
        $feedbackTitle = FeedbackSectionSetting::first();
        return view('frontend.home', compact(
        	'hero',
            'blogs',
        	'typerTitles',
        	'services',
        	'about',
        	'portfolioTitle',
            'feedbackTitle',
        	'portfolioCategories',
        	'portfolioItems',
            'skillItems',
            'skill',
            'experience',
            'feedbacks',
            'blogTitle'
        ));
    }

    public function showPortfolio($id)
    {
        $portfolio = PortfolioItem::findOrFail($id);
        return view('frontend.portfolio-details', compact('portfolio'));
    }

    public function showBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $previousPost = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        $nextPost = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
        return view('frontend.blog-details', compact('blog', 'nextPost', 'previousPost'));
    }

    public function blogs()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('frontend.blogs', compact('blogs'));
    }
}
