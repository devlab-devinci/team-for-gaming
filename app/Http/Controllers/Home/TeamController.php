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
        $teams = UserRole::where('user_id', Auth::user()->id)
            ->whereNotNull('team_id')
            ->join('teams', 'role_user.team_id', '=', 'teams.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select('role_user.*', 'teams.game_id', 'teams.name as team_name', 'roles.label as role_label')
            ->orderBy('game_id', 'asc')
            ->orderBy('team_name', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->groupBy('team_id');

        $games = Game::all()->pluck('name', 'id');
        $gameRoles = Role::where('game_id', 1)->pluck('label', 'id');

        $data = [
            'teams' => $teams,
            'games' => $games,
            'gameRoles' => $gameRoles
        ];

        return view('home.team.index', $data);
    }

    /**
     * Answer team invitation
     *
     * @param  int  $userRoleId, int $status
     * @return \Illuminate\Http\Response
     */
    public function answerTeamInvitation($userRoleId, $status) {
        $userRole = UserRole::find($userRoleId);

        if ($status) {
            $userRole->status = 1;

            $userRole->save();

            $newRole = [
                'team' => $userRole->team,
                'role' => $userRole->role->label,
                'game' => $userRole->team->game->name
            ];
        } else {
            $userRole->delete();
        }

        return response()->json(['status' => $status, 'newRole' => $status ? $newRole : null]);
    }

    /**
     * Get game roles
     *
     * @param  int  $gameId
     * @return Object
     */
    public function getGameRoles($gameId)
    {
        $roles = Role::where('game_id', $gameId)->pluck('label', 'id');

        return $roles;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!empty($request->roles) && count($request->roles) != count(array_unique(array_column($request->roles, 'username')))) {
            return back()->with([
                'error' => true,
                'message' => "Un utilisateur ne peut pas avoir plusieurs rôles dans une même équipe."
            ]);
        } elseif (empty($request->roles)) {
            return back()->with([
                'error' => true,
                'message' => "Il n'y a aucun membre dans ton équipe."
            ]);
        }

        $namesakeTeams = Team::where('name', $request->name)->get();
        if ($namesakeTeams->isNotEmpty()) {
            return back()->with([
                'error' => true,
                'message' => "Ce nom d'équipe est déjà pris."
            ]);
        }

        $team = new Team();

        $team->name = $request->name;
        $team->game_id = $request->game;

        $team->save();

        // Creator role
        $userRole = new UserRole();

        $userRole->user_id = Auth::user()->id;
        $userRole->role_id = Role::where('type_id', 1)->first()->id;
        $userRole->team_id = $team->id;
        $userRole->status  = 1;
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
                $userRole->status  = Auth::user()->id == $user->id;
                $userRole->admin   = Auth::user()->id == $user->id || !empty($role['admin']);

                $userRole->save();
            } else {
                $unknownUsers[] = $role['username'];
            }
        };

        if (empty($unknownUsers)) {
            return redirect()->route('home.team.index')->with([
                'success' => true,
                'message' => "Votre équipe a bien été créée."
            ]);
        } else {
            return redirect()->route('home.team.index')->with([
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
        $gameRoles = Role::where('game_id', $team->game->id)->pluck('label', 'id');

        $data = [
            'team' => $team,
            'usersRole' => $usersRole,
            'games' => $games,
            'gameRoles' => $gameRoles,
            'isAdmin' => self::isAdmin($id),
            'isCreator' => self::isCreator($id),
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
        if(!empty($request->roles) && count($request->roles) != count(array_unique(array_column($request->roles, 'username')))) {
            return back()->with([
                'error' => true,
                'message' => "Un utilisateur ne peut pas avoir plusieurs rôles dans une même équipe."
            ]);
        } elseif (empty($request->roles)) {
            return back()->with([
                'error' => true,
                'message' => "Il n'y a aucun membre dans ton équipe."
            ]);
        }

        $team = Team::find($id);
        $namesakeTeams = Team::where('name', $request->name)->get();

        if ($team->name != $request->name) {
            if ($namesakeTeams->isNotEmpty()) {
                return back()->with([
                    'error' => true,
                    'message' => "Ce nom d'équipe est déjà pris."
                ]);
            }

            $team->name = $request->name;

            $team->save();
        }

        $usersRoleId = UserRole::where([
            ['team_id', $id],
            ['role_id', "!=", 1]
        ])->pluck('id')->all();

        foreach (array_diff($usersRoleId, array_keys($request->roles)) as $userRoleId) {
            UserRole::find($userRoleId)->delete();
        };

        $unknownUsers = [];
        foreach ($request->roles as $key => $role) {
            $user = User::where('username', $role['username'])->first();

            if (!empty($user)) {
                if (strpos($key, "new-") !== false) {
                    $userRole = new UserRole();

                    $userRole->role_id = $role['roleId'];
                    $userRole->team_id = $team->id;
                    $userRole->user_id = $user->id;
                    $userRole->status  = Auth::user()->id == $user->id;
                    $userRole->admin   = !empty($role['admin']);

                    $userRole->save();
                } else {
                    $userRole = UserRole::find($key);

                    $userRole->role_id = $role['roleId'];
                    $userRole->user_id = $user->id;
                    $userRole->status  = Auth::user()->id == $user->id || in_array($user->id, $team->users->where('status', 1)->pluck('user_id')->all
                    ());
                    $userRole->admin   = !empty($role['admin']);

                    $userRole->save();
                }
            } else {
                $unknownUsers[] = $role['username'];
            }
        };

        if (empty($unknownUsers)) {
            return redirect()->route('home.team.show', [$id])->with([
                'success' => true,
                'message' => "Votre équipe a bien été mise à jour."
            ]);
        } elseif (!empty($unknownUsers)) {
            return redirect()->route('home.team.show', [$id])->with([
                'warning' => true,
                'message' => "Les utilisateurs suivants n'existent pas sur notre site :",
                'unknownUsers' => $unknownUsers
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
        $usersRoles = UserRole::where('team_id', $id);

        if ($usersRoles->delete()) {
            $team = Team::find($id);

            if ($team->delete()) {
                return redirect()->route('home.team.index')->with([
                    'success' => true,
                    'message' => "Votre équipe a bien été supprimée."
                ]);
            } else {
                return back()->with([
                    'error' => true,
                    'message' => "Une erreur est survenue lors de la suppression de votre équipe."
                ]);
            }
        } else {
            return back()->with([
                'error' => true,
                'message' => "Une erreur est survenue lors de la suppression des membres de votre équipe."
            ]);
        }
    }

    /**
     * Check is authenticated user is team admin
     */
    public function isAdmin($id)
    {
        return !empty(UserRole::where([
            ['team_id', $id],
            ['user_id', Auth::user()->id],
            ['status', 1],
            ['admin', 1]
        ])->first());
    }

    /**
     * Check is authenticated user is team creator
     */
    public function isCreator($id)
    {
        return !empty(UserRole::where([
            ['team_id', $id],
            ['user_id', Auth::user()->id],
            ['role_id', 1]
        ])->first());
    }
}
