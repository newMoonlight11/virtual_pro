<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'youtube_url' => 'required|url'
        ]);

        // Convertimos la URL en una URL de embed
        $videoId = $this->extractYouTubeID($request->youtube_url);
        $embedUrl = "https://www.youtube.com/embed/$videoId"; // URL limpia

        Video::create([
            'title' => $request->title,
            'youtube_url' => $embedUrl,
        ]);
        return redirect()->route('profesor.video');
    }

    private function extractYouTubeID($url)
    {
        preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/)|youtu\.be\/)([\w-]+)/', $url, $matches);
        return $matches[1] ?? null;
    }

    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        return redirect()->route('profesor.video');
    }
    public function estudiantes()
    {
        $videos = Video::all();
        return view('estudiante.videos', compact('videos'));
    }
}
