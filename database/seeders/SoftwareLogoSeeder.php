<?php

namespace Database\Seeders;

use App\Models\SoftwareLogo;
use Illuminate\Database\Seeder;

class SoftwareLogoSeeder extends Seeder
{
    public function run(): void
    {
        $software = ['WaterGEMS', 'SewerGEMS', 'StormCAD', 'EPANET', 'AutoCAD', 'Civil 3D', 'Revit', 'Plant 3D', 'Mechanical Desktop', 'SolidWorks', 'GIS'];

        SoftwareLogo::whereNull('name')->delete();

        foreach ($software as $index => $name) {
            SoftwareLogo::updateOrCreate(
                ['name' => $name],
                ['path' => '', 'order' => $index + 1]
            );
        }
    }
}
