<?php

namespace App\Http\Controllers\Cron;

use App\Http\Controllers\Controller;
use App\Match;
use App\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CronController extends Controller
{

    function pratelske_url($nazev)
    {
        $url = $nazev;
        $url = preg_replace('~[^\\pL0-9_]+~u', '-', $url);
        $url = trim($url, "-");
        $url = iconv("utf-8", "us-ascii//TRANSLIT", $url);
        $url = strtolower($url);
        $url = preg_replace('~[^-a-z0-9_]+~', '', $url);
        return $url;
    }

    public function checknhl()
    {
        $teamsPermutace = [1 => 24, 2 => 10, 3 => 25, 4 => 26, 5 => 12, 6 => 2, 7 => 17, 8 => 23, 9 => 11, 10 => 14, 12 => 18, 13 => 7, 14 => 28, 15 => 15,
            16 => 4, 17 => 6, 18 => 9, 19 => 13, 20 => 3, 21 => 19, 22 => 21, 23 => 29, 24 => 1, 25 => 20, 26 => 22, 28 => 27, 29 => 5, 30 => 8, 52 => 30, 53 => 16, 54 => 39];
        $url = urlencode("https://statsapi.web.nhl.com/api/v1/schedule?date=2021-01-01");
        $json = json_decode(file_get_contents('https://statsapi.web.nhl.com/api/v1/schedule?startDate=2021-01-01&endDate=2021-02-01'), true);
        foreach ($json['dates'] as $day) {

            foreach ($day['games'] as $game) {
                if (!array_key_exists($game['teams']['home']['team']['id'], $teamsPermutace)
                    OR !array_key_exists($game['teams']['away']['team']['id'], $teamsPermutace)) {
                    continue;
                }
                $host = $teamsPermutace[$game['teams']['home']['team']['id']];
                $guest = $teamsPermutace[$game['teams']['away']['team']['id']];
                $score_host = $game['teams']['home']['score'];
                $score_guest = $game['teams']['away']['score'];
                $gameID = $game['gamePk'];
                $gameDate = new Carbon($game['gameDate']);
                $gameDate->addHours(1);
                $stream_url = $this->pratelske_url(Team::findOrFail($host));
                $stream_url_final = "https://nhl-stream.com/live/$stream_url-live-stream/channel-1/";
                try {
                    $match = Match::updateOrCreate([
                        'start' => $gameDate,
                        'host_team' => $host,
                        'guest_team' => $guest,
                        'week' => $gameDate->week,
                        'stream_url' => $stream_url_final,
                        'gameId' => $gameID,
                    ]);
                    Log::info('Pridan zapas: ' . $match, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                } catch (\Exception $e) {
                    Log::error('Pridan zapas: E', ['error' => $e->getMessage(), 'ip' => \Request::getClientIp(true)]);
                }
            }
        }
    }

    public function evaluateGames()
    {
        $teamsPermutace = [1 => 24, 2 => 10, 3 => 25, 4 => 26, 5 => 12, 6 => 2, 7 => 17, 8 => 23, 9 => 11, 10 => 14, 12 => 18, 13 => 7, 14 => 28, 15 => 15,
            16 => 4, 17 => 6, 18 => 9, 19 => 13, 20 => 3, 21 => 19, 22 => 21, 23 => 29, 24 => 1, 25 => 20, 26 => 22, 28 => 27, 29 => 5, 30 => 8, 52 => 30, 53 => 16, 54 => 39];
        $startDate = Carbon::now()->addDays(-2)->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');
        $url = "https://statsapi.web.nhl.com/api/v1/schedule?startDate=" . $startDate . "&endDate=" . $endDate;
        $json = json_decode(file_get_contents($url), true);
        foreach ($json['dates'] as $day) {
            foreach ($day['games'] as $game) {
                $score_host = $game['teams']['home']['score'];
                $score_guest = $game['teams']['away']['score'];
                $gameID = $game['gamePk'];
                try {
                    $zapas = Match::where('gameId', '=', $gameID)->firstOrFail();
                    $zapas->score_host = $score_host;
                    $zapas->score_guest = $score_guest;
                    if ($zapas->start > Carbon::now()->addHours(4)) {
                        if ($score_host > $score_guest) {
                            $zapas->winner = 1;
                        }
                        if ($score_guest > $score_host) {
                            $zapas->winner = 2;
                        }
                        $zapas->save();
                        $zapas->evaluteTips();
                        Log::info('Zapas prehodnocen: ' . $zapas->id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                    }

                } catch (\Exception $e) {
                    Log::error('Pridan zapas: E', ['error' => $e->getMessage(), 'ip' => \Request::getClientIp(true)]);
                }
            }
        }
    }

    public function evaluateCompetition()
    {
        $teamsPermutace = [1 => 24, 2 => 10, 3 => 25, 4 => 26, 5 => 12, 6 => 2, 7 => 17, 8 => 23, 9 => 11, 10 => 14, 12 => 18, 13 => 7, 14 => 28, 15 => 15,
            16 => 4, 17 => 6, 18 => 9, 19 => 13, 20 => 3, 21 => 19, 22 => 21, 23 => 29, 24 => 1, 25 => 20, 26 => 22, 28 => 27, 29 => 5, 30 => 8, 52 => 30, 53 => 16, 54 => 39];
        $startDate = Carbon::now()->addDays(-3)->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');
        $url = "https://statsapi.web.nhl.com/api/v1/schedule?startDate=" . $startDate . "&endDate=" . $endDate;
        $json = json_decode(file_get_contents($url), true);
        foreach ($json['dates'] as $day) {
            foreach ($day['games'] as $game) {
                $score_host = $game['teams']['home']['score'];
                $score_guest = $game['teams']['away']['score'];
                $gameID = $game['gamePk'];
                try {
                    $zapas = Match::where('gameId', '=', $gameID)->firstOrFail();
                    $zapas->score_host = $score_host;
                    $zapas->score_guest = $score_guest;
                    if ($score_host > $score_guest) {
                        $zapas->winner = 1;
                    }
                    if ($score_guest > $score_host) {
                        $zapas->winner = 2;
                    }
                    $zapas->save();
                    $zapas->evaluteTips();
                    Log::info('Zapas prehodnocen: ' . $zapas->id, ['id' => Auth::user()->id, 'ip' => \Request::getClientIp(true)]);
                } catch (\Exception $e) {
                    Log::error('Pridan zapas: E', ['error' => $e->getMessage(), 'ip' => \Request::getClientIp(true)]);
                }
            }
        }
    }
}
