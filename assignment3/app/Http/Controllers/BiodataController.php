<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        $name = "Ervin Hienz P. Cangco";
        $position = "Student Programmer";
        $age = 22;
        $gender = "Male";
        $nationality = "Filipino";
        $bio = "Aspiring Full Stack Developer and IT student at PSU-Urdaneta, specializing in Web Systems.";
        $path = asset('images/pfp.jpg');

        $contacts = [
            'phone' => '0912-3455-789',
            'email' => 'ecangco_21ur0176@psu.edu.ph',
            'address' => 'Cuyapo, Nueva Ecija',
            'linkedin' => 'linkedin.com/in/ervincangco/',
            'github' => 'github.com/V1nnyyy05',
        ];

        $education = [
            [
                'year' => 'Tertiary: 2023-Present',
                'school' => 'Pangasinan State University',
                'details' => 'Bachelor of Science in Information Technology - Major in Web & Mobile Technologies'
            ],
            [
                'year' => 'Secondary: 2015-2023',
                'school' => 'OLRA College Foundation',
                'details' => 'High School Graduate',
            ],
            [
                'year' => 'Primary: 2009-2015',
                'school' => 'Dr. A Ongsiako Elementary School',
                'details' => 'Elementary Graduate',
            ]
        ];

        $experience = "N/A";

        $skills = ['HTML/CSS', 'PHP', 'Laravel', 'Java', 'Flutter', 'Dart', 'MySQL'];

        return view('biodata', compact(
    'name',
    'position',
    'age',
    'nationality',
    'gender',
    'contacts',
    'education',
    'experience',
    'skills',
    'bio',
    'path'
));
    }
}