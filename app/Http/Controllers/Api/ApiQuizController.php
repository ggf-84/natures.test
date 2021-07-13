<?php

namespace App\Http\Controllers\API;

use App\Quiz;
use App\ResultQuiz;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;


class ApiQuizController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getData()
    {
        $data = $result = $idCollection = [];

        $quizData = Quiz::where('active', 1)->orderBy('id', 'desc')->get();

        if (!$quizData) {
            return response()->json([
                'type' => 'error',
                'message' => 'Something went wrong! Please try again.',
            ]);
        }

        foreach($quizData as $quiz){
            unset($quiz->translations);
            $quiz->step = false;
            $data[$quiz->quiz_page_attribute][] = $quiz;
        }

        foreach($data as $key => $value ){
            usort($value, function($a, $b){
                $a = $a['rank'];
                $b = $b['rank'];

                if ($a == $b) return 0;
                return ($a < $b) ? -1 : 1;
            });

            usort($value, function($a, $b){
                $a = $a['parent_id'];
                $b = $b['parent_id'];

                if ($a == $b) return 0;
                return ($a < $b) ? -1 : 1;
            });

            foreach($value as $row) {
                $idCollection[$row->id] = $row;
                if(!empty($row->parent_id) && in_array($row->parent_id, array_keys($idCollection))){
                    $result[$key][$row->parent->rank][] = $idCollection[$row->id];
                }else{
                    $result[$key][$row->rank][] = $row;
                }
            }
        }

        $rank = $types = [];
        $type = false;
        foreach($result as $key => $val) {
            foreach($val as $v) {
                $rank[] = $v[0]->rank;
                sort($rank);
                if($v[0]->rank <= $rank[0]) $type = $key;
            }
            $types[] = $key;
        }

        $result[$type][key($result[$type])][0]->step = true;

        $resultPageData = ResultQuiz::first()->toArray();

        if($resultPageData && $resultPageData['translations']) unset($resultPageData['translations']);

        $response = [];
        if(!empty($result['house'])) $response += $result['house'];
        if(!empty($result['food']))  $response += $result['food'];
        if(!empty($result['transport']))  $response += $result['transport'];
        if(!empty($result['lifestyle']))  $response += $result['lifestyle'];

        $resultPageData['compare_co2_emission'] = [
            trans('general.world_co2_emission') => options_find('world_co2_emission'),
            trans('general.uk_co2_emission') => options_find('uk_co2_emission'),
            trans('general.us_co2_emission') => options_find('us_co2_emission'),
            trans('general.china_co2_emission') => options_find('china_co2_emission'),
            trans('general.india_co2_emission') => options_find('india_co2_emission'),
        ];

        $resultPageData['tonnes'] = trans('general.tonnes');
        $resultPageData['trees'] = trans('general.trees');
        $resultPageData['offset_footprint'] = trans('general.offset_footprint');

        return response()->json(['data' => $response, 'result' => $resultPageData] );
    }
}
