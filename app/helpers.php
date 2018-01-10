<?php

function importExcelFile($loaction,$file,$model){
   // dd("jj");
    Excel::load($loaction.'/'.$file, function ($reader) use($model){
    foreach ($reader->toArray() as $row) {
        if($row['id']!="new"){
            $record = $model->findOrFail($row['id']);
            $record->update($row);
        }else{
        // Auth::user()->locationCategories()->save($location_category);
        $model->firstOrCreate($row);
        }
    }

    });
    echo 'yes';
}
?>