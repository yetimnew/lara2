<?php

namespace App\Http\Controllers;

use Log;
use Alert;
use Artisan;
use Storage;
use Carbon\Carbon;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        // dd($disk);
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => $this->humanFilesize($disk->size($f)),
                    'last_modified' => $this->getDate($disk->lastModified($f)),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top

        $backups = array_reverse($backups);
        //   dd($backups);
        return view("backup.index")->with(compact('backups'));
    }
    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', ['--only-db' => true]);

            $output = Artisan::output();
            // dd($output);
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);


            Session::flash('success', 'Bacuping complited sucessfully');
            // Alert::success('New backup created');
            return redirect()->back();
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        // dd( $disk);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    //  function for file converssion
    public function humanFilesize($size, $precision = 2)
    {
        $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $step = 1024;
        $i = 0;

        while (($size / $step) > 0.9) {
            $size = $size / $step;
            $i++;
        }

        return round($size, $precision) . $units[$i];
    }
    public function getDate($date_modify)
    {
        return Carbon::createFromTimeStamp($date_modify)->formatLocalized('%d %B %Y %H:%M');
    }
}
