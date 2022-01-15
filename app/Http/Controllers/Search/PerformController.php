<?php

namespace App\Http\Controllers\Search;

use Auth;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Http\Controllers\Controller;
use App\Models\Search as ModelsSearch;
use Spatie\Searchable\ModelSearchAspect;

class PerformController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin,mod,teacher,student');
    }

    public function __invoke (Request $request)
    {
        if (strlen($request->q) < 3) return redirect()->route('home');

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
            })->search($request->q);
        
        Auth::guard()->user()->searchHistory()->create([
            'query' => $request->q,
            'guard' => Auth::guard()->user()->getGuardType()
        ]);

        return view('pages.search')->withResults($results);
    }
}
