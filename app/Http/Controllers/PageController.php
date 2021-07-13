<?php

namespace App\Http\Controllers;

use App\Paragraph;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($type)
    {
        $paragraphs = Paragraph::getListByType($type);

        return view('page', compact('paragraphs'));
    }
}
