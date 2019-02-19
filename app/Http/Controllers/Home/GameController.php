<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Game;
use App\Models\User;
use App\Models\GameLevel;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Calendar;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];

        $events[] = \Calendar::event(
            'Event One', //event title
            false, //full day event?
            '2015-02-11T0800', //start time (you can also use Carbon instead of DateTime)
            '2015-02-12T0800', //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );

        $events[] = \Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $calendar = \Calendar::addEvents($events) //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            'viewRender' => 'function() {alert("Callbacks!");}'
        ]);
        $user = Auth::user();
        $games = Game::all();
        $userGames = $user->games()->get();
        return view('user-interface.dashboard', compact('user', 'games', 'userGames', 'calendar'));
    }

    public function fetchGameLevel(Request $request) {
        $gameName = $request->get('value');
        $game = Game::find($gameName);
        $gameLevel = $game->gameLevels;
        $output = '<option value="">Sélectionnez votre niveau de jeux</option>';
        foreach($gameLevel as $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->label.'</option>';
        }
        echo $output;
    }

    public function storeGameUser(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'game' => 'required',
            'pseudo' => 'required',
            'gameLevel' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $user_id = $user = Auth::user();
        $game_level_id = $request->get('gameLevel');
        $pseudo = $request->get('gameLevel');

        $game = Game::find($request->get('game'));
        $game->users()->attach($user_id, ['game_level_id' => $game_level_id, 'pseudo' => $pseudo]);

        return response()->json(['success'=>'Data is successfully added']);
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
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(GamePostRequest $request, $id)
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
