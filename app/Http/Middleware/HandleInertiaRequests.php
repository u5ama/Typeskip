<?php

namespace App\Http\Middleware;

use App\Models\ContentTool;
use App\Models\UserProjects;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param Request $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param Request $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'projects' => UserProjects::with('projects')->where('user_id', auth()->check() ? auth()->user()->id : '')->get(),
            'tools' => ContentTool::get(),
            'profile_picture' => auth()->check() ? auth()->user()->profile : '',
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
        ]);
    }
}
