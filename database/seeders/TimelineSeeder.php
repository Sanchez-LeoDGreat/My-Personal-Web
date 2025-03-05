<?php

namespace Database\Seeders;

use App\Models\Timeline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Timeline::create([
            'name' => 'experience_timeline',
            'timeline' => json_encode([
                [
                    'timespan' => "2021-2022",
                    'title' => "1st Year College",
                    'content' => "When I started college, I had no idea what programming actually was since I came from a STEM background in senior high school. Our professors expected us to already know how to write code, but I didn't. However, that didn't stop me. Instead, I used my lack of knowledge as motivation to start learning. This mindset helped me tackle our activities, such as building console applications using C and C#.",
                ],
                [
                    'timespan' => "2022-2023",
                    'title' => "2nd Year College",
                    'content' => "In my 2nd year, we were required to develop a Windows application using the .NET Framework as part of our capstone project. My group members chose me as the system's developer while they focused on the research papers. This was the moment when my programming skills, which I had honed through self-learning, were finally recognized. During this time, I also helped many of my classmates with their systems, further making my skills known to others.",
                ],
                [
                    'timespan' => "2023-2024",
                    'title' => "3rd Year College",
                    'content' => "In my 3rd year, we started learning web development, and since my programming skills were well-known, I began taking on fellow students as clients. After completing my own web project, I helped others by debugging their code, adding features, and even developing entire projects for them. Around this time, I also started learning the Godot Game Engine for game development.",
                ],
                [
                    'timespan' => "2024-2025",
                    'title' => "4th Year College",
                    'content' => "During 4th year... TO BE CONTINUED",
                ],
            ]),
        ]);
    }
}
