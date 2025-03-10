<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function green_text($txt)
    {
        return "<span class=\"text-green-500\">$txt</span>";
    }

    public function run(): void
    {
        Page::create([
            'name' => 'home',
            'content' => json_encode([
                'introduction' => "\"Sharpen first, cut fast.\"<br><br>Success isn't just about hard work—it's about working smart. Whether it's crafting efficient solutions, refining ideas, or building innovative projects, I believe preparation is the key to excellence. Here, you'll find my journey, skills, and insights, all shaped by a commitment to sharpening my craft before taking action.<br><br>Let's create something great together.",
                'my_skills' => [
                    'a ' . $this->green_text('Hobbyist Programmer.'),
                    'a ' . $this->green_text('Software Developer.'),
                    'a ' . $this->green_text('Web Developer.'),
                    'a ' . $this->green_text('Digital Artist.'),
                    'a ' . $this->green_text('UI/UX Designer.'),
                ],
            ]),
        ]);

        Page::create([
            'name' => 'about',
            'content' => json_encode([
                'about_me' => "I’m a hobbyist programmer with a passion for building things and solving problems. I love working on software projects, constantly exploring new ideas, and learning something new. Most of the time, I work solo on my projects as a student, but lately, I’ve been eager to collaborate with a team of fellow developers. Sometimes, it feels like I’m just a big fish in a small pond—I know there’s so much more to learn, and working with others is the best way to grow. I believe that every developer has something valuable to share, and I’m excited to be part of a team where we can learn from each other and build amazing things together.",
                'my_skills' => [],
                'exp_timeline' => [
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
                ],
            ]),
        ]);
    }
}
