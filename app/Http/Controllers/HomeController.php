<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $dishes = MenuItem::take(3)->get(); // Featured dishes
        // $testimonials = Testimonial::latest()->take(3)->get(); // Guest testimonials

        return view('welcome', compact('dishes'));
    }
}
