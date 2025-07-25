<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandlordSeeder extends Seeder
{
    public function run(): void
    {
        // Stati documento di default
        $statuses = [
            ['name' => 'Bozza', 'color' => '#gray', 'order' => 1],
            ['name' => 'In Revisione', 'color' => '#yellow', 'order' => 2],
            ['name' => 'Approvato', 'color' => '#green', 'order' => 3],
            ['name' => 'Scaduto', 'color' => '#red', 'order' => 4],
            ['name' => 'Archiviato', 'color' => '#blue', 'order' => 5],
        ];

        $statusRecords = [];
        foreach ($statuses as $status) {
            $statusRecords[] = [
                'name' => $status['name'],
                'color' => $status['color'],
                'order' => $status['order'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        DB::table('default_document_statuses')->insert($statusRecords);

        // Classificazioni documento di default
        $classifications = [
            ['name' => 'Sicurezza', 'parent_id' => null, 'order' => 1],
            ['name' => 'Qualità', 'parent_id' => null, 'order' => 2],
            ['name' => 'Privacy', 'parent_id' => null, 'order' => 3],
            ['name' => 'Amministrazione', 'parent_id' => null, 'order' => 4],
        ];

        foreach ($classifications as $classification) {
            $parentId = DB::table('default_document_classifications')->insertGetId([
                'name' => $classification['name'],
                'parent_id' => $classification['parent_id'],
                'order' => $classification['order'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Aggiungi sotto-classificazioni
            if ($classification['name'] === 'Sicurezza') {
                $subClassifications = [
                    ['name' => 'DVR', 'order' => 1],
                    ['name' => 'DUVRI', 'order' => 2],
                    ['name' => 'POS', 'order' => 3],
                    ['name' => 'Formazione', 'order' => 4],
                ];

                $subRecords = [];
                foreach ($subClassifications as $sub) {
                    $subRecords[] = [
                        'name' => $sub['name'],
                        'parent_id' => $parentId,
                        'order' => $sub['order'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                
                DB::table('default_document_classifications')->insert($subRecords);
            }
        }
    }
}
