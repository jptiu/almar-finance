<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    private $departments = [
        [
            'name' => 'Human Resources',
            'description' => 'Responsible for recruitment, employee relations, and HR policies'
        ],
        [
            'name' => 'Finance',
            'description' => 'Handles financial planning, accounting, and budget management'
        ],
        [
            'name' => 'Information Technology',
            'description' => 'Manages IT infrastructure, software development, and technical support'
        ],
        [
            'name' => 'Marketing',
            'description' => 'Responsible for branding, advertising, and market research'
        ],
        [
            'name' => 'Operations',
            'description' => 'Oversees day-to-day business operations and process management'
        ],
        [
            'name' => 'Customer Service',
            'description' => 'Provides customer support and handles client inquiries'
        ],
        [
            'name' => 'Quality Assurance',
            'description' => 'Ensures product and service quality standards are met'
        ],
        [
            'name' => 'Legal',
            'description' => 'Handles legal matters, compliance, and contract management'
        ],
        [
            'name' => 'Research & Development',
            'description' => 'Focuses on innovation and product development'
        ],
        [
            'name' => 'Sales',
            'description' => 'Responsible for generating revenue and closing deals'
        ]
    ];

    public function run()
    {
        foreach ($this->departments as $department) {
            Department::create($department);
        }
    }
}
