<?php


namespace App\Services;

use App\Models\Logger;

class LoggerService
{
    public function insertLog($data)
    {
        try {
            $log = new Logger();

            $log->system = $data[ 'system' ];

            $log->type = $data[ 'type' ];

            $log->log = $data[ 'log' ];

            $log->save();

            return true;
        } catch (\Exception $exception) {
            return false;
        }

    }

    public function getLog(array $where, $sort = 'asc')
    {
        if (!empty($where)) {

            if ($sort == null) {
                $sort = 'asc';
            }

            return Logger::where($where)->orderBy('_id', $sort)->paginate(15);
        }

        if ($sort == null) {
            $sort = 'asc';
        }

        return Logger::orderBy('_id', $sort)->paginate(15);

    }
}