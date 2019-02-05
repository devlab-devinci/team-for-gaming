<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

use App\Models\Game;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class TeamController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRoles = UserRole::where('user_id', Auth::user()->id)
            ->whereNotNull('team_id')
            ->get()
            ->unique('team_id');

        $games = Game::all()->pluck('name', 'id');
        $gameRoles = Role::where('game_id', 1)->get();

        $data = [
            'userRoles' => $userRoles,
            'games' => $games,
            'gameRoles' => $gameRoles
        ];

        return view('home.team.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Get game roles
     */
    public function getGameRoles($gameId)
    {
        $roles = Role::where('game_id', $gameId)->get();

        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $team = new Team();

        $team->name = $request->name;
        $team->game_id = $request->game;

        $team->save();

        // Creator role
        $userRole = new UserRole();

        $userRole->user_id = Auth::user()->id;
        $userRole->role_id = Role::where('type_id', 1)->first()->id;
        $userRole->team_id = $team->id;
        $userRole->admin   = 1;

        $userRole->save();

        $unknownUsers = [];
        foreach ($request->roles as $role) {
            $user = User::where('username', $role['username'])->first();

            if (!empty($user)) {
                $userRole = new UserRole();

                $userRole->user_id = $user->id;
                $userRole->role_id = $role['roleId'];
                $userRole->team_id = $team->id;
                $userRole->admin   = !empty($role['admin']) ? true : false;

                $userRole->save();
            } else {
                $unknownUsers[] = $role['username'];
            }
        };

        $userRoles = UserRole::where('user_id', Auth::user()->id)->whereNotNull('team_id')->get();

        $games = Game::all()->pluck('name', 'id');
        $gameRoles = Role::where('game_id', 1)->get();

        $data = [
            'userRoles' => $userRoles,
            'games' => $games,
            'gameRoles' => $gameRoles
        ];

        if (empty($unknownUsers)) {
            return view('home.team.index', $data)->with([
                'success' => true,
                'message' => "Success"
            ]);
        } else {
            return view('home.team.index', $data)->with([
                'warning' => true,
                'message' => "Les utilisateurs suivants n'existent pas sur notre site :",
                'unknownUsers' => $unknownUsers
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::find($id);

        $usersRole = UserRole::where('team_id', $id)
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('role_user.*', 'roles.type_id', 'roles.label')
            ->orderBy('type_id', 'ASC')
            ->orderBy('label', 'ASC')
            ->get();

        $games = Game::all()->pluck('name', 'id');
        $gameRoles = Role::where('game_id', $team->game->id)->get();

        $data = [
            'team' => $team,
            'usersRole' => $usersRole,
            'games' => $games,
            'gameRoles' => $gameRoles
        ];

        return view('home.team.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $team = Team::find($id);

        if ($team->name != $request->name) {
            $team->name = $request->name;
            $team->save();
        }

        if(count($request->roles) != count(array_unique(array_column($request->roles, 'username')))) {
            return back()->with([
                'error' => true,
                'message' => "Un utilisateur ne peut pas avoir plusieurs rôles dans une même équipe."
            ]);
        }

        $unknownUsers = [];
        foreach ($request->roles as $key => $role) {
            $user = User::where('username', $role['username'])->first();

            if (!empty($user)) {
                if (strpos($key, "new-") !== false) {
                    $userRole = new UserRole();

                    $userRole->role_id = $role['roleId'];
                    $userRole->team_id = $team->id;
                    $userRole->user_id = $user->id;
                    $userRole->admin   = !empty($role['admin']) ? true : false;

                    $userRole->save();
                } else {
                    $userRole = UserRole::find($key);

                    $userRole->user_id = $user->id;
                    $userRole->admin   = !empty($role['admin']) ? true : false;

                    $userRole->save();
                }
            } else {
                $unknownUsers[] = $role['username'];
            }
        };

        $team = Team::find($id);

        $usersRole = UserRole::where('team_id', $id)
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('role_user.*', 'roles.type_id', 'roles.label')
            ->orderBy('type_id', 'ASC')
            ->orderBy('label', 'ASC')
            ->get();

        $games = Game::all()->pluck('name', 'id');
        $gameRoles = Role::where('game_id', $team->game->id)->get();

        $data = [
            'team' => $team,
            'usersRole' => $usersRole,
            'games' => $games,
            'gameRoles' => $gameRoles
        ];

        if (empty($unknownUsers)) {
            return view('home.team.show', $data)->with([
                'success' => true,
                'message' => "Success"
            ]);
        } elseif (!empty($unknownUsers)) {
            return view('home.team.show', $data)->with([
                'warning' => true,
                'message' => "Les utilisateurs suivants n'existent pas sur notre site :",
                'users' => $unknownUsers
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
