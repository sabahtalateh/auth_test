<?php

namespace app\file_uploader;

class Uploader
{
    /**
     * @param string $from
     * @param string $to
     *
     * @throws \Exception
     */
    public function upload(string $from, string $to)
    {
        if (!move_uploaded_file($from, $to)) {
            throw new \Exception("Some errors were occurred while file uploading.");
        }
    }
}