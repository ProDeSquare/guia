<?php

namespace App\Http\Controllers\Search;

use Auth;
use App\Models\Project;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;
use Spatie\Searchable\ModelSearchAspect;

class PerformController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function __invoke (Request $request)
    {
        if (strlen($request->q) < 3) return view('pages.search');

        $results = (new Search())
            ->registerModel(Student::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('name')
                    ->addExactSearchableAttribute('email')
                    ->addExactSearchableAttribute('roll_no')
                    ->addExactSearchableAttribute('username');
            })->registerModel(Teacher::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('name')
                    ->addExactSearchableAttribute('email');
            })->registerModel(Project::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                    ->addSearchableAttribute('title');
            })->search($request->q);
        
        Auth::guard()->user()->searchHistory()->updateOrCreate([
            'query' => $request->q,
            'guard' => Auth::guard()->user()->getGuardType()
        ]);

        return view('pages.search')->withResults($results);
    }
}
