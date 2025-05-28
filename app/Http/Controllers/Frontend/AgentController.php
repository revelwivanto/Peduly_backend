<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the agents.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $agents = User::whereHas('role', function($query) {
            $query->where('name', 'agent');
        })->paginate(12);

        return view('frontend.agents.index', compact('agents'));
    }

    /**
     * Display the specified agent.
     *
     * @param  \App\Models\User  $agent
     * @return \Illuminate\View\View
     */
    public function show(User $agent)
    {
        $properties = $agent->properties()->paginate(12);
        
        return view('frontend.agents.show', compact('agent', 'properties'));
    }
} 