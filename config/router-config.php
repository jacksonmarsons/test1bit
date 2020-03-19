<?php
   return $routers = [
            'category/form/([0-9]+)' => 'category/form/$1',
            'category/save' => 'category/save',
            'category/delete/([0-9]+)' => 'category/delete/$1',
            'item/form/([0-9]+)/([0-9]+)' => 'item/form/$1/$2', 
            'item/save' => 'item/save',
            'item/delete/([0-9]+)' => 'item/delete/$1',
            'site/sort' => 'site/sort'
         ];
?>
