<?php

namespace Database\Seeders;

use App\Models\Cluster;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clusters = ['Cluster 1', 'Cluster 2', 'Cluster 3', 'Cluster 4'];

        foreach ($clusters as $cluster) {
            Cluster::create([
                'name' => $cluster,
            ]);
        }
    }
}
