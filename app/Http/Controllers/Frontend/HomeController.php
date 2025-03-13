<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Hero;
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
use App\Models\SkillSectionSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $typerTitles = TyperTitle::all();
        $services = Service::all();
        $portfolioCategories = Category::all();
        $portfolioItems = PortfolioItem::all();
        $skillItems = SkillItem::all();
        $feedbacks = Feedback::all();
        $about = About::first();
        $experience = Experience::first();
        $skill = SkillSectionSetting::first();
        $portfolioTitle = PortfolioSettingSection::first();
        $feedbackTitle = FeedbackSectionSetting::first();
        return view('frontend.home', compact(
        	'hero',
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
            'feedbacks'
        ));
    }

    public function showPortfolio($id)
    {
        $portfolio = PortfolioItem::findOrFail($id);
        return view('frontend.portfolio-details', compact('portfolio'));
    }
}
