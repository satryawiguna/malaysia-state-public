<?php
namespace FreshCMS\MalaysiaState\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use SplFileObject;

class ImportMalaysiaState extends Command
{
    protected $signature = 'malaysia-state:import';
    protected $description = 'Import Malaysia state data from CSV files';

    public function handle()
    {
        $csvDirectory = __DIR__ . '/../../csv/';
        $csvFiles = File::files($csvDirectory);

        DB::table('malaysia_states')->truncate();

        foreach ($csvFiles as $file) {
            if ($file->getExtension() === 'csv') {
                $csvPath = $file->getPathname();
                $fileObject = new SplFileObject($csvPath);
                $fileObject->setFlags(SplFileObject::READ_CSV);

                $rowCount = 0;

                foreach ($fileObject as $row) {
                    if ($rowCount === 0) {
                        $rowCount++;
                        continue;
                    }

                    if (!empty($row[0])) {
                        DB::table('malaysia_states')->insert([
                            'location' => $row[1],
                            'post_office' => $row[2],
                            'postcode' => $row[3],
                            'state' => $row[4],
                        ]);
                    }

                    $rowCount++;
                }

                $this->info('Imported data from: ' . $csvPath);
            }
        }

        $this->info('All Malaysia state data imported successfully.');
    }
}
