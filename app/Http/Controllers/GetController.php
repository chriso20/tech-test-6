<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Media;
use App\Models\Poster;

class GetController extends Controller
{
    //
    public function show(Request $request, $id)
    {
        // forcing a lag/delay to show the button loading logic...
        sleep(1);

        // these would be referenced/looked up or abstracted in some way but this is just quick and dirty for a test :)
        if ($id == 1) {
            $response = Http::get('http://www.omdbapi.com/?s=Matrix&apikey=720c3666');
        } else if ($id == 2) {
            $response = Http::get('http://www.omdbapi.com/?s=Matrix%20Reloaded&apikey=720c3666');
        } else if ($id == 3) {
            $response = Http::get('http://www.omdbapi.com/?s=Matrix%20Revolutions&apikey=720c3666');
        }

        $data = json_decode($response->body());

        if ($data->Response == "True" && is_array($data->Search)) {
            // data looks good and as expected, let's process it
            // ideally we'd have more validation and error handling here..
            foreach ($data->Search as $searchResult) {
                $media = Media::updateOrCreate([
                    'title'   => $searchResult->Title,
                    'year'    => $searchResult->Year,
                    'imdb_id' => $searchResult->imdbID,
                    'type'    => $searchResult->Type,
                ]);
                $media->save();

                // This logic needs work
                if (isset($searchResult->Poster) && $searchResult->Poster !== "N/A") {
                    if (!$media->wasRecentlyCreated) {
                        $poster = Poster::where('media_id', $media->id)->first();
                        $poster->update(['poster_url', $searchResult->Poster]);
                    } else {
                        $poster = new Poster(['poster_url' => $searchResult->Poster]);
                        $media->poster()->save($poster);
                    }
                }
            }
            return 1; // easy success response
        } else {
            return 0; // easy failure response
        }
        dump($data);
    }
}
