<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Кардиология',
                'description' => 'Специалисты по сердцу и сердечно-сосудистой системе',
                'icon' => '🫀',
                'doctors' => [
                    ['name' => 'Dr. Elena Vasquez', 'specialization' => 'Интервенционный кардиолог', 'bio' => '15 лет опыта в кардиологических вмешательствах и лечении сердечной недостаточности.', 'email' => 'vasquez@hospital.com'],
                    ['name' => 'Dr. James Okafor', 'specialization' => 'Электрофизиолог', 'bio' => 'Эксперт по нарушениям сердечного ритма и установке кардиостимуляторов.', 'email' => 'okafor@hospital.com'],
                    ['name' => 'Dr. Mei Lin', 'specialization' => 'Профилактический кардиолог', 'bio' => 'Специализируется на профилактике сердечных заболеваний и здоровом образе жизни.', 'email' => 'meilin@hospital.com'],
                    ['name' => 'Dr. Robert Kline', 'specialization' => 'Кардиохирург', 'bio' => 'Более 20 лет выполняет операции на открытом сердце и замену клапанов.', 'email' => 'kline@hospital.com'],
                ],
            ],
            [
                'name' => 'Неврология',
                'description' => 'Лечение головного мозга, позвоночника и нервной системы',
                'icon' => '🧠',
                'doctors' => [
                    ['name' => 'Dr. Aisha Patel', 'specialization' => 'Невролог', 'bio' => 'Специализируется на лечении инсульта и эпилепсии.', 'email' => 'patel@hospital.com'],
                    ['name' => 'Dr. Luca Ferrari', 'specialization' => 'Нейрохирург', 'bio' => 'Эксперт в малоинвазивных операциях на мозге и позвоночнике.', 'email' => 'ferrari@hospital.com'],
                    ['name' => 'Dr. Sarah Bloom', 'specialization' => 'Специалист по двигательным расстройствам', 'bio' => 'Занимается лечением болезни Паркинсона и других двигательных нарушений.', 'email' => 'bloom@hospital.com'],
                ],
            ],
            [
                'name' => 'Ортопедия',
                'description' => 'Кости, суставы и опорно-двигательная система',
                'icon' => '🦴',
                'doctors' => [
                    ['name' => 'Dr. Carlos Mendez', 'specialization' => 'Ортопед-хирург', 'bio' => 'Специализируется на замене суставов и восстановлении после спортивных травм.', 'email' => 'mendez@hospital.com'],
                    ['name' => 'Dr. Nina Hoffmann', 'specialization' => 'Специалист по позвоночнику', 'bio' => 'Эксперт в коррекции деформаций позвоночника и лечении грыж.', 'email' => 'hoffmann@hospital.com'],
                    ['name' => 'Dr. Thomas Walsh', 'specialization' => 'Спортивная медицина', 'bio' => 'Работает со спортсменами по профилактике травм и реабилитации.', 'email' => 'walsh@hospital.com'],
                    ['name' => 'Dr. Yuki Tanaka', 'specialization' => 'Детский ортопед', 'bio' => 'Специализируется на проблемах костей и суставов у детей и подростков.', 'email' => 'tanaka@hospital.com'],
                ],
            ],
            [
                'name' => 'Дерматология',
                'description' => 'Кожа, волосы и ногти',
                'icon' => '🩺',
                'doctors' => [
                    ['name' => 'Dr. Fatima Al-Rashid', 'specialization' => 'Клинический дерматолог', 'bio' => 'Эксперт по акне, экземе, псориазу и аутоиммунным заболеваниям кожи.', 'email' => 'alrashid@hospital.com'],
                    ['name' => 'Dr. Oscar Brennan', 'specialization' => 'Дерматолог-хирург', 'bio' => 'Специализируется на удалении рака кожи и операции Мооса.', 'email' => 'brennan@hospital.com'],
                    ['name' => 'Dr. Priya Sharma', 'specialization' => 'Косметолог-дерматолог', 'bio' => 'Занимается эстетической дерматологией и антивозрастными процедурами.', 'email' => 'sharma@hospital.com'],
                ],
            ],
            [
                'name' => 'Педиатрия',
                'description' => 'Медицинская помощь для младенцев, детей и подростков',
                'icon' => '👶',
                'doctors' => [
                    ['name' => 'Dr. Maria Gonzalez', 'specialization' => 'Педиатр', 'bio' => 'Заботится о здоровье детей и их развитии.', 'email' => 'gonzalez@hospital.com'],
                    ['name' => 'Dr. Ethan Brooks', 'specialization' => 'Детский кардиолог', 'bio' => 'Специализируется на врождённых пороках сердца у детей.', 'email' => 'brooks@hospital.com'],
                    ['name' => 'Dr. Hana Kimura', 'specialization' => 'Неонатолог', 'bio' => 'Заботится о недоношенных и тяжело больных новорождённых.', 'email' => 'kimura@hospital.com'],
                ],
            ],
        ];

        foreach ($departments as $deptData) {
            $doctorsData = $deptData['doctors'];
            unset($deptData['doctors']);

            $department = Department::create($deptData);

            foreach ($doctorsData as $doc) {
                Doctor::create([
                    'department_id' => $department->id,
                    'name' => $doc['name'],
                    'specialization' => $doc['specialization'],
                    'bio' => $doc['bio'],
                    'email' => $doc['email'],
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                ]);
            }
        }
    }
}