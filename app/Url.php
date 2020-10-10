<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';

    protected $appends = ['short_full_url'];

    protected $hidden = [
        'id','type','hits','short_url', 'created_at', 'updated_at',
    ];

       /**
     * Recupere le chemin jusqu'a la baniere web
     *
     * @return string
     */
    public function getShortFullUrlAttribute(){
        return env('APP_URL').'/'.$this->short_url;
    }




}
