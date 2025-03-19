<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\TyperTitleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FeedbackSectionSettingController;
use App\Http\Controllers\Admin\BlogSectionSettingController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\SkillItemController;
use App\Http\Controllers\Admin\PortfolioSettingSectionController;
use App\Http\Controllers\Admin\SkillSectionSettingController;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('portfolio-details/{id}', [HomeController::class, 'showPortfolio'])->name('portfolio.details');
Route::get('blog-details/{id}', [HomeController::class, 'showBlog'])->name('show.blog');
Route::get('blogs', [HomeController::class, 'blogs'])->name('blogs');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function() {
    // hero route 
    Route::resource('hero', HeroController::class);
    // typer-title route
    Route::resource('typer-title', TyperTitleController::class);
    // services route
    Route::resource('service', ServiceController::class);
    // about route
    Route::resource('about', AboutController::class);
    // portfolio-categories route
    Route::resource('category', CategoryController::class);
    // portfolio-items route
    Route::resource('portfolio-item', PortfolioItemController::class);
    // potfolio section setting route
    Route::resource('portfolio-setting-section', PortfolioSettingSectionController::class);
    // skill sectionsetting route
    Route::resource('skill-section-setting', SkillSectionSettingController::class);
    // skill-items route
    Route::resource('skill-item', SkillItemController::class);
    // experience route 
    Route::resource('experience', ExperienceController::class);
    // feedback route 
    Route::resource('feedback', FeedbackController::class);
    // feedback section setting route 
    Route::resource('feedback-section-setting', FeedbackSectionSettingController::class);
    // blog-categories route 
    Route::resource('blog-category', BlogCategoryController::class);
    // blog rourte 
    Route::resource('blog', BlogController::class);
    // blog section setting route 
    Route::resource('blog-section-setting', BlogSectionSettingController::class);
    // download resume
    Route::get('resume/download', [AboutController::class, 'resumeDownload'])->name('resume.download');
    
});

require __DIR__.'/auth.php';
