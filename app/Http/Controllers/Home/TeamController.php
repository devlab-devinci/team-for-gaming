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
        $user = Auth::user();

        $teams = UserRole::where('user_id', $user->id)->whereNotNull('team_id')->get();

        $games = Game::all()->pluck('name', 'id');
        $roles = Role::where('game_id', 1)->get();

        $data = [
            'teams' => $teams,
            'games' => $games,
            'roles' => $roles
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

        $unknownUsers = [];

        foreach ($request->roles as $roleId => $username) {
            $user = User::where('username', $username)->first();

            if (!empty($user)) {
                $userRole = new UserRole();

                $userRole->user_id = $user->id;
                $userRole->role_id = $roleId;
                $userRole->team_id = $team->id;

                $userRole->save();
            } else {
                $unknownUsers[] = $username;
            }
        };

        if (empty($unknownUsers)) {
            return back()->with([
                'success' => true,
                'message' => "Success"
            ]);
        } else {
            return back()->with([
                'error' => true,
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

        $users = UserRole::where('team_id', $id)->get();

        $games = Game::all()->pluck('name', 'id');
        $roles = Role::where('game_id', $team->game->id)->get();

        $data = [
            'team' => $team,
            'users' => $users,
            'games' => $games,
            'roles' => $roles
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
        //
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
