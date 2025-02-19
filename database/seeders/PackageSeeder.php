<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'name' => 'V. Small',
                'price' => 12.00,
                'can_manage_members' => false, // This package cannot manage members
                'max_members' => 100,
                'max_groups' => 5,
            ],
            [
                'name' => 'Small',
                'price' => 25.00,
                'can_manage_members' => true,
                'max_members' => 250,
                'max_groups' => 10,
            ],
            [
                'name' => 'Medium',
                'price' => 40.00,
                'can_manage_members' => true,
                'max_members' => 500,
                'max_groups' => 20,
            ],
            [
                'name' => 'Large',
                'price' => 50.00,
                'can_manage_members' => true,
                'max_members' => 1000,
                'max_groups' => 50,
            ],
            [
                'name' => 'Unlimited',
                'price' => 60.00,
                'can_manage_members' => true,
                'max_members' => null, // Unlimited members
                'max_groups' => null, // Unlimited groups
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
